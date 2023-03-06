<?php

namespace App\Http\Controllers;

use App\Models\process;
use App\Models\cell_target;
use App\Models\dailyBalance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class dashboardController extends Controller
{
    public function index()
    {
        return view('order_management.dashboard');
    }
    public function main()
    {
        $get = process::select('cell')->groupBy('cell')->get();
        $cell = '';
        foreach ($get as $a) {
            $cell .= '<option>'.$a->cell.'</option>';
        }
        $data = array('cell'=>$cell);
        echo json_encode($data);
    }
    public function working_report_cell()
    {
        $firstTr='';
        $new_tr='';
        $po_string = '';
        $sum_hour = '';
        $all_array = [];
        $sumQty = [];
        $percentQty = [];
        $start = 7;
        $rowspan = 0;
        for ($i=$start; $i < 19; $i++) {
            if ($i!=12) {
                $query[]=db::raw("(CASE WHEN (date_format(a.created_at,'%d')=date_format(now(),'%d') AND date_format(a.created_at,'%H')=".$i.") THEN sum(a.qty) ELSE '0' END) as jam_".$i);
            }
        }
        $query[]='b.cell';
        $query[]='a.po';
        $query[]='b.eolr';
        $dataProcess = db::table('process as a')->select($query)
                                ->leftJoin('cell_targets as b','a.cell','=','b.id')
                                ->where(db::raw("date_format(a.created_at,'%d')"),db::raw("date_format(now(),'%d')"))
                                ->where('a.area', 'Assembling')
                                ->groupBy('a.cell','a.po')
                                ->get();

        foreach ($dataProcess as $a ) {
            $all_array[$a->cell]['po'][]=$a->po;
            $all_array[$a->cell]['eolr'][]=$a->eolr;
            $all_array[$a->cell]['count'][]=$a->po;
            $all_array[$a->cell]['jam_7'][]=(int)$a->jam_7;
            $all_array[$a->cell]['jam_8'][]=(int)$a->jam_8;
            $all_array[$a->cell]['jam_9'][]=(int)$a->jam_9;
            $all_array[$a->cell]['jam_10'][]=(int)$a->jam_10;
            $all_array[$a->cell]['jam_11'][]=(int)$a->jam_11;
            $all_array[$a->cell]['jam_13'][]=(int)$a->jam_13;
            $all_array[$a->cell]['jam_14'][]=(int)$a->jam_14;
            $all_array[$a->cell]['jam_15'][]=(int)$a->jam_15;
            $all_array[$a->cell]['jam_16'][]=(int)$a->jam_16;
            $all_array[$a->cell]['jam_17'][]=(int)$a->jam_17;
            $all_array[$a->cell]['jam_18'][]=(int)$a->jam_18;
        }
        foreach ($all_array as $key => $value) {
            $new_tr = '';
            $sum_hour = '';
            $percent_hour = '';
            $rowspan=count($value['count'])+2;
            $cell_arr=$value['eolr'];
            $po_string='<td>'.$value['po'][0].'</td>
                        <td>'.$value['jam_7'][0].'</td>
                        <td>'.$value['jam_8'][0].'</td>
                        <td>'.$value['jam_9'][0].'</td>
                        <td>'.$value['jam_10'][0].'</td>
                        <td>'.$value['jam_11'][0].'</td>
                        <td rowspan='.$rowspan.' class="bg-danger">Rest</td>
                        <td>'.$value['jam_13'][0].'</td>
                        <td>'.$value['jam_14'][0].'</td>
                        <td>'.$value['jam_15'][0].'</td>
                        <td>'.$value['jam_16'][0].'</td>
                        <td>'.$value['jam_17'][0].'</td>
                        <td>'.$value['jam_18'][0].'</td>
                        ';
            // sum
                $angka = 7;
                $sumQty['jam_'.$angka]=array_sum($value['jam_'.$angka]);
                    $color['jam_'.$angka] = $this->checkColorSum($sumQty['jam_'.$angka],$value['eolr'][0]);
                $angka = 8;
                $sumQty['jam_'.$angka]=array_sum($value['jam_'.$angka]);
                    $color['jam_'.$angka] = $this->checkColorSum($sumQty['jam_'.$angka],$value['eolr'][0]);
                $angka = 9;
                $sumQty['jam_'.$angka]=array_sum($value['jam_'.$angka]);
                    $color['jam_'.$angka] = $this->checkColorSum($sumQty['jam_'.$angka],$value['eolr'][0]);
                $angka = 10;
                $sumQty['jam_'.$angka]=array_sum($value['jam_'.$angka]);
                    $color['jam_'.$angka] = $this->checkColorSum($sumQty['jam_'.$angka],$value['eolr'][0]);
                $angka = 11;
                $sumQty['jam_'.$angka]=array_sum($value['jam_'.$angka]);
                    $color['jam_'.$angka] = $this->checkColorSum($sumQty['jam_'.$angka],$value['eolr'][0]);
                $angka = 13;
                $sumQty['jam_'.$angka]=array_sum($value['jam_'.$angka]);
                    $color['jam_'.$angka] = $this->checkColorSum($sumQty['jam_'.$angka],$value['eolr'][0]);
                $angka = 14;
                $sumQty['jam_'.$angka]=array_sum($value['jam_'.$angka]);
                    $color['jam_'.$angka] = $this->checkColorSum($sumQty['jam_'.$angka],$value['eolr'][0]);
                $angka = 15;
                $sumQty['jam_'.$angka]=array_sum($value['jam_'.$angka]);
                    $color['jam_'.$angka] = $this->checkColorSum($sumQty['jam_'.$angka],$value['eolr'][0]);
                $angka = 16;
                $sumQty['jam_'.$angka]=array_sum($value['jam_'.$angka]);
                    $color['jam_'.$angka] = $this->checkColorSum($sumQty['jam_'.$angka],$value['eolr'][0]);
                $angka = 17;
                $sumQty['jam_'.$angka]=array_sum($value['jam_'.$angka]);
                    $color['jam_'.$angka] = $this->checkColorSum($sumQty['jam_'.$angka],$value['eolr'][0]);
                $angka = 18;
                $sumQty['jam_'.$angka]=array_sum($value['jam_'.$angka]);
                    $color['jam_'.$angka] = $this->checkColorSum($sumQty['jam_'.$angka],$value['eolr'][0]);
                $sum_hour.='<tr>
                                <td class="bg-secondary">Total</td>
                                <td class="bg-'.$color['jam_7'].'">'.$sumQty['jam_7'].'</td>
                                <td class="bg-'.$color['jam_8'].'">'.$sumQty['jam_8'].'</td>
                                <td class="bg-'.$color['jam_9'].'">'.$sumQty['jam_9'].'</td>
                                <td class="bg-'.$color['jam_10'].'">'.$sumQty['jam_10'].'</td>
                                <td class="bg-'.$color['jam_11'].'">'.$sumQty['jam_11'].'</td>
                                <td class="bg-'.$color['jam_13'].'">'.$sumQty['jam_13'].'</td>
                                <td class="bg-'.$color['jam_14'].'">'.$sumQty['jam_14'].'</td>
                                <td class="bg-'.$color['jam_15'].'">'.$sumQty['jam_15'].'</td>
                                <td class="bg-'.$color['jam_16'].'">'.$sumQty['jam_16'].'</td>
                                <td class="bg-'.$color['jam_17'].'">'.$sumQty['jam_17'].'</td>
                                <td class="bg-'.$color['jam_18'].'">'.$sumQty['jam_18'].'</td>
                            </tr>';
            // convert to %
                $angka = 7;
                $percentQty['jam_'.$angka]=number_format((array_sum($value['jam_'.$angka])/$value['eolr'][0])*100,2);
                    $color['jam_'.$angka] = $this->checkColorPercent($percentQty['jam_'.$angka]);
                $angka = 8;
                $percentQty['jam_'.$angka]=number_format((array_sum($value['jam_'.$angka])/$value['eolr'][0])*100,2);
                    $color['jam_'.$angka] = $this->checkColorPercent($percentQty['jam_'.$angka]);
                $angka = 9;
                $percentQty['jam_'.$angka]=number_format((array_sum($value['jam_'.$angka])/$value['eolr'][0])*100,2);
                    $color['jam_'.$angka] = $this->checkColorPercent($percentQty['jam_'.$angka]);
                $angka = 10;
                $percentQty['jam_'.$angka]=number_format((array_sum($value['jam_'.$angka])/$value['eolr'][0])*100,2);
                    $color['jam_'.$angka] = $this->checkColorPercent($percentQty['jam_'.$angka]);
                $angka = 11;
                $percentQty['jam_'.$angka]=number_format((array_sum($value['jam_'.$angka])/$value['eolr'][0])*100,2);
                    $color['jam_'.$angka] = $this->checkColorPercent($percentQty['jam_'.$angka]);
                $angka = 13;
                $percentQty['jam_'.$angka]=number_format((array_sum($value['jam_'.$angka])/$value['eolr'][0])*100,2);
                    $color['jam_'.$angka] = $this->checkColorPercent($percentQty['jam_'.$angka]);
                $angka = 14;
                $percentQty['jam_'.$angka]=number_format((array_sum($value['jam_'.$angka])/$value['eolr'][0])*100,2);
                    $color['jam_'.$angka] = $this->checkColorPercent($percentQty['jam_'.$angka]);
                $angka = 15;
                $percentQty['jam_'.$angka]=number_format((array_sum($value['jam_'.$angka])/$value['eolr'][0])*100,2);
                    $color['jam_'.$angka] = $this->checkColorPercent($percentQty['jam_'.$angka]);
                $angka = 16;
                $percentQty['jam_'.$angka]=number_format((array_sum($value['jam_'.$angka])/$value['eolr'][0])*100,2);
                    $color['jam_'.$angka] = $this->checkColorPercent($percentQty['jam_'.$angka]);
                $angka = 17;
                $percentQty['jam_'.$angka]=number_format((array_sum($value['jam_'.$angka])/$value['eolr'][0])*100,2);
                    $color['jam_'.$angka] = $this->checkColorPercent($percentQty['jam_'.$angka]);
                $angka = 18;
                $percentQty['jam_'.$angka]=number_format((array_sum($value['jam_'.$angka])/$value['eolr'][0])*100,2);
                    $color['jam_'.$angka] = $this->checkColorPercent($percentQty['jam_'.$angka]);
                $percent_hour.='<tr>
                                <td class="bg-secondary">%</td>
                                <td class="bg-'.$color['jam_7'].'">'.$percentQty['jam_7'].'%</td>
                                <td class="bg-'.$color['jam_8'].'">'.$percentQty['jam_8'].'%</td>
                                <td class="bg-'.$color['jam_9'].'">'.$percentQty['jam_9'].'%</td>
                                <td class="bg-'.$color['jam_10'].'">'.$percentQty['jam_10'].'%</td>
                                <td class="bg-'.$color['jam_11'].'">'.$percentQty['jam_11'].'%</td>
                                <td class="bg-'.$color['jam_13'].'">'.$percentQty['jam_13'].'%</td>
                                <td class="bg-'.$color['jam_14'].'">'.$percentQty['jam_14'].'%</td>
                                <td class="bg-'.$color['jam_15'].'">'.$percentQty['jam_15'].'%</td>
                                <td class="bg-'.$color['jam_16'].'">'.$percentQty['jam_16'].'%</td>
                                <td class="bg-'.$color['jam_17'].'">'.$percentQty['jam_17'].'%</td>
                                <td class="bg-'.$color['jam_18'].'">'.$percentQty['jam_18'].'%</td>
                            </tr>';
            //next Tr
                for ($i=1; $i < count($value['po']); $i++) {
                    $last_rowspan = '';
                    if ($i==count($value['po'])) {
                        $last_rowspan = 'rowspan="2"';
                    }
                    $new_tr.='<tr>
                                <td '.$last_rowspan.'>'.$value['po'][$i].'</td>
                                <td>'.$value['jam_7'][$i].'</td>
                                <td>'.$value['jam_8'][$i].'</td>
                                <td>'.$value['jam_9'][$i].'</td>
                                <td>'.$value['jam_10'][$i].'</td>
                                <td>'.$value['jam_11'][$i].'</td>
                                <td>'.$value['jam_13'][$i].'</td>
                                <td>'.$value['jam_14'][$i].'</td>
                                <td>'.$value['jam_15'][$i].'</td>
                                <td>'.$value['jam_16'][$i].'</td>
                                <td>'.$value['jam_17'][$i].'</td>
                                <td>'.$value['jam_18'][$i].'</td>
                            </tr>';
                }
            //main string table (first TR)
                $firstTr.='<tr>
                            <td style="vertical-align: middle;" rowspan="'.$rowspan.'">'.$key.'</td>
                            <td style="vertical-align: middle;" rowspan="'.$rowspan.'">'.$value['eolr'][0].'</td>
                            <td style="vertical-align: middle;" rowspan="'.$rowspan.'">
                                <div class="progress">
                                    <div class="progress-bar progress-bar-striped bg-danger" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">75%</div>
                                </div>
                            </td>
                            '.$po_string.'
                        </tr>'.$new_tr.$sum_hour.$percent_hour;

        }
        if ($firstTr=="") {
            $data = array(
                'colomn_not_found'=>'<tr><td colspan="16">Today there is no input data</td></tr>',
            );
        }else{
            $data=array(
                'firstTr'=>$firstTr,
            );
        }
        echo json_encode($data);
    }
        function checkColorSum($sumQty,$eolr)
        {
            if ($sumQty>=$eolr) {
                $color = 'success';
            }else{
                $color = 'danger';
            }
            return $color;
        }
        function checkColorPercent($sumQty)
        {
            if ($sumQty<50) {
                $color = 'danger';
            }else if ($sumQty>=100) {
                $color = 'success';
            }else if ($sumQty==0) {
                $color = 'secondary';
            }else{
                $color = 'primary';
            }
            return $color;
        }
    public function change_cell(Request $request)
    {
        $cell = $request->cell;
        $data_db = process::select('po')->where('cell',$cell)->groupBy('po')->get();
        $po='';
        foreach ($data_db as $a ) {
            $po .= '<option>'.$a->po.'</option>';
        }
        $data = array('po'=>$po);
        echo json_encode($data);
    }
    public function change_po(Request $request)
    {
        $cell = $request->cell;
        $po = $request->po;
        $data_db = process::select('*')->where('cell',$cell)->where('po',$po)->get();
        $style=[];
        $reg_or_wide=[];
        $clr_width=[];
        foreach ($data_db as $a ) {
            $style[$a->style]=$a->style;
            $reg_or_wide[$a->reg_or_wide]=$a->reg_or_wide;
            $clr_width[$a->clr_width]=$a->clr_width;
        }
        if (count($style)>1||count($reg_or_wide)>1||count($clr_width)>1) {
            $list_style = '';
            $list_wide = '';
            $list_width = '';

            foreach ($style as $key => $a) {
                $list_style.= '<option>'.$a.'</option>';
            }

            $data = array(
                'cell'=>$cell,
                'style'=>$list_style,
                'po'=>$po,
                'modal'=>'modal'
            );
            echo json_encode($data);
        }else{
            $data = array(
                'cell'=>$cell,
                'style'=>$style,
                'wide'=>$reg_or_wide,
                'po'=>$po,
                'width'=>$clr_width,
                'modal'=>'ga ada'
            );
            echo json_encode($data);
        }
    }
    public function change_modal_style(Request $request)
    {
        $po = $request->po;
        $cell = $request->cell;
        $style = $request->style;
        $list_wide = '';
        $list_width = '';

        $dataDB = process::where(['po'=>$po,'cell'=>$cell,'style'=>$style])->get();

        foreach ($dataDB as $a ) {
            $reg_or_wide[$a->reg_or_wide]=$a->reg_or_wide;
            $clr_width[$a->clr_width]=$a->clr_width;
        }
        foreach ($reg_or_wide as $key => $a) {
            $list_wide.= '<option>'.$a.'</option>';
        }
        foreach ($clr_width as $key => $a) {
            $list_width.= '<option>'.$a.'</option>';
        }

        $data = array(
            'list_wide'=>$list_wide,
            'list_width'=>$list_width
        );
        echo json_encode($data);
    }
    public function search_detail(Request $request)
    {
        $style = $request->style;
        $wide = $request->wide;
        $width = $request->width;
        $cell = $request->cell;
        $gender = '';
        $dataSize = '';
        $tdSize = '';
        $arr_size=[];
        $arr_size_qty = [];
        $data = [];
        $Cutting='';
        $Preparation = '';
        $Sewing = '';
        $Assembling = '';
        $Stockfit = '';

        $detail = ['style'=>$style,'reg_or_wide'=>$wide,'clr_width'=>$width,'cell'=>$cell];
        $dataDB = dailyBalance::where($detail)->get();
        $process = process::where($detail)->get();

        foreach ($dataDB as $a ) {
            $gender = $a->g;
            $arr_size_qty = [$a->size_1,$a->size_2,$a->size_3,$a->size_4,$a->size_5,$a->size_6,$a->size_7,$a->size_8,$a->size_9,$a->size_10,$a->size_11,$a->size_12,$a->size_13,$a->size_14,$a->size_15,$a->size_16,$a->size_17,$a->size_18,$a->size_19,$a->size_20,$a->size_21,$a->size_22,$a->size_23,$a->size_24,$a->size_25,$a->size_26,$a->size_27,$a->size_28,$a->size_29];
        }
        if ($gender) {
            $dataSize = DB::table('size_modes as a')
                            ->select('a.*')
                            ->join('gender_modes as b','a.id_size','=','b.id_size')
                            ->where('b.gender',$gender)->get();
            //search size
            foreach ($dataSize as $a) {
                $arr_size[]=$a->size;
                $tdSize .='<th class="remove" rowspan="2" style="vertical-align:middle">'.$a->size.'</th>';
            }

            $data= array(
                'tdSize'=>$tdSize,
                'gender'=>$gender,
            );
            if ($Cutting == '') {
                $dataCutting = $this->searchDataDinamic('Cutting', $arr_size_qty, $process, $arr_size);
                $cuttingTdQtySize = $dataCutting['tdQtySize'];
                $cuttingTdtotalQtySize = $dataCutting['tdtotalQtySize'];
                $cuttingThBalance = $dataCutting['thBalance'];
                $cuttingTdOutput = $dataCutting['tdOutput'];
                $cuttingTdDefect = $dataCutting['tdDefect'];
                $cuttingTdShortage = $dataCutting['tdShortage'];

                $data['cuttingTdQtySize']=$cuttingTdQtySize;
                $data['cuttingTdtotalQtySize']=$cuttingTdtotalQtySize;
                $data['cuttingThBalance']=$cuttingThBalance;
                $data['cuttingTdOutput']=$cuttingTdOutput;
                $data['cuttingTdDefect']=$cuttingTdDefect;
                $data['cuttingTdShortage']=$cuttingTdShortage;
            }
            if ($Preparation == '') {
                $dataPreparation = $this->searchDataDinamic('Preparation', $arr_size_qty, $process, $arr_size);
                $preparationTdQtySize = $dataPreparation['tdQtySize'];
                $preparationTdtotalQtySize = $dataPreparation['tdtotalQtySize'];
                $preparationThBalance = $dataPreparation['thBalance'];
                $preparationTdOutput = $dataPreparation['tdOutput'];
                $preparationTdDefect = $dataPreparation['tdDefect'];
                $preparationTdShortage = $dataPreparation['tdShortage'];

                $data['preparationTdQtySize']=$preparationTdQtySize;
                $data['preparationTdtotalQtySize']=$preparationTdtotalQtySize;
                $data['preparationThBalance']=$preparationThBalance;
                $data['preparationTdOutput']=$preparationTdOutput;
                $data['preparationTdDefect']=$preparationTdDefect;
                $data['preparationTdShortage']=$preparationTdShortage;
            }
            if ($Sewing == '') {
                $dataSewing = $this->searchDataDinamic('Sewing', $arr_size_qty, $process, $arr_size);
                $sewingTdQtySize = $dataSewing['tdQtySize'];
                $sewingTdtotalQtySize = $dataSewing['tdtotalQtySize'];
                $sewingThBalance = $dataSewing['thBalance'];
                $sewingTdOutput = $dataSewing['tdOutput'];
                $sewingTdDefect = $dataSewing['tdDefect'];
                $sewingTdShortage = $dataSewing['tdShortage'];

                $data['sewingTdQtySize']=$sewingTdQtySize;
                $data['sewingTdtotalQtySize']=$sewingTdtotalQtySize;
                $data['sewingThBalance']=$sewingThBalance;
                $data['sewingTdOutput']=$sewingTdOutput;
                $data['sewingTdDefect']=$sewingTdDefect;
                $data['sewingTdShortage']=$sewingTdShortage;
            }
            if ($Assembling == '') {
                $dataAssembling = $this->searchDataDinamic('Assembling', $arr_size_qty, $process, $arr_size);
                $assemblingTdQtySize = $dataAssembling['tdQtySize'];
                $assemblingTdtotalQtySize = $dataAssembling['tdtotalQtySize'];
                $assemblingThBalance = $dataAssembling['thBalance'];
                $assemblingTdOutput = $dataAssembling['tdOutput'];
                $assemblingTdDefect = $dataAssembling['tdDefect'];
                $assemblingTdShortage = $dataAssembling['tdShortage'];

                $data['assemblingTdQtySize']=$assemblingTdQtySize;
                $data['assemblingTdtotalQtySize']=$assemblingTdtotalQtySize;
                $data['assemblingThBalance']=$assemblingThBalance;
                $data['assemblingTdOutput']=$assemblingTdOutput;
                $data['assemblingTdDefect']=$assemblingTdDefect;
                $data['assemblingTdShortage']=$assemblingTdShortage;
            }
            if ($Stockfit == '') {
                $dataStockfit = $this->searchDataDinamic('Assembling', $arr_size_qty, $process, $arr_size);
                $stockfitTdQtySize = $dataStockfit['tdQtySize'];
                $stockfitTdtotalQtySize = $dataStockfit['tdtotalQtySize'];
                $stockfitThBalance = $dataStockfit['thBalance'];
                $stockfitTdOutput = $dataStockfit['tdOutput'];
                $stockfitTdDefect = $dataStockfit['tdDefect'];
                $stockfitTdShortage = $dataStockfit['tdShortage'];

                $data['stockfitTdQtySize']=$stockfitTdQtySize;
                $data['stockfitTdtotalQtySize']=$stockfitTdtotalQtySize;
                $data['stockfitThBalance']=$stockfitThBalance;
                $data['stockfitTdOutput']=$stockfitTdOutput;
                $data['stockfitTdDefect']=$stockfitTdDefect;
                $data['stockfitTdShortage']=$stockfitTdShortage;
            }

        }else{
            $data = array('alert'=>'Data Gender tidak di temukan');
        }
        echo json_encode($data);
    }
    public function search_po(Request $request)
    {
        $cell = $request->cell;
        $po = $request->po;
        $gender = '';
        $dataSize = '';
        $tdSize = '';
        $arr_size=[];
        $arr_size_qty = [];
        $data = [];
        $Cutting='';
        $Preparation = '';
        $Sewing = '';
        $Assembling = '';
        $Stockfit = '';

        $dataDB = dailyBalance::where(['cell'=>$cell,'po'=>$po])->get();

        $process = process::where(['cell'=>$cell,'po'=>$po])->get();

        foreach($dataDB as $a)
        {
            $gender = $a->g;
            $arr_size_qty = [$a->size_1,$a->size_2,$a->size_3,$a->size_4,$a->size_5,$a->size_6,$a->size_7,$a->size_8,$a->size_9,$a->size_10,$a->size_11,$a->size_12,$a->size_13,$a->size_14,$a->size_15,$a->size_16,$a->size_17,$a->size_18,$a->size_19,$a->size_20,$a->size_21,$a->size_22,$a->size_23,$a->size_24,$a->size_25,$a->size_26,$a->size_27,$a->size_28,$a->size_29];
        }
        if ($gender) {
            $dataSize = DB::table('size_modes as a')
                            ->select('a.*')
                            ->join('gender_modes as b','a.id_size','=','b.id_size')
                            ->where('b.gender',$gender)->get();
            //search size
            foreach ($dataSize as $a) {
                $arr_size[]=$a->size;
                $tdSize .='<th class="remove" rowspan="2" style="vertical-align:middle">'.$a->size.'</th>';
            }

            $data= array(
                'tdSize'=>$tdSize,
                'gender'=>$gender,
            );
            if ($Cutting == '') {
                $dataCutting = $this->searchDataDinamic('Cutting', $arr_size_qty, $process, $arr_size);
                $cuttingTdQtySize = $dataCutting['tdQtySize'];
                $cuttingTdtotalQtySize = $dataCutting['tdtotalQtySize'];
                $cuttingThBalance = $dataCutting['thBalance'];
                $cuttingTdOutput = $dataCutting['tdOutput'];
                $cuttingTdDefect = $dataCutting['tdDefect'];
                $cuttingTdShortage = $dataCutting['tdShortage'];

                $data['cuttingTdQtySize']=$cuttingTdQtySize;
                $data['cuttingTdtotalQtySize']=$cuttingTdtotalQtySize;
                $data['cuttingThBalance']=$cuttingThBalance;
                $data['cuttingTdOutput']=$cuttingTdOutput;
                $data['cuttingTdDefect']=$cuttingTdDefect;
                $data['cuttingTdShortage']=$cuttingTdShortage;
            }
            if ($Preparation == '') {
                $dataPreparation = $this->searchDataDinamic('Preparation', $arr_size_qty, $process, $arr_size);
                $preparationTdQtySize = $dataPreparation['tdQtySize'];
                $preparationTdtotalQtySize = $dataPreparation['tdtotalQtySize'];
                $preparationThBalance = $dataPreparation['thBalance'];
                $preparationTdOutput = $dataPreparation['tdOutput'];
                $preparationTdDefect = $dataPreparation['tdDefect'];
                $preparationTdShortage = $dataPreparation['tdShortage'];

                $data['preparationTdQtySize']=$preparationTdQtySize;
                $data['preparationTdtotalQtySize']=$preparationTdtotalQtySize;
                $data['preparationThBalance']=$preparationThBalance;
                $data['preparationTdOutput']=$preparationTdOutput;
                $data['preparationTdDefect']=$preparationTdDefect;
                $data['preparationTdShortage']=$preparationTdShortage;
            }
            if ($Sewing == '') {
                $dataSewing = $this->searchDataDinamic('Sewing', $arr_size_qty, $process, $arr_size);
                $sewingTdQtySize = $dataSewing['tdQtySize'];
                $sewingTdtotalQtySize = $dataSewing['tdtotalQtySize'];
                $sewingThBalance = $dataSewing['thBalance'];
                $sewingTdOutput = $dataSewing['tdOutput'];
                $sewingTdDefect = $dataSewing['tdDefect'];
                $sewingTdShortage = $dataSewing['tdShortage'];

                $data['sewingTdQtySize']=$sewingTdQtySize;
                $data['sewingTdtotalQtySize']=$sewingTdtotalQtySize;
                $data['sewingThBalance']=$sewingThBalance;
                $data['sewingTdOutput']=$sewingTdOutput;
                $data['sewingTdDefect']=$sewingTdDefect;
                $data['sewingTdShortage']=$sewingTdShortage;
            }
            if ($Assembling == '') {
                $dataAssembling = $this->searchDataDinamic('Assembling', $arr_size_qty, $process, $arr_size);
                $assemblingTdQtySize = $dataAssembling['tdQtySize'];
                $assemblingTdtotalQtySize = $dataAssembling['tdtotalQtySize'];
                $assemblingThBalance = $dataAssembling['thBalance'];
                $assemblingTdOutput = $dataAssembling['tdOutput'];
                $assemblingTdDefect = $dataAssembling['tdDefect'];
                $assemblingTdShortage = $dataAssembling['tdShortage'];

                $data['assemblingTdQtySize']=$assemblingTdQtySize;
                $data['assemblingTdtotalQtySize']=$assemblingTdtotalQtySize;
                $data['assemblingThBalance']=$assemblingThBalance;
                $data['assemblingTdOutput']=$assemblingTdOutput;
                $data['assemblingTdDefect']=$assemblingTdDefect;
                $data['assemblingTdShortage']=$assemblingTdShortage;
            }
            if ($Stockfit == '') {
                $dataStockfit = $this->searchDataDinamic('Assembling', $arr_size_qty, $process, $arr_size);
                $stockfitTdQtySize = $dataStockfit['tdQtySize'];
                $stockfitTdtotalQtySize = $dataStockfit['tdtotalQtySize'];
                $stockfitThBalance = $dataStockfit['thBalance'];
                $stockfitTdOutput = $dataStockfit['tdOutput'];
                $stockfitTdDefect = $dataStockfit['tdDefect'];
                $stockfitTdShortage = $dataStockfit['tdShortage'];

                $data['stockfitTdQtySize']=$stockfitTdQtySize;
                $data['stockfitTdtotalQtySize']=$stockfitTdtotalQtySize;
                $data['stockfitThBalance']=$stockfitThBalance;
                $data['stockfitTdOutput']=$stockfitTdOutput;
                $data['stockfitTdDefect']=$stockfitTdDefect;
                $data['stockfitTdShortage']=$stockfitTdShortage;
            }

        }else{
            $data = array('alert'=>'Data Gender tidak di temukan');
        }
        echo json_encode($data);
    }
    public function searchDataDinamic($area, $arr_size_qty, $process, $arr_size)
    {
        $tdQtySize='';
        $thBalance = '<th class="remove">Balance</th>';
        $tdOutput = '<td class="remove">Output</td>';
        $tdDefect = '<td class="remove">Defect</td>';
        $tdShortage = '<td class="remove">Shortage</td>';
        $totalQtySize = 0;

         //search qty
         for ($i=0; $i < count($arr_size_qty); $i++) {
            $valueTdOutput = 0;
            $valueTdDefect = 0;
            $valueTdShortage = 0;
            $qty_size = 0;
            $qty_size =0;
            $qty_size =0;
            $color = '';
            $totalQtySize+=$arr_size_qty[$i];
            $tdQtySize .='<th class="remove">'.$arr_size_qty[$i].'</th>';
            for ($y=0; $y < count($process); $y++) {
                if ($arr_size[$i] == $process[$y]['size']) {
                    if ($process[$y]['area']==$area) {
                        if ($process[$y]['type']=='output') {
                            $valueTdOutput += $process[$y]['qty'];
                        }else if ($process[$y]['type']=='s') {
                            $valueTdDefect += $process[$y]['qty'];
                        }else{
                            $valueTdShortage += $process[$y]['qty'];
                        }
                    }
                }
            }
            $qty_size = $arr_size_qty[$i]-$valueTdOutput;
            //color
                if ($qty_size==0) {
                    $color = 'green';
                }else{
                    $color = 'red';
                }
            //change 0 to null
                if ($valueTdOutput == 0) {
                    $valueTdOutput='';
                }
                if ($valueTdDefect == 0) {
                    $valueTdDefect='';
                }
                if ($valueTdShortage == 0) {
                    $valueTdShortage='';
                }
            $thBalance.='<th class="remove" style="color:'.$color.'">'.$qty_size.'</th>';
            $tdOutput.='<td class="remove">'.$valueTdOutput.'</td>';
            $tdDefect.='<td class="remove">'.$valueTdDefect.'</td>';
            $tdShortage.='<td class="remove">'.$valueTdShortage.'</td>';
        }
        $tdtotalQtySize = '<th class="remove">'.$totalQtySize.'</th>';
        $data = array(
            'tdQtySize'=>$tdQtySize,
            'thBalance'=>$thBalance,
            'tdOutput'=>$tdOutput,
            'tdDefect'=>$tdDefect,
            'tdShortage'=>$tdShortage,
            'tdtotalQtySize'=>$tdtotalQtySize,
        );
        return $data;
    }
}
