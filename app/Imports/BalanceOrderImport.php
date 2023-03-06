<?php

namespace App\Imports;

use Carbon\Carbon;
use App\Models\balanceOrder;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class BalanceOrderImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    public function transformDate($value, $format = 'Y-m-d')
    {
        try {
            return \Carbon\Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($value));
        } catch (\ErrorException $e) {
            return \Carbon\Carbon::createFromFormat($format, $value);
        }
    }

    public function model(array $row)
    {
        if (empty($row['size_1'])) {
            $row['size_1']=0;
        }
        if (empty($row['size_2'])) {
            $row['size_2']=0;
        }
        if (empty($row['size_3'])) {
            $row['size_3']=0;
        }
        if (empty($row['size_4'])) {
            $row['size_4']=0;
        }
        if (empty($row['size_5'])) {
            $row['size_5']=0;
        }
        if (empty($row['size_6'])) {
            $row['size_6']=0;
        }
        if (empty($row['size_7'])) {
            $row['size_7']=0;
        }
        if (empty($row['size_8'])) {
            $row['size_8']=0;
        }
        if (empty($row['size_9'])) {
            $row['size_9']=0;
        }
        if (empty($row['size_10'])) {
            $row['size_10']=0;
        }
        if (empty($row['size_11'])) {
            $row['size_11']=0;
        }
        if (empty($row['size_12'])) {
            $row['size_12']=0;
        }
        if (empty($row['size_13'])) {
            $row['size_13']=0;
        }
        if (empty($row['size_14'])) {
            $row['size_14']=0;
        }
        if (empty($row['size_15'])) {
            $row['size_15']=0;
        }
        if (empty($row['size_16'])) {
            $row['size_16']=0;
        }
        if (empty($row['size_17'])) {
            $row['size_17']=0;
        }
        if (empty($row['size_18'])) {
            $row['size_18']=0;
        }
        if (empty($row['size_19'])) {
            $row['size_19']=0;
        }
        if (empty($row['size_20'])) {
            $row['size_20']=0;
        }
        if (empty($row['size_21'])) {
            $row['size_21']=0;
        }
        if (empty($row['size_22'])) {
            $row['size_22']=0;
        }
        if (empty($row['size_23'])) {
            $row['size_23']=0;
        }
        if (empty($row['size_24'])) {
            $row['size_24']=0;
        }
        if (empty($row['size_25'])) {
            $row['size_25']=0;
        }
        if (empty($row['size_26'])) {
            $row['size_26']=0;
        }
        if (empty($row['size_27'])) {
            $row['size_27']=0;
        }
        if (empty($row['size_28'])) {
            $row['size_28']=0;
        }
        if (empty($row['size_29'])) {
            $row['size_29']=0;
        }


        return new balanceOrder([
            'buymonth' => $row['buymonth'],
            'cell' => $row['cell'],
            'style' => $row['style'],
            'wide' => $row['wide'],
            'g' => $row['gender'],
            'po' => $row['po'],
            'xfd' => $this->transformDate($row['xfd']),
            'qty' => $row['qty'],
            'size_1' => $row['size_1'],
            'size_2' => $row['size_2'],
            'size_3' => $row['size_3'],
            'size_4' => $row['size_4'],
            'size_5' => $row['size_5'],
            'size_6' => $row['size_6'],
            'size_7' => $row['size_7'],
            'size_8' => $row['size_8'],
            'size_9' => $row['size_9'],
            'size_10' => $row['size_10'],
            'size_11' => $row['size_11'],
            'size_12' => $row['size_12'],
            'size_13' => $row['size_13'],
            'size_14' => $row['size_14'],
            'size_15' => $row['size_15'],
            'size_16' => $row['size_16'],
            'size_17' => $row['size_17'],
            'size_18' => $row['size_18'],
            'size_19' => $row['size_19'],
            'size_20' => $row['size_20'],
            'size_21' => $row['size_21'],
            'size_22' => $row['size_22'],
            'size_23' => $row['size_23'],
            'size_24' => $row['size_24'],
            'size_25' => $row['size_25'],
            'size_26' => $row['size_26'],
            'size_27' => $row['size_27'],
            'size_28' => $row['size_28'],
            'size_29' => $row['size_29'],
        ]);
    }
}

