<?php

namespace App\Http\Controllers;

use App\Models\cell_target;
use Illuminate\Http\Request;
use App\Models\dailyBalance_percobaan;
use DB;


class setMaterialController extends Controller
{
    public function index()
    {
        $cell_target = cell_target::get();
        return view('Set_material.form',['cell_target'=>$cell_target]);
    }
    public function main()
    {
        $cell_target = cell_target::get();
        $order_information = dailyBalance_percobaan::get();
        // default variable
            $cell_tr = '<th style="vertical-align: middle;">Cell</th>';
            $eolr_tr = '<th>EOLR</th>';
            $mp_tr = '<th>MP Direct</th>';
            $data_cell = [];
            $option_cell = '';
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
            foreach ($order_information as $a) {
                $data_cell[$a->cell]=$a->cell;
            }
            foreach ($data_cell as $key => $value ) {
                $option_cell.='<option value="'.$value.'">'.$value.'</option>';
            }

        $data = array(
            'cell_tr'=>$cell_tr,
            'eolr_tr'=>$eolr_tr,
            'mp_tr'=>$mp_tr,
            'option_cell'=>$option_cell,
        );
        echo json_encode($data);
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
            //parameter
                $option_po = '';
        $po_data = dailyBalance_percobaan::where('cell',$cell)->get();
        $qty_order = dailyBalance_percobaan::select(DB::raw('sum(qty) as qty'))->where('cell',$cell)->first();
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
}
