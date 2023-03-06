<?php
    class dcController extends Controller{
        public function incoming_save(Request $request)
        {
            $logistic = $request->logistic;
            $cell = $request->cell;
            $po = $request->po;
            $article = $request->article;
            $qty_po = $request->qty_po;
            $date = $request->date;
            $gender = $request->gender;
            $qty_incoming = $request->qty_incoming;
            $cekNull=0;
            $query = [];
            $status_po = '';
            $arr_error = [];
            //get cell id
                $cell_id = cell_target::select('id')->where('cell',$cell)->first();
            //alert validation
                if ($logistic == '') {
                    $alert = 'gagal';
                    $text = 'Data Logistic Harus di isi';
                    $data=array(
                        'alert'=>$alert,
                        'text'=>$text,
                        'color'=>'danger'
                    );
                    return json_encode($data);
                }
                if ($cell == '') {
                    $alert = 'gagal';
                    $text = 'Data Cell Harus di isi';
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
                if ($article == '') {
                    $alert = 'gagal';
                    $text = 'Data Article Harus di isi';
                    $data=array(
                        'alert'=>$alert,
                        'text'=>$text,
                        'color'=>'danger'
                    );
                    return json_encode($data);
                }
                if ($qty_po == '') {
                    $alert = 'gagal';
                    $text = 'Data Article Harus di isi';
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
                if ($gender == '') {
                    $alert = 'gagal';
                    $text = 'Data Gender Harus di isi';
                    $data=array(
                        'alert'=>$alert,
                        'text'=>$text,
                        'color'=>'danger'
                    );
                    return json_encode($data);
                }
                // cek validation po detail
                    $cek_po = dc_incoming::where('po',$po)->get();
                    if (count($cek_po)>0) {
                        $count_cek_po = 0;
                        foreach ($cek_po as $a ) {
                            if ($cell_id->id != $a->cell_id ) {
                                $count_cek_po++;
                                $arr_error[$count_cek_po][]='cell';
                                $arr_error[$count_cek_po][]=$a->cell_id;
                                $arr_error[$count_cek_po][]=$cell;
                                $status_po = 'not the same';
                            }
                            if ($article != $a->article ) {
                                $count_cek_po++;
                                $arr_error[$count_cek_po][]='article';
                                $arr_error[$count_cek_po][]=$a->article;
                                $arr_error[$count_cek_po][]=$article;
                                $status_po = 'not the same';
                            }
                            if ($qty_po != $a->qty_po ) {
                                $count_cek_po++;
                                $arr_error[$count_cek_po]['title']='qty_po';
                                $arr_error[$count_cek_po]['old']=$a->qty_po;
                                $arr_error[$count_cek_po]['new']=(int) $qty_po;
                                $status_po = 'not the same';
                            }
                            if ($gender != $a->gender ) {
                                $count_cek_po++;
                                $arr_error[$count_cek_po]['title']='gender';
                                $arr_error[$count_cek_po]['old']=$a->gender;
                                $arr_error[$count_cek_po]['new']=$gender;
                                $status_po = 'not the same';
                            }
                        }
                    }
            //save
                if ($status_po == '')
                {
                    for ($i=0; $i < count($qty_incoming); $i++) {
                        if (isset($qty_incoming[$i])||$qty_incoming[$i]=='0') {
                            $cekNull++;
                            $qty_incoming[$i]=(int)$qty_incoming[$i];
                        }else{
                            $qty_incoming[$i]=0;
                        }
                        $query['size_'.$i+1]=$qty_incoming[$i];
                        $query['logistic']=$logistic;
                        $query['cell_id']=$cell_id->id;
                        $query['po']=$po;
                        $query['article']=$article;
                        $query['qty_po']=$qty_po;
                        $query['date']=$date;
                        $query['gender']=$gender;
                    }
                    if ($cekNull>0) {
                        try {
                            $save = dc_incoming::create($query);
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
                        'color'=>'success'
                    );
                    return json_encode($data);
                }else{
                    $table_not_same='';
                    foreach ($arr_error as $key => $a) {
                        $table_not_same.='
                            <tr>
                                <th>'.$a['title'].'</th>
                                <th>'.$a['old'].'</th>
                                <th>'.$a['new'].'</th>
                                <th><input type="radio" value="ubah" name="'.$a['title'].'-1[]" checked></th>
                                <th><input type="radio" value="jangan" name="'.$a['title'].'-2[]"></th>
                            </tr>
                        ';
                    }
                    $data = array(
                        'open'=>'Modal not the same',
                        'arr_error'=>$arr_error,
                        'table_not_same'=>$table_not_same
                    );
                    return json_encode($data);
                }
        }
    }
