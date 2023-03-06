<?php

namespace App\Http\Controllers;

use DB;
use App\Models\dc_spk;
use App\Models\SizeMode;
use App\Models\cell_target;
use App\Models\dc_transfer;
use App\Models\balanceOrder;
use Illuminate\Http\Request;
use App\Models\dc_mutasi_spk;
use Illuminate\Support\Carbon;
// use Carbon\Carbon;
// use Carbon\CarbonPeriod;

class dcSpkController extends Controller
{
    public function index()
    {
        return view('distribution_center.spk');
    }
    public function main()
    {
        $data = db::table('dc__incoming  as a')
                    ->select('a.id_balance','a.cell')
                    ->join('dc__balance_order as b','a.id_balance','=','b.id')
                    ->groupBy('a.cell')->get();
        $list_cell = '<option>Pilih Cell</option>';
        foreach ($data as $a ) {
            $list_cell.='<option value="'.$a->cell.'">'.$a->cell.'</option>';
        }
        $list_cell_all = '<option>Pilih Cell</option>';
        $data_cell_all = cell_target::get();
        foreach ($data_cell_all as $a) {
            $list_cell_all .= '<option>'.$a->cell.'</option>';
        }
        $data=array(
            'list_cell'=>$list_cell,
            'list_cell_all'=>$list_cell_all
        );
        return json_encode($data);
    }
    public function spk_save(Request $request)
    {
        $po = $request->po;
        $wide = $request->wide;
        $cell = $request->cell;
        $size = $request->size;
        $qty = $request->qty_set_spk;
        $jam = $request->set_jam;
        date_default_timezone_set('Asia/Jakarta');
        //set hari
            $sekarang = date("Y-m-d");
            $jam_sekarang = (int)date('h');

            $cek = array('jam sekarang'=>$jam_sekarang,'jam'=>$jam);
            if ($jam_sekarang> (int)$jam) {
                $date1 = str_replace('-', '/', $sekarang);
                $time = date('Y-m-d',strtotime($date1 . "+1 days"));
            }else{
                $time =  date("Y-m-d");
            }
        $qty_size = $request->qty_size;
        $target = cell_target::select('eolr')->where('cell',$cell)->first();
        //get id_size
            $id_size = SizeMode::select('id')->where('size',$size)->first();
            // $cell_new = $request->new_cell;
        // detail order
            try {
                $getDB = balanceOrder::where(['wide'=>$wide,'po'=>$po])->get();
            } catch (\Exception $e) {
                $data = array(
                    'alert'=>'Gagal!',
                    'text'=> $e->getMessage(),
                    'color'=>'danger'
                );
                return json_encode($data);
            }

            foreach ($getDB as $a) {
                $style = $a->style;
                $xfd = $a->xfd;
                $qty_order = $a->qty;
            }
        // cek input spk tidak boleh lebih dari target / jam
            $cekQtyPerJam = dc_spk::select(db::raw('sum(qty_set) as sum_qty_set'))->where(['cell_new'=>$cell,'jam'=>$jam,'date'=>$time])->first();
            $balanceBilaDiTambah = ((int)$cekQtyPerJam->sum_qty_set+$qty);
            //validation
                // bila qty set spk lebih besar dari qty set size
                    if ($qty>$qty_size) {
                        if ($cekQtyPerJam->sum_qty_set!="") {
                            $data = array(
                                'alert'=>'Gagal',
                                'text'=> 'Qty tidak boleh lebih dari set incoming !',
                                'color'=>'danger'
                            );
                            return json_encode($data);
                        }
                    }
                // bila balance lengkap
                    if ($cekQtyPerJam->sum_qty_set == (int)$target->eolr) {
                        if ($cekQtyPerJam->sum_qty_set!="") {
                            $data = array(
                                'alert'=>'Gagal',
                                'text'=> 'Qty di jam '.$jam.' sudah Lengkap !',
                                'color'=>'danger'
                            );
                            return json_encode($data);
                        }
                    }
                // bila balance lebih dari target
                    if ($balanceBilaDiTambah > (int)$target->eolr) {
                        if ($cekQtyPerJam->sum_qty_set!="") {
                            $data = array(
                                'alert'=>'Gagal',
                                'text'=> 'Qty di jam '.$jam.' sudah lebih dari target cell !',
                                'color'=>'danger'
                            );
                            return json_encode($data);
                        }
                    }

        $bungkus = ['po'=>$po,'style'=>$style,'wide'=>$wide,'xfd'=>$xfd,'qty_order'=>$qty_order,'cell'=>$cell,'cell_new'=>$cell,'size'=>$id_size->id,'qty_set'=>$qty,'jam'=>$jam, 'date'=>$time];
        try {
            dc_spk::insert($bungkus);

        } catch (\Exception $e) {
            $data = array(
                'alert'=>'Gagal!',
                'text'=> $e->getMessage(),
                'color'=>'danger'
            );
            return json_encode($data);
        }
        // search Mapping cell per jam
        $arrayMappingCell = $this->getArrayMappingCell($cell,"cell_new","sekarang");

        $data=array(
            'alert'=>'sukses',
            'text'=>'Data berhasil di simpan',
            'color'=>'success',
            'cell'=>$cell,
            'po'=>$po,
            'wide'=>$wide,
            'arrayMappingCell'=>$arrayMappingCell
        );
        return json_encode($data);
    }
    public function process_mutasi(Request $request)
    {
        $file = $request->file;
        $cell = $request->cell;
        $jam = $request->jam;
        $mutasi_cell = $request->new_cell;
        $mutasi_jam = $request->set_jam;
        date_default_timezone_set('Asia/Jakarta');
        $imageName = time().'.'.$file->extension();
        if ($file=="") {
            $data = array(
                'alert'=>'Gagal!',
                'text'=> "Upload Form Mutasi Dahulu!",
                'color'=>'danger'
            );
            return json_encode($data);
        }
        $file->move(public_path('images'), $imageName);
        try {
            dc_spk::where(['cell'=>$cell,'jam'=>$jam])->update(['status'=>'TRANSFER','cell_new'=>$mutasi_cell,'jam'=>$mutasi_jam]);
            dc_mutasi_spk::where(['old_cell'=>$cell,'jam'=>$jam])->update(['status'=>"SUKSES",'images'=>$imageName]);
        } catch (\Exception $e) {
            $data = array(
                'alert'=>'Gagal!',
                'text'=> $e->getMessage(),
                'color'=>'danger'
            );
            return json_encode($data);
        }
        // search Mapping cell per jam
        $arrayMappingCell = $this->getArrayMappingCell($cell,"cell","sekarang");

        $data = array(
            'alert'=>'Sukses!',
            'text'=> 'Proses mutasi sukses dari : '.$cell.' -> '.$mutasi_cell,
            'color'=>'success',
            'cell'=>$cell,
            'arrayMappingCell'=>$arrayMappingCell
        );
        return json_encode($data);
    }
    public function proses_transfer(Request $request)
    {
        $cell = $request->cell;
        $jam = $request->jam;
        $logistik = strtoupper($request->logistik);

        $data = array(
                        'cell'=>$cell,
                        'jam'=>$jam,
                        );
        try {
            dc_spk::where($data)->update(['status'=>'TRANSFER']);
            $data['status']="TRANSFER";
            $data['serah_terima']=$logistik;
            $data['image']="-";

            dc_transfer::insert($data);
        } catch (\Exception $e) {
            $data = array(
                'alert'=>'Gagal!',
                'text'=> $e->getMessage(),
                'color'=>'danger'
            );
            return json_encode($data);
        }
        $arrayMappingCell = $this->getArrayMappingCell($cell,"cell_new","sekarang");
        $data = array(
            'alert'=>'Sukses!',
            'text'=> 'Proses Transfer sukses silahkan print Form Serah Terima',
            'color'=>'success',
            'jam'=>$jam,
            'cell'=>$cell,
            'arrayMappingCell'=>$arrayMappingCell
        );
        return json_encode($data);
    }
    public function saveMutasi(Request $request)
    {
        $cell=$request->cell;
        $cell_new = $request->cell_new;
        $jam = $request->jam;
        $set_jam_new = $request->set_jam_new;
        $description = $request->description;
        $planner_A = strtoupper($request->planner_A);
        $planner_B = strtoupper($request->planner_B);
        $leader = strtoupper($request->leader);
        $manager = strtoupper($request->manager);
        $fact_manager = strtoupper($request->fact_manager);

        //cek set jam sudah ada atau belum di new cell
            $cek_set_jam_spk = dc_spk::where(['jam'=>$set_jam_new,'cell_new'=>$cell_new])->get();
            $cek_set_jam_mutasi_spk = dc_mutasi_spk::where(['jam'=>$jam,'new_cell'=>$cell_new,'set_jam'=>$set_jam_new,'status'=>'NOT YET'])->first();
            if (count($cek_set_jam_spk)>0) {
                $data = array(
                    'alert'=>'Gagal!',
                    'text'=> "Set jam di cell : ".$cell_new.' dan jam : '.$set_jam_new.' sudah ada!',
                    'color'=>'danger'
                );
                return json_encode($data);
            }
            if ($cek_set_jam_mutasi_spk>0) {
                $data = array(
                    'alert'=>'Gagal!',
                    'text'=> "Set jam di cell".$cell_new.' sudah di di buat surat mutasi!',
                    'color'=>'danger'
                );
                return json_encode($data);
            }
        //insert mutasi spk
        try {
            dc_mutasi_spk::insert(['old_cell'=>$cell,'new_cell'=>$cell_new,'jam'=>$jam,'set_jam'=>$set_jam_new,'description'=>$description,'planner_A'=>$planner_A,'planner_B'=>$planner_B,'leader'=>$leader,'manager'=>$manager,'fact_manager'=>$fact_manager]);
        } catch (\Exception $e) {
            $data = array(
                'alert'=>'Gagal!',
                'text'=> $e->getMessage(),
                'color'=>'danger'
            );
            return json_encode($data);
        }
        //update spk
        try {
            dc_spk::where(['jam'=>$jam,'cell_new'=>$cell])->update(['status'=>'NOT YET']);
        } catch (\Exception $e) {
            $data = array(
                'alert'=>'Gagal!',
                'text'=> $e->getMessage(),
                'color'=>'danger'
            );
            return json_encode($data);
        }
        $data = array(
            'alert'=>'sukses',
            'text'=> 'Silahkan lakukan validasi',
            'color'=>'success'
        );
        return json_encode($data);
    }
    public function cell_change(Request $request)
    {
        $cell = $request->cell;
        $data = db::table('dc__incoming  as a')
            ->select('a.id_balance','b.po')
            ->leftJoin('dc__balance_order as b','a.id_balance','=','b.id')->where("b.cell",$cell)->groupBy('b.po')->get();
        $list_po = '<option>Pilih Po</option>';
        foreach ($data as $a ) {
            $list_po.='<option value="'.$a->id_balance.'">'.$a->po.'</option>';
        }
        // search Mapping cell per jam
        $arrayMappingCell = $this->getArrayMappingCell($cell,"cell_new",'sekarang');
        $data=array(
            'list_po'=>$list_po,
            'arrayMappingCell'=>$arrayMappingCell,
            'cell'=>$cell
        );
        return json_encode($data);
    }
    public function po_change(Request $request)
    {
        $id_balance = $request->id_balance;
        $cell = $request->cell;
        // search po list
            $data = db::table('dc__incoming  as a')
                        ->select('a.id_balance',db::raw('sum(case when a.komponen="Upper" then a.qty else 0 end) as qty_incoming'),'b.*')
                        ->join('dc__balance_order as b','a.id_balance','=','b.id')
                        ->where('a.id_balance',$id_balance)
                        ->where('a.cell',$cell)
                        ->groupBy('a.id_balance')->get();
            $tbody_po_list='';
            foreach ($data as $a ) {
                $percent = ((int)$a->qty_incoming/(int)$a->qty)*100;
                $tbody_po_list.='
                    <tr onclick="clickDetailIncoming(\''.$a->po.'\',\''.$a->wide.'\')">
                        <td>'.$a->buymonth.'</td>
                        <td>'.$a->po.'</td>
                        <td>'.$a->wide.'</td>
                        <td>'.$a->xfd.'</td>
                        <td>'.$a->qty_incoming.'</td>
                        <td>'.$a->qty.'</td>
                        <td>'.number_format($percent,2).' %</td>
                    </tr>
                ';
                $po=$a->po;
                $wide=$a->wide;
            }

        $data = array(
            'tbody_po_list'=>$tbody_po_list,
        );
        return json_encode($data);

    }
    function getArrayMappingCell($cell,$where,$kapan)
    {
        if ($kapan == "sekarang") {
            $setKapan = date_format(Carbon::today(),'Y-m-d');
        }else{
            $setKapan = date_format(Carbon::tomorrow(),'Y-m-d');
        }
        $target = cell_target::select('eolr')->where('cell',$cell)->first();
        $data_spk = dc_spk::select('jam',
                                DB::RAW('CASE WHEN status="TRANSFER" THEN "TRANSFER" WHEN status="NOTHING" THEN "PROCESS" WHEN status="NOT YET" THEN "PROCESS" ELSE 0 END as status_query'),
                                DB::RAW('CASE WHEN status="TRANSFER" THEN (sum(qty_set)/'.$target->eolr.')*100 WHEN status="NOTHING" THEN (sum(qty_set)/'.$target->eolr.')*100 WHEN status="NOT YET" THEN (sum(qty_set)/'.$target->eolr.')*100 ELSE 0 END as percent'),
                                DB::RAW('CASE WHEN status="TRANSFER" THEN sum(qty_set) WHEN status="NOTHING" THEN sum(qty_set) WHEN status="NOT YET" THEN sum(qty_set) ELSE 0 END as sum_qty')
                            )
                            ->where($where,$cell)
                            ->where('date',$setKapan)
                            ->where('cell_new',$cell)
                            ->groupBy('jam')->get();

        $arrayMappingCell = [];
        foreach ($data_spk as $a ) {
            $arrayMappingCell['id'][]=$a->jam;
            $arrayMappingCell['width'][]=number_format($a->percent,2)."%";
            if ($a->status_query=="TRANSFER") {
                $arrayMappingCell['color'][]='bg-success';
            }else{
                if (number_format($a->percent,2)<50) {
                    $arrayMappingCell['color'][]='bg-danger';
                }else if(number_format($a->percent,2)==100){
                    $arrayMappingCell['color'][]='bg-info';
                }else{
                    $arrayMappingCell['color'][]='bg-warning';
                }
            }
            $arrayMappingCell['display'][]= ($a->sum_qty).'/'.$target->eolr;
            $arrayMappingCell['status'][]= $a->status_query;
        }
        return $arrayMappingCell;
    }
    public function search_jam(Request $request)
    {
        $jam = $request->jam;
        $cell = $request->cell;
        $data_spk_all = db::table('dc__spk as a')
                        ->select('a.*','b.size as size_name')
                        ->where(['a.jam'=>$jam,'a.cell_new'=>$cell])
                        ->join('size_modes as b','a.size','=','b.id')
                        ->get();
        $tbody_list_spk = '';
        foreach ($data_spk_all as $a) {
            $tbody_list_spk.='
                <tr>
                    <td>'.$a->po.'</td>
                    <td>'.$a->style.'</td>
                    <td>'.$a->xfd.'</td>
                    <td>'.$a->size_name.'</td>
                    <td>'.$a->cell.'</td>
                    <td>'.$a->cell_new.'</td>
                    <td>'.$a->qty_set.'</td>
                    <td>'.$a->jam.'</td>
                    <td>'.$a->status.'</td>
                </tr>
            ';
        }
        $data = array(
            'tbody_list_spk'=>$tbody_list_spk,
        );
        return json_encode($data);
    }
    public function detail_incoming(Request $request)
    {
        $po = $request->po;
        $wide = $request->wide;
        $query_incoming = db::table('dc__incoming as a');
            $query_incoming = $query_incoming->select('b.po','b.wide','c.size','c.id as id_size','a.cell'
                    ,db::raw('sum(case when a.komponen="Upper" THEN a.qty else 0 END) as Upper')
                    ,db::raw('sum(case when a.komponen="Outsole" THEN a.qty else 0 END) as Outsole')
                    ,db::raw('sum(case when a.komponen="Texon" THEN a.qty else 0 END) as Texon')
                    ,db::raw('sum(case when a.komponen="Insole" THEN a.qty else 0 END) as Insole'));
            $query_incoming = $query_incoming->join('dc__balance_order as b','a.id_balance','=','b.id');
            $query_incoming = $query_incoming->leftJoin('size_modes as c','a.size','=','c.id');
            $query_incoming = $query_incoming->where(['b.po'=>$po,'b.wide'=>$wide]);
            $query_incoming = $query_incoming->groupBy('a.size')->orderBy('c.id')->get();
        $query_spk = db::table('dc__spk as a')
                    ->select('c.size','c.id_size','a.cell','a.po','a.wide',db::raw('sum(a.qty_set) as qty_set'))
                    ->leftJoin('size_modes as c','a.size','=','c.id')
                    ->where(['a.po'=>$po,'a.wide'=>$wide])
                    ->groupBy('a.size')
                    ->orderBy('c.id')
                    ->get();
        $array_incoming = [];
        $array_spk = [];
        $tbody_detail_incoming='';
        //get result incoming
            foreach ($query_incoming as $a ) {
                $array_incoming['po'][]=$a->po;
                $array_incoming['wide'][]=$a->wide;
                $array_incoming['size'][]=$a->size;
                $array_incoming['id_size'][]=$a->id_size;
                $array_incoming['cell'][]=$a->cell;
                $array_incoming['Upper'][]=$a->Upper;
                $array_incoming['Outsole'][]=$a->Outsole;
                $array_incoming['Texon'][]=$a->Texon;
                $array_incoming['Insole'][]=$a->Insole;
            }
        // get result spk
            foreach ($query_spk as $a) {
                $array_spk['po'][]=$a->po;
                $array_spk['wide'][]=$a->wide;
                $array_spk['size'][]=$a->size;
                $array_spk['id_size'][]=$a->id_size;
                $array_spk['qty_set'][]=$a->qty_set;
            }
            // return count($array_spk);
        // qty incoming - quantity spk
            if (count($array_spk)<1) {
                for ($i=0; $i < count($array_incoming['po']); $i++) {
                    $array_incoming['Upper'][$i]=$array_incoming['Upper'][$i];
                    $array_incoming['Outsole'][$i]=$array_incoming['Outsole'][$i];
                    $array_incoming['Texon'][$i]=$array_incoming['Texon'][$i];
                    $array_incoming['Insole'][$i]=$array_incoming['Insole'][$i];

                }
            }else{
                for ($i=0; $i < count($array_incoming['po']); $i++) {
                    for ($y=0; $y < count($array_spk['po']); $y++) {
                        if ($array_incoming['po'][$i]==$array_spk['po'][$y] &&$array_incoming['wide'][$i]==$array_spk['wide'][$y] && $array_incoming['size'][$i]==$array_spk['size'][$y]) {
                            $array_incoming['Upper'][$i]=$array_incoming['Upper'][$i]-$array_spk['qty_set'][$y];
                            $array_incoming['Outsole'][$i]=$array_incoming['Outsole'][$i]-$array_spk['qty_set'][$y];
                            $array_incoming['Texon'][$i]=$array_incoming['Texon'][$i]-$array_spk['qty_set'][$y];
                            $array_incoming['Insole'][$i]=$array_incoming['Insole'][$i]-$array_spk['qty_set'][$y];
                        }
                    }
                }
            }
            for ($i=0; $i < count($array_incoming['po']) ; $i++) {
                //search max min dan percent
                    $array_qty_komponen=[];
                    $qty_set=0;
                    if ($array_incoming['Upper'][$i]!=0) {
                        $array_qty_komponen[]=$array_incoming['Upper'][$i];
                    }
                    if ($array_incoming['Outsole'][$i]!=0) {
                        $array_qty_komponen[]=$array_incoming['Outsole'][$i];
                    }
                    if ($array_incoming['Texon'][$i]!=0) {
                        $array_qty_komponen[]=$array_incoming['Texon'][$i];
                    }
                    if ($array_incoming['Insole'][$i]!=0) {
                        $array_qty_komponen[]=$array_incoming['Insole'][$i];
                    }
                    if ($array_incoming['Upper'][$i]==0 || $array_incoming['Outsole'][$i]==0 || $array_incoming['Texon'][$i]==0 || $array_incoming['Insole'][$i]==0) {
                        $array_qty_komponen=[0];
                    }
                    $min=min($array_qty_komponen);
                    $max=max($array_qty_komponen);
                // get Qty SPK
                    if (count($array_spk)<1) {
                        $qty_set = 0;
                        $percent_spk = 0;
                    }else{
                        if (array_key_exists($i,$array_spk['qty_set'])) {
                            $qty_set=$array_spk['qty_set'][$i];
                        }else{
                            $qty_set=0;
                        }
                        if ($qty_set!=0 && $min !=0) {
                            $percent_spk = ($qty_set/($min+$qty_set))*100;
                            $percent_spk = number_format($percent_spk,2).' %';
                        }else{
                            $percent_spk = 0;
                        }
                    }
                $tbody_detail_incoming.='
                    <tr onclick="functionOpenModalSetSPK(\''.$array_incoming['size'][$i].'\',\''.$array_incoming['size'][$i].'\','.$min.',\''.$array_incoming['po'][$i].'\',\''.$array_incoming['cell'][$i].'\',\''.$array_incoming['wide'][$i].'\')">
                        <td>'.$array_incoming['po'][$i].'</td>
                        <td>'.$array_incoming['size'][$i].'</td>
                        <td>'.$array_incoming['Upper'][$i].'</td>
                        <td>'.$array_incoming['Outsole'][$i].'</td>
                        <td>'.$array_incoming['Texon'][$i].'</td>
                        <td>'.$array_incoming['Insole'][$i].'</td>
                        <td>'.$min.'</td>
                        <td>'.$qty_set.'</td>
                    </tr>
            ';
            }
            // return $array_qty_komponen;
        $data = array(
            'tbody_detail_incoming'=>$tbody_detail_incoming,
        );
        return json_encode($data);
    }
    public function detailFormMutasi(Request $request)
    {
        $jam  = $request->jam;
        $cell_new = $request->cell;
        //check stockupper
            $target = cell_target::select('eolr')->where('cell',$cell_new)->first();
            $checkSU = dc_spk::select(db::raw('sum(qty_set) as sum_qty_set'))
            ->where(['cell_new'=>'SU', 'status'=>'NOTHING'])->groupBy('jam')->get();
            if (count($checkSU)>0) {
                if ($cell_new!="SU") {
                    for ($i=0; $i < count($checkSU); $i++) {
                        if ((int)$checkSU[$i]['sum_qty_set']>=(int)$target->eolr) {
                            $data = array(
                                'status'=>'Ada Stock Upper'
                            );
                            return json_encode($data);
                        }
                    }
                }
            }
        //check data
            $data_spk = dc_spk::where(['jam'=>$jam,'cell_new'=>$cell_new])->first();
            $data=array(
                'status'=>$data_spk->status,
            );
            if ($data_spk->status == "NOT YET") {
                $data_spk_mutasi = dc_mutasi_spk::where(['jam'=>$jam,'old_cell'=>$cell_new])->first();
                $data['new_cell']=$data_spk_mutasi->new_cell;
                $data['set_jam']=$data_spk_mutasi->set_jam;
            }

        return json_encode($data);
    }
    public function detailModalFormTransfer(Request $request)
    {
        $cell = $request->cell;
        $jam = $request->jam;
        $status ="";
        $data_spk_all = db::table('dc__spk as a')
                        ->select('a.*',db::raw('sum(qty_set) as sum_qty_set'))
                        ->where(['jam'=>$jam,'cell'=>$cell])
                        ->groupBy('size')->get();
        $tbody_list_spk = '';
        foreach ($data_spk_all as $a) {
            $tbody_list_spk.='
                <tr>
                    <td>'.$a->po.'</td>
                    <td>'.$a->style.'</td>
                    <td>'.$a->xfd.'</td>
                    <td>'.$a->size.'</td>
                    <td>'.$a->cell.'</td>
                    <td>'.$a->cell_new.'</td>
                    <td>'.$a->sum_qty_set.'</td>
                    <td>'.$a->jam.'</td>
                    <td>'.$a->status.'</td>
                </tr>
            ';
            $status = $a->status;
        }
        $data = array(
            'tbody_list_spk'=>$tbody_list_spk,
            'status'=>$status
        );
        return json_encode($data);
    }
    public function print_priview_mutasi($cell, $jam)
    {
        $getDataSPK = db::table('dc__spk as a')
                        ->select('a.*','b.set_jam','b.new_cell','b.planner_A','b.planner_B','b.leader','b.manager','b.fact_manager')
                        ->where(['a.cell'=>$cell,'a.jam'=>$jam])
                        ->leftjoin('dc__mutasi_spk as b',function($join)
                        {
                          $join->on('a.jam', '=', 'b.jam');
                          $join->on('a.cell', '=', 'b.old_cell');
                        })
                        ->get();
        $counttable = 0;
        foreach ($getDataSPK as $a ) {
            $counttable++;
            $no_spk = $a->no_spk;
            $tanggal = $a->created_at;
            $planner_A = $a->planner_A;
            $planner_B = $a->planner_B;
            $leader = $a->leader;
            $manager = $a->manager;
            $fact_manager = $a->fact_manager;
        }
        return view('distribution_center.print.spk')
                ->with([
                        'title'=>'FORM MUTASI',
                        'counttable'=>'5',
                        'no_spk'=>$no_spk,
                        'getDataSPK'=>$getDataSPK,
                        'tanggal'=>$tanggal,
                        'planner_A'=>$planner_A,
                        'planner_B'=>$planner_B,
                        'leader'=>$leader,
                        'manager'=>$manager,
                        'fact_manager'=>$fact_manager
                        ]);
    }
    public function print_priview_transfer($cell, $jam)
    {
        $getDataSPK = db::table('dc__spk as a')
                        ->select('a.*','b.serah_terima')
                        ->leftJoin('dc__transfer as b',function($join)
                        {
                            $join->on('a.jam', '=', 'b.jam');
                        })
                        ->where(['a.cell'=>$cell, 'a.jam'=>$jam])
                        ->get();
        $counttable = 0;
        foreach ($getDataSPK as $a ) {
            $counttable++;
            $tanggal = $a->created_at;
            $serah_terima = $a->serah_terima;
        }
        return view('distribution_center.print.spk')
                ->with([
                        'title'=>'FORM TRANSFER',
                        'counttable'=>$counttable,
                        'getDataSPK'=>$getDataSPK,
                        'serah_terima'=>$serah_terima,
                        'tanggal'=>$tanggal,
                        ]);
    }
    public function reject_mutasi(Request $request)
    {
        $cell = $request->cell;
        $jam = $request->jam;

        try {
            dc_spk::where(['cell'=>$cell,'jam'=>$jam])->update(['status'=>'NOTHING']);
            dc_mutasi_spk::where(['old_cell'=>$cell,'jam'=>$jam])->update(['status'=>"REJECT"]);
        } catch (\Exception $e) {
            $data = array(
                'alert'=>'Gagal!',
                'text'=> $e->getMessage(),
                'color'=>'danger'
            );
            return json_encode($data);
        }
        // search Mapping cell per jam
        $arrayMappingCell = $this->getArrayMappingCell($cell,"cell_new",'sekarang');

        $data=array(
            'alert'=>'Sukses!',
            'text'=>'Data berhasil di simpan',
            'color'=>'success',
            'cell'=>$cell,
            'arrayMappingCell'=>$arrayMappingCell
        );
        return json_encode($data);

    }
}
