<?php

namespace App\Http\Controllers;

use App\Models\balanceOrder;
use Illuminate\Http\Request;
use App\Imports\BalanceOrderImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Response;

class dcDatabase extends Controller
{
    public function index(Request $request)
    {
        return view('distribution_center.database');
    }
    public function import(Request $request)
    {
        $this->validate($request, [
			'file' => 'required',
		]);
        $import = new BalanceOrderImport;

        $data = Excel::toArray($import, request()->file('file'));
        for ($i=0; $i < count($data[0]); $i++) {
            //convert index
            foreach ($data[0][$i] as $key => $value) {
                if ($key != "36" && $key != "dummy") {
                    $resultArray[$i][$key]=$value;
                    //cek double buymonth
                        $dataDb = balanceOrder::where('buymonth',$value)->delete();
                        Excel::import(new BalanceOrderImport, request()->file('file'));
                        return redirect()->back()->with(['status'=>"Data Buymonth ".$value." telah terupdate!",'color'=>'alert-success']);
                            // return redirect()->back()->with(['status'=>"Data Buymonth ".$dataDb->buymonth." sudah ada",'color'=>'alert-danger','alert'=>'buymonth']);
                    //cek error kutip
                        if (strpos($value,"'")!==false) {
                            // return response()->json(['message'=>'Kutip Terditeksi']);
                            return redirect()->back()->with(['status'=>"Pastikan semua value tidak terditeksi kutip ( ' ) !",'color'=>'alert-danger']);
                        }
                }
            }
        }
        Excel::import(new BalanceOrderImport, request()->file('file'));
        return redirect()->back()->with(['status'=>"Save berhasil !",'color'=>'alert-success']);
        // return redirect('/')->with('success', 'All good!');
    }
    public function download(Request $request)
    {
        $file= public_path(). "/Files/Contoh Import/Detail PO Order by Production.xlsx";
        $headers = array(
                            'Content-Type: application/pdf',
                        );

        return Response::download($file, 'Detail PO Order by Production.xlsx', $headers);
    }
}
