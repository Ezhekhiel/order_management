<?php

namespace App\Http\Controllers;

use App\Models\balanceOrder;
use Illuminate\Http\Request;

class listCellController extends Controller
{
    public function list_cell()
    {
        $data = balanceOrder::where('cell','!=','SU')->groupby('cell')->orderby('id')->GET();
        $list_cell = '<option>Select Cell</option>';
        foreach ($data as $a ) {
            $list_cell.='<option value="'.$a->cell.'">'.$a->cell.'</option>';
        }
        $data = array('list_cell'=>$list_cell);
        return json_encode($data);
    }
}
