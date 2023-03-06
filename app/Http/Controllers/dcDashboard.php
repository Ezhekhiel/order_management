<?php

namespace App\Http\Controllers;

use DB;
use App\Models\balanceOrder;
use Illuminate\Http\Request;

class dcDashboard extends Controller
{
    public function index()
    {
        return view('distribution_center.dashboard');
    }
    public function main()
    {
        $arrayResult=[];
        $jam = ['7','8','9','10','11','13','14','15','16','17','18'];
        $getDataCell = db::table('dc__balance_order as a')->select('a.cell','b.eolr as target')
                        ->join('cell_targets as b','a.cell','=','b.cell')
                        ->groupby('cell')->get();
        $getDatabase = [];
        $cell = [];
        foreach ($getDataCell as $key => $a ) {
            $cell[]=$a->cell;
            $getDatabase[$a->cell]= db::table('dc__spk as a')
                            ->select('b.cell','a.jam','a.status',
                                db::raw('(sum(a.qty_set)/'.$a->target.')*100 as percent'),
                                db::raw('case when (sum(a.qty_set)/'.$a->target.')*100=100 and a.status="TRANSFER" then "bg-success"
                                when (sum(a.qty_set)/'.$a->target.')*100=100 then "bg-info" else "bg-warning" end as color'))
                            ->join('cell_targets as b','a.cell','=','b.cell')
                            ->where('a.cell',$a->cell)
                            ->groupby('a.jam')->orderBy('b.id')->orderBy('a.jam')
                            ->get();
        }
        $color='bg-danger';
        for ($i=0; $i < count($jam); $i++) {
            for ($y=0; $y < count($getDatabase); $y++) {
                if (isset($getDatabase[$y])) {
                    for ($b=0; $b < count($getDatabase[$y]); $b++) {
                        if ($jam[$i]==$getDatabase[$y][$b]->jam) {
                            $arrayResult[]=array(
                                'cell'=>$getDatabase[$y][$b]->cell,
                                'percent'=>$getDatabase[$y][$b]->percent,
                                'color'=>$getDatabase[$y][$b]->color,
                                'status'=>$getDatabase[$y][$b]->status,
                                'jam'=>$getDatabase[$y][$b]->jam);
                        }
                    }
                }
            }
        }
        $data = array(
            'arrayResult'=>$arrayResult,
            'jam'=>$jam,
            'cell'=>$cell
        );
        return json_encode($data);
    }
}

