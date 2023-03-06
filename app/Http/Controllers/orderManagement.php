<?php

namespace App\Http\Controllers;

use DB;
use App\Models\process;
use App\Models\cell_target;
use Illuminate\Http\Request;
use App\Models\dailyBalance;

class orderManagement extends Controller
{
    public function index()
    {
        $cell_target = cell_target::get();
        return view('order_management.form',['cell_target'=>$cell_target]);
    }
    public function main()
    {
        $cell_target = cell_target::get();
        $order_information = db::table('daily_balance_percobaans as a')
                                ->select('a.cell','b.id')
                                ->join('cell_targets as b','a.cell','=','b.cell')
                                ->groupBy('a.cell','b.id')
                                ->get();
        // default variable
            $cell_tr = '<th style="vertical-align: middle;">Cell</th>';
            $eolr_tr = '<th>EOLR</th>';
            $mp_tr = '<th>MP Direct</th>';
            $data_cell = [];
            $option_cell = '<option value="">Select Cell</option>';
            $data_po = [];
            $option_po = '';
            //option cell target
            if ($cell_target) {
                foreach ($cell_target as $a) {
                    $cell_tr .= '
                        <td style="vertical-align: middle;">'.$a->cell.'</td>
                    ';
                    $eolr_tr .= '
                        <td onclick="updateCellTarget('.$a->id.',\'EOLR\','.$a->eolr.')">'.$a->eolr.'</td>
                    ';
                    $mp_tr .= '
                        <td onclick="updateCellTarget('.$a->id.',\'Mp_Direct\','.$a->mp_direct.')">'.$a->mp_direct.'</td>
                    ';
                }
            }
        //form input
            foreach ($order_information as $a ) {
                $option_cell.='<option value="'.$a->id.'">'.$a->cell.'</option>';
            }

        $data = array(
            'cell_tr'=>$cell_tr,
            'eolr_tr'=>$eolr_tr,
            'mp_tr'=>$mp_tr,
            'option_cell'=>$option_cell,
        );
        echo json_encode($data);
    }
    public function save_process(Request $request)
    {
        $value = $request->value;
        $size = $request->size;
        $type = $request->type;
        $po = $request->po;
        $detail = $request->detail;
        $cell = $request->cell;
        $qty_size = $request->qty_size;
        $date = date('Y-m-d');
        $hour = date('H');
        $area = $request->area;
        $search=[];
        if ($value=="") {
            $data = array(
                'allert'=>'Gagal!',
                'pesan'=>'Data value tidak boleh kosong'
            );
            return json_encode($data);
        }
        if ((int)$value > (int)$qty_size) {
            $data = array(
                'allert'=>'Gagal!',
                'pesan'=>'Data value tidak boleh lebih dari qty size'
            );
            return json_encode($data);
        }
        if ($detail=="") {
            if ($type == "output") {
                $search['size']=$size;
                $search['po']=$po;
                $search['cell']=$cell;
                $search['type']=$type;
                if ($area == 'Preparation') {
                    $search['area']='Cutting';
                }else if($area == "Sewing"){
                    $search['area']='Preparation';
                }else if($area == "Assembling"){
                    $search['area']='Sewing';
                }
                if ($area != "Stockfit" && $area != "Cutting") {
                    $qty_before = $this->checkQtyBefore($search);
                    if ((int)$value > (int)$qty_before) {
                        $data = array(
                            'area'=>$area,
                            'alert'=>'Gagal!',
                            'pesan'=>'Data value tidak boleh lebih dari qty sebelumnya'
                        );
                        return json_encode($data);
                    }
                }
            }
            $get = dailyBalance::where('po',$po)->get();
            $width = $get[0]['clr_width'];
            $wide = $get[0]['reg_or_wide'];
            $style = $get[0]['style'];
            try {
                $save = process::insert(
                    ['cell'=>$cell,
                    'po'=>$po,
                    'style'=>$style,
                    'reg_or_wide'=>$wide,
                    'clr_width'=>$width,
                    'size'=>$size,
                    'type'=>$type,
                    'area'=>$area,
                    'qty'=>$value]
                );
                $data = array(
                    'alert'=>'Sukses',
                    'area'=>$area,
                    'cell'=>$cell,
                    'po'=>$po,
                    'pesan'=>'Data telah berhasil di simpan'
                );
            } catch (\Exception  $e) {
                $data = array(
                    'alert'=>'Gagal!',
                    'pesan'=> $e->getMessage()
                );
            }
        }else{
            $arr_detail = explode('-',$detail);
            if ($type == "output") {
                $search['size']=$size;
                $search['po']=$po;
                $search['cell']=$cell;
                $search['type']=$type;
                $search['style']=$arr_detail[0];
                $search['reg_or_wide']=$arr_detail[1];
                $search['clr_width']=$arr_detail[2];
                if ($area == 'Preparation') {
                    $search['area']='Cutting';
                }else if($area == "Sewing"){
                    $search['area']='Preparation';
                }else if($area == "Assembling"){
                    $search['area']='Sewing';
                }
                if ($area != "Stockfit" && $area != "Cutting") {
                    $qty_before = $this->checkQtyBefore($search);
                    if ((int)$value > (int)$qty_before) {
                        $data = array(
                            'area'=>$area,
                            'alert'=>'Gagal!',
                            'pesan'=>'Data value tidak boleh lebih dari qty sebelumnya'
                        );
                        return json_encode($data);
                    }
                }
            }
            $arrColumn = ['style','reg_or_wide','clr_width'];
            for ($i=0; $i < count($arr_detail) ; $i++) {
                $dataSelect[$arrColumn[$i]]=$arr_detail[$i];
                $dataSelect['po']=$po;
                $dataSelect['cell']=$cell;
                $dataSelect['size']=$size;
                $dataSelect['type']=$type;
                $dataSelect['qty']=$value;
                $dataSelect['area']=$area;
            }
            try {
                $save = process::insert($dataSelect);
                $data = array(
                    'alert'=>'Sukses',
                    'po'=>$po,
                    'detail'=>$detail,
                    'area'=>$area,
                    'cell'=>$cell,
                    'po'=>$po,
                    'pesan'=>'Data telah berhasil di simpan'
                );
            } catch (\Exception $e) {
                $data = array(
                    'alert'=>'Gagal!',
                    'pesan'=> $e->getMessage()
                );
            }
        }
        echo json_encode($data);
    }
    function checkQtyBefore($search){
        $data_qty = process::select(db::raw('sum(qty) as qty'))->where($search)->get();
        if (is_null($data_qty[0]['qty'])) {
            $qty = 0;
        }else{
            $qty = $data_qty[0]['qty'];
        }
        return $qty;
    }
    public function update_cell_target(Request $request)
    {
        $new = $request->newData;
        $id = $request->id_cell_target;
        $title = $request->title_cell_target;

        $update = cell_target::where('id',$id)->update([$title=>$new]);
        if ($update) {
            $alert="sukses";
        }else{
            $alert="Gagal";
        }
        $data = array(
                    'alert'=>$alert,
                );

        echo json_encode($data);
    }
    public function cell_change(Request $request)
    {
        $cell = $request->cell;
            $convert = cell_target::where('id',$cell)->first();
            $data = $convert->id;
        //parameter
            $option_po = '';
            $po_data = dailyBalance::select('po')->where('cell',$convert->cell)->groupBy('po')->get();
            $qty_order = dailyBalance::select(DB::raw('sum(qty) as qty'))->where('cell',$convert->cell)->first();
        //form input
            foreach ($po_data as $a) {
                $option_po.='<option value-"'.$a->po.'">'.$a->po.'</option>';
            }
            $data = array(
                'option_po'=>$option_po,
                'qty_order'=>$qty_order->qty
            );
            echo json_encode($data);
    }
    public function process_change(Request $request)
    {
        $area = $request->area;
        $cell = $request->cell;
            $convert = cell_target::where('id',$cell)->first();
        $po = $request->po;
        $detail='';
        $thSize = '<th>Size</th>';
        $thBalance = '<th>Balance</th>';
        $tdOutput = '<td>Output</td>';
        $tdDefect = '<td>Defect</td>';
        $tdShortage = '<td>Shortage</td>';
        $jumlah = 0;
        $arr_size=[];
        $qty_order = dailyBalance::select(DB::raw('sum(qty) as qty'))->where('po',$po)->first();
        $resultData = dailyBalance::where(['po'=>$po,'cell'=>$convert->cell])->get();
        //form input
            if (count($resultData) == 2) {
                $jumlah = 2;
            }
            foreach ($resultData as $a ) {
                $detail.='<option>'.$a->style.'-'.$a->reg_or_wide.'-'.$a->clr_width.'</option>';
                $bm = $a->bm;
                $style = $a->style;
                $wide=$a->reg_or_wide;
                $width=$a->clr_width;
                $due_date = $a->orig_cfm_xfd;
                $gender = $a->g;
                //Balance Mentahan
                    $arr_size_qty = [$a->size_1,$a->size_2,$a->size_3,$a->size_4,$a->size_5,$a->size_6,$a->size_7,$a->size_8,$a->size_9,$a->size_10,$a->size_11,$a->size_12,$a->size_13,$a->size_14,$a->size_15,$a->size_16,$a->size_17,$a->size_18,$a->size_19,$a->size_20,$a->size_21,$a->size_22,$a->size_23,$a->size_24,$a->size_25,$a->size_26,$a->size_27,$a->size_28,$a->size_29];
            }
            // $data=array(
            //     'result'=>$resultData,
            // );
        //data table
            $get_size = DB::table('gender_modes as a')
                            ->select('b.*')
                            ->join('size_modes as b','a.id_size','=','b.id_size')
                            ->where('a.gender',$gender)
                            ->get();
            $process = process::where(['po'=>$po,'area'=>$area,'cell'=>$cell])->get();
            $data = $process;
            foreach ($get_size as $a ) {
                $thSize.='
                    <th>'.$a->size.'</th>
                ';
                $arr_size[]=$a->size;
            }
            for ($i=0; $i < count($arr_size_qty); $i++) {
                $valueTdOutput = 0;
                $valueTdDefect = 0;
                $valueTdShortage = 0;
                $qty_size = 0;
                $qty_size=0;
                $qty_size   =0;
                $color = '';
                if ($arr_size_qty[$i]==0) {
                    $qty_size = "";
                }else{
                    for ($y=0; $y < count($process); $y++) {
                        if ($arr_size[$i] == $process[$y]['size']) {
                            if ($process[$y]['type']=='output') {
                                $valueTdOutput += $process[$y]['qty'];
                            }else if ($process[$y]['type']=='defect') {
                                $valueTdDefect += $process[$y]['qty'];
                            }else{
                                $valueTdShortage += $process[$y]['qty'];
                            }
                        }
                    }
                    $qty_size = $arr_size_qty[$i]-$valueTdOutput;
                    // change color th balance
                        if ($qty_size == 0) {
                            $color="green";
                        }else{
                            $color="red";
                        }
                }
                //convert 0 to null
                    if ($valueTdOutput==0) {
                        $valueTdOutput="";
                    }
                    if ($valueTdDefect==0) {
                        $valueTdDefect="";
                    }
                    if ($valueTdShortage==0) {
                        $valueTdShortage="";
                    }
                $thBalance.='<th style="color:'.$color.'">'.$qty_size.'</th>';
                $tdOutput.='<td onClick="clickOutput(\''.$arr_size[$i].'\',\''.$qty_size.'\',\'output\')">'.$valueTdOutput.'</td>';
                $tdDefect.='<td onClick="clickOutput(\''.$arr_size[$i].'\',\''.$qty_size.'\',\'defect\')">'.$valueTdDefect.'</td>';
                $tdShortage.='<td onClick="clickOutput(\''.$arr_size[$i].'\',\''.$qty_size.'\',\'shortage\')">'.$valueTdShortage.'</td>';
            }
        $data = array(
            'value'=>$valueTdShortage,
            'arr_size_qty'=>$arr_size_qty,
            'qty_order'=>$qty_order->qty,
            'jumlah'=>$jumlah,
            'detail'=>$detail,
            'bm'=>$bm,
            'style'=>$style,
            'due_date'=>$due_date,
            'thSize'=>$thSize,
            'thBalance'=>$thBalance,
            'tdOutput'=>$tdOutput,
            'tdDefect'=>$tdDefect,
            'tdShortage'=>$tdShortage,
            'arr_size'=>$arr_size
        );
        echo json_encode($data);
    }
    public function detail_change(Request $request)
    {
        // variable
            $detail = $request->detail;
            $area = $request->process;
            $po = $request->po;
            $arr_detail = explode('-',$detail);
            $arrColumn = ['style','reg_or_wide','clr_width'];
            $dataSelect = [];
            $qty = '';
            $thSize = '<th>Size</th>';
            $thBalance = '<th>Balance</th>';
            $tdOutput = '<td>Output</td>';
            $tdDefect = '<td>Defect</td>';
            $tdShortage = '<td>Shortage</td>';
            $arr_size=[];
            $arr_size_qty = [];
        for ($i=0; $i < count($arr_detail) ; $i++) {
            $dataSelect[$arrColumn[$i]]=$arr_detail[$i];
            $dataSelect['po']=$po;
        }
        $get = dailyBalance::where($dataSelect)->get();
        $data = array('data'=>$get[0]['qty']);
        $qty = $get[0]['qty'];
        $style = $get[0]['style'];
        $bm = $get[0]['bm'];
        $due_date = $get[0]['orig_cfm_xfd'];
        $gender = $get[0]['g'];
                //Balance Mentahan
                    $arr_size_qty = [$get[0]['size_1'],$get[0]['size_2'],$get[0]['size_3'],$get[0]['size_4'],$get[0]['size_5'],$get[0]['size_6'],$get[0]['size_7'],$get[0]['size_8'],$get[0]['size_9'],$get[0]['size_10'],$get[0]['size_11'],$get[0]['size_12'],$get[0]['size_13'],$get[0]['size_14'],$get[0]['size_15'],$get[0]['size_16'],$get[0]['size_17'],$get[0]['size_18'],$get[0]['size_19'],$get[0]['size_21'],$get[0]['size_22'],$get[0]['size_23'],$get[0]['size_24'],$get[0]['size_25'],$get[0]['size_26'],$get[0]['size_27'],$get[0]['size_28'],$get[0]['size_29']];
        // data table
            $get_size = DB::table('gender_modes as a')
                ->select('b.*')
                ->join('size_modes as b','a.id_size','=','b.id_size')
                ->where('a.gender',$gender)
                ->get();

            $dataSelect['area']=$area;
            $process = process::where($dataSelect)->get();

                foreach ($get_size as $a ) {
                    $thSize.='
                        <th>'.$a->size.'</th>
                    ';
                    $arr_size[]=$a->size;
                }
                for ($i=0; $i < count($arr_size_qty); $i++) {
                    $valueTdOutput = 0;
                    $valueTdDefect = 0;
                    $valueTdShortage = 0;
                    $qty_size = 0;
                    $color = '';
                    if ($arr_size_qty[$i]==0) {
                        $qty_size = "";
                    }else{
                        for ($y=0; $y < count($process); $y++) {
                            if ($arr_size[$i] == $process[$y]['size']) {
                                if ($process[$y]['type']=='output') {
                                    $valueTdOutput += $process[$y]['qty'];
                                }else if ($process[$y]['type']=='defect') {
                                    $valueTdDefect += $process[$y]['qty'];
                                }else{
                                    $valueTdShortage += $process[$y]['qty'];
                                }
                            }
                        }
                        $qty_size = $arr_size_qty[$i]-$valueTdOutput;
                        // change color th balance
                            if ($qty_size == 0) {
                                $color="green";
                            }else{
                                $color="red";
                            }
                    }
                    //convert 0 to null
                        if ($valueTdOutput==0) {
                            $valueTdOutput="";
                        }
                        if ($valueTdDefect==0) {
                            $valueTdDefect="";
                        }
                        if ($valueTdShortage==0) {
                            $valueTdShortage="";
                        }
                    $thBalance.='<th style="color:'.$color.'">'.$qty_size.'</th>';
                    $tdOutput.='<td onClick="clickOutput(\''.$arr_size[$i].'\',\''.$qty_size.'\',\'output\')">'.$valueTdOutput.'</td>';
                    $tdDefect.='<td onClick="clickOutput(\''.$arr_size[$i].'\',\''.$qty_size.'\',\'defect\')">'.$valueTdDefect.'</td>';
                    $tdShortage.='<td onClick="clickOutput(\''.$arr_size[$i].'\',\''.$qty_size.'\',\'shortage\')">'.$valueTdShortage.'</td>';
                }

        $data = array(
            'process'=>$process,
            'dataSelect'=>$dataSelect,
            'qty'=>$qty,
            'style'=>$style,
            'bm'=>$bm,
            'due_date'=>$due_date,
            'thSize'=>$thSize,
            'thBalance'=>$thBalance,
            'tdOutput'=>$tdOutput,
            'tdDefect'=>$tdDefect,
            'tdShortage'=>$tdShortage,
            'arr_size'=>$arr_size
        );
        echo json_encode($data);
    }

}
