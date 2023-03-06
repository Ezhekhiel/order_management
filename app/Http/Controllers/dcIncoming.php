<?php

namespace App\Http\Controllers;

use DB;
use App\Models\cell_target;
use App\Models\dc_incoming;
use App\Models\gender_mode;
use App\Models\balanceOrder;
use App\Models\dc_warehouse;
use Illuminate\Http\Request;
use App\Imports\BalanceOrderImport;
use Maatwebsite\Excel\Facades\Excel;

class dcIncoming extends Controller
{
    public function incoming_index()
    {
        return view('distribution_center.incoming');
    }
    public function incoming_data()
    {
        $data_bm = balanceOrder::select('buymonth')->groupby('buymonth')->get();
        $bm_list='';
        foreach ($data_bm as $a) {
            $bm_list.='<option>'.$a->buymonth.'</option>';
        }
        $data = array(
            'bm_list'=>$bm_list,
        );
        return json_encode($data);
    }
    public function incoming_save(Request $request)
    {
        $logistik = $request->logistik;
        $bm = $request->buymonth;
        $po = $request->po;

        $wide = $request->wide;
        $cell = $request->cell;
        $style = $request->style;
        $qty_po = $request->qty_po;
        $gender = $request->gender;
        $identitas = ['po'=>$po,'wide'=>$wide];

        $date = $request->date;
        $komponen = $request->komponen;

        $qty_incoming = $request->qty_incoming;

        $cekNull=0;
        $query = [];
        $size = [];
        $status_po = '';
        $arr_error = [];
        //alert validation
            if ($logistik == '') {
                $alert = 'gagal';
                $text = 'Data Logistik Harus di isi';
                $data=array(
                    'alert'=>$alert,
                    'text'=>$text,
                    'color'=>'danger'
                );
                return json_encode($data);
            }
            if ($komponen == '') {
                $alert = 'gagal';
                $text = 'Data Komponen Harus di isi';
                $data=array(
                    'alert'=>$alert,
                    'text'=>$text,
                    'color'=>'danger'
                );
                return json_encode($data);
            }
            if ($po == '') {
                $alert = 'gagal';
                $text = 'Data PO Harus di isi';
                $data=array(
                    'alert'=>$alert,
                    'text'=>$text,
                    'color'=>'danger'
                );
                return json_encode($data);
            }
            if ($date == '') {
                $alert = 'gagal';
                $text = 'Data Date Harus di isi';
                $data=array(
                    'alert'=>$alert,
                    'text'=>$text,
                    'color'=>'danger'
                );
                return json_encode($data);
            }
        //save
            //get array size
                $getSize = db::table('size_modes as a')->select('a.id')->join('gender_modes as b','a.id_size','=','b.id_size')->where('gender',$gender)->get();
                $arrsize=[];
                    foreach ($getSize as $key => $value) {
                        $arrsize[]=$value->id;
                    }
            $getIDBalance = balanceOrder::where($identitas)->first();
            for ($i=0; $i < count($qty_incoming); $i++) {
                if (isset($qty_incoming[$i])||$qty_incoming[$i]=='0') {
                    $cekNull++;
                    $arrIncoming[]=(int)$qty_incoming[$i];
                    $arrSizeIncoming[]=$arrsize[$i];
                }
            }
            //cek data Incoming
            if ($cekNull>0) {
                try {
                    for ($i=0; $i < count($arrIncoming); $i++) {
                        $cek = db::table('dc__warehouse')->where('id_balance',$getIDBalance->id)->where('size',$arrSizeIncoming[$i])->get();
                        if (count($cek)>0) {
                            db::table('dc__warehouse')->where('id_balance',$getIDBalance->id)->where('size',$arrSizeIncoming[$i])->increment('qty',$arrIncoming[$i]);
                        }else{
                            db::table('dc__warehouse')->insert([
                                'id_balance'=>$getIDBalance->id,
                                'size'=>$arrSizeIncoming[$i],
                                'qty'=>$arrIncoming[$i],
                                'cell'=>$cell,
                                'komponen'=>$komponen,
                            ]);
                        }
                        dc_incoming::insert([
                            'id_balance'=>$getIDBalance->id,
                            'logistik'=>$logistik,
                            'date'=>$date,
                            'komponen'=>$komponen,
                            'cell'=>$cell,
                            'size'=>$arrSizeIncoming[$i],
                            'qty'=>$arrIncoming[$i],
                        ]);
                    }
                } catch (\Exception $e) {
                    $data = array(
                        'alert'=>'Gagal!',
                        'text'=> $e->getMessage(),
                        'color'=>'danger'
                    );
                    return json_encode($data);
                }
            }
            $data=array(
                'alert'=>'sukses',
                'text'=>'Data berhasil di simpan',
                'color'=>'success',
                'po'=>$po,
                'wide'=>$wide,
                'bm'=>$bm,
                'komponen'=>$komponen
            );
            return json_encode($data);
    }
    public function incoming_update(Request $request)
    {
        $po = $request->po;
        $wide = $request->wide;
        $size = $request->size;
        $qty = $request->qty_update;
        $komponen = $request->komponen;
        $getid = balanceOrder::select('id','buymonth')->where(['po'=>$po,'wide'=>$wide])->first();
        $getSize = db::table('size_modes')->select('id')->where('size',$size)->first();
        $cekIncoming = dc_incoming::where(['id_balance'=>$getid->id,'size'=>$getSize->id,'komponen'=>$komponen])->get();
        try {
            if (count($cekIncoming)<=1) {
                dc_incoming::where(['id_balancea'=>$getid->id,'size'=>$getSize->id,'komponen'=>$komponen])->update(['qty'=>$qty]);
            }else{
                for ($i=0; $i < count($cekIncoming); $i++) {
                    $qty_database =$cekIncoming[$i]['id'];
                    if ($i<(count($cekIncoming)-1)) {
                        dc_incoming::where('id',$qty_database)->delete();
                    }else{
                        dc_incoming::where('id',$qty_database)->update(['qty'=>$qty]);
                    }
                }
            }
        } catch (\Exception $e) {
            $data = array(
                'alert'=>'Gagal!',
                'text'=> $e->getMessage(),
                'color'=>'danger'
            );
            return json_encode($data);
        }
        $data=array(
            'size'=>$size,
            'po'=>$po,
            'bm'=>$getid->buymonth,
            'wide'=>$wide,
            'komponen'=>$komponen,
            'alert'=>'sukses',
            'text'=>'Update Data Berhasil',
            'color'=>'success'
        );
        return json_encode($data);
    }
    public function search_bm(Request $request)
    {
        $po = $request->po;
        $data = balanceOrder::where('po',$po)->groupBy('buymonth')->get();
        if (count($data)>1) {
            $listBM = '';
            foreach ($data as $a ) {
                $listBM.='<option>'.$a->buymonth.'</option>';
            }
            $data = array('listBM'=>$listBM,'count'=>count($data));
        }else{
            foreach ($data as $a ) {
                $listBM = $a->buymonth;
            }
            $data = array('listBM'=>$listBM,'count'=>count($data));
        }
        return json_encode($data);
    }
    public function change_bm(Request $request)
    {
        $bm = $request->bm;
        $dataBm = balanceOrder::where('buymonth',$bm)->groupby('po')->get();
        $list_po = '';
        foreach ($dataBm as $a ) {
            $list_po.='<option>'.$a->po.'</option>';
        }
        $data = array('list_po'=>$list_po);
        return json_encode($data);
    }
    public function change_po(Request $request)
    {
        $po = $request->po;
        $bm = $request->bm;
        $wide_list = '';
        $komponen_list = '<option>Pilih Komponen</option>';
        $dataAll = balanceOrder::where(['buymonth'=>$bm,'po'=>$po])->groupby('po')->get();
        $count_data = count($dataAll);
        $arrayKomponen = ['Upper','Outsole','Texon','Insole'];
        if ($count_data>1) {
            foreach ($dataAll as $a) {
                $wide_list .= '<option>'.$a->wide.'</option>';
            }
            $data = array(
                'wide_list'=>$wide_list,
                'count_data'=>$count_data
            );
            return json_encode($data);
        }else{
            $first = $dataAll->first();
            for ($i=0; $i < count($arrayKomponen); $i++) {
                $komponen_list.='
                    <option value="'.$arrayKomponen[$i].'">'.$arrayKomponen[$i].'</option>
                ';
            }
            $data = array('komponen_list'=>$komponen_list);
            return json_encode($data);
        }

    }
    public function change_data(Request $request)
    {
        $po = $request->po;
        $bm = $request->bm;
        $wide = $request->wide;
        $komponen = $request->komponen;
        $identitasBalanceOrder = ['buymonth'=>$bm,'po'=>$po];
        //get detail
            if (isset($wide)) {
                $identitasBalanceOrder['wide']=$wide;
            }
            $dataAll = balanceOrder::where($identitasBalanceOrder)->get();
            $first = $dataAll->first();
            $identitasDcIncoming = ['id_balance'=>$first->id];
            if (isset($komponen)) {
                $identitasDcIncoming['komponen']=$komponen;
            }
            //get qty incoming
                $dataIncoming = dc_incoming::select('size',db::raw('sum(qty) as sumqty'))->where($identitasDcIncoming)->groupby('size')->get();
                $arrQty = [];
                foreach ($dataIncoming as $key => $value) {
                        $arrQty[$value->size]=$value->sumqty;
                }
            //get size array
                $getSize = db::table('size_modes as a')->select('a.id')->join('gender_modes as b','a.id_size','=','b.id_size')->where('gender',$first->g)->get();
                $arrsize=[];
                    foreach ($getSize as $key => $value) {
                        $arrDatasize[]=$value->id;
                    }
            $count_data = count($dataAll);
            if ($count_data==0) {
                $data = array('err'=>'Data tidak ditemukan');
                return json_encode($data);
            }else if ($count_data>1) {
                $wide_list = '';
                foreach ($dataAll as $a) {
                    $wide_list .= '<option>'.$a->wide.'</option>';
                }
                $data = array(
                    'wide_list'=>$wide_list,
                    'count_data'=>$count_data
                );
                return json_encode($data);
            }else{
                $data_qty = [];
                foreach ($dataAll as $a ) {
                    $cell = $a->cell;
                    $wide = $a->wide;
                    $style = $a->style;
                    $qty = $a->qty;
                    $gender = $a->g;
                    $data_qty[]=(int) $a->size_1;
                    $data_qty[]=(int) $a->size_2;
                    $data_qty[]=(int) $a->size_3;
                    $data_qty[]=(int) $a->size_4;
                    $data_qty[]=(int) $a->size_5;
                    $data_qty[]=(int) $a->size_6;
                    $data_qty[]=(int) $a->size_7;
                    $data_qty[]=(int) $a->size_8;
                    $data_qty[]=(int) $a->size_9;
                    $data_qty[]=(int) $a->size_10;
                    $data_qty[]=(int) $a->size_11;
                    $data_qty[]=(int) $a->size_12;
                    $data_qty[]=(int) $a->size_13;
                    $data_qty[]=(int) $a->size_14;
                    $data_qty[]=(int) $a->size_15;
                    $data_qty[]=(int) $a->size_16;
                    $data_qty[]=(int) $a->size_17;
                    $data_qty[]=(int) $a->size_18;
                    $data_qty[]=(int) $a->size_19;
                    $data_qty[]=(int) $a->size_20;
                    $data_qty[]=(int) $a->size_21;
                    $data_qty[]=(int) $a->size_22;
                    $data_qty[]=(int) $a->size_23;
                    $data_qty[]=(int) $a->size_24;
                    $data_qty[]=(int) $a->size_25;
                    $data_qty[]=(int) $a->size_26;
                    $data_qty[]=(int) $a->size_27;
                    $data_qty[]=(int) $a->size_28;
                    $data_qty[]=(int) $a->size_29;
                }
                for ($i=0; $i < count($arrDatasize); $i++) {
                    if ($data_qty[$i]==0) {
                        $data_qty[$i]="";
                    }
                    $arrData[$arrDatasize[$i]]=$data_qty[$i];
                }
                $arrVisual=[];
                $i=0;
                foreach ($arrData as $key => $value) {
                    $i++;
                    if ($value=="") {
                        $arrVisual[]="";
                    }else{
                        if(array_key_exists($key,$arrQty)){
                            $balance = $value-$arrQty[$key];
                            $arrVisual[]=$arrQty[$key].' of '.$value;
                            $data_qty[$i-1]=$balance;
                        }else{
                            $arrVisual[]='0 of '.$value;
                        }
                        $balance_qty[$i-1]=$value;
                    }
                }
                $data_1 = array(
                    'count_data'=> $count_data,
                    'wide'=>$wide,
                    'cell'=>$cell,
                    'style'=>$style,
                    'qty'=>$qty,
                    'gender'=>$gender,
                    'data_qty'=>$data_qty,
                    'balance_qty'=>$balance_qty,
                    'arrVisual'=>$arrVisual
                );
            }
            $id_size = gender_mode::where('gender',$gender)->first();

        //set size model
            $data_size = db::table('size_modes as a')
                            ->select('a.size')
                            ->join('gender_modes as b','a.id_size','=','b.id_size')
                            ->where('b.gender',$gender)
                            ->get();
            $data_array=[];
            $data_2=[];
            foreach ($data_size as $a ) {
                array_push($data_array,$a->size);
            }
            $data_2['size']=$data_array;
        $data = array_merge($data_1,$data_2);
        return json_encode($data);
    }

}
