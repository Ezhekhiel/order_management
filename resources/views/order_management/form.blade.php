@extends('layouts.app_index')

@section('content')
<br>
<style>
    #pageMessages {
        position: fixed;
        bottom: 15px;
        right: 15px;
        width: 30%;
    }

    .alert {
        position: relative;
    }

    .alert .close {
        position: absolute;
        top: 5px;
        right: 5px;
        font-size: 1em;
    }

    .alert .fa {
        margin-right:.3em;
    }
</style>
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-11">
            <div class="card">
                <div class="body">
                    <div class="row">
                        <div class="col-12">
                            <div class="card-header bg-secondary">
                                <h3 class="card-title">BERIKUT INI MP TARGET FOR VISUAL IT {{ strtoupper(date('M - Y')) }} :</h3>
                            </div>
                            <div class="card-body">
                                <div style="overflow-x:auto; font-size:85%">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr id="tr_header_cell" style="vertical-align: middle;"></tr>
                                        </thead>
                                        <tbody>
                                            <tr id="tr_eolr"></tr>
                                            <tr id="tr_mp_direct"></tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row justify-content-center m-4">
        <div class="col-6">
            <div class="card">
                <div class="body">
                    <div class="row">
                        <div class="col-12">
                            <div class="card-header bg-secondary">
                                <h3 class="card-title">FORM INPUT</h3>
                            </div>
                            <div class="card-body" style="font-size:85%">
                                <div class="row">
                                    <div class="col-4 text-center bg-success m-2 p-2">CELL / AREA</div>
                                    <div class="col-6 text-center">
                                        {{-- <input type="text" class="form-control reset-onclick" list="cell_list" name="cell_name" id="cell_id"> --}}
                                        <select name="cell_name" id="cell_id" class="form-control"></select>
                                    </div>
                                    <div class="col-4 text-center bg-success m-2 p-2">PO</div>
                                    <div class="col-6 text-center">
                                        <input type="text" class="form-control reset-onclick" list="po_list" name="po_name" id="po_id">
                                        <datalist id="po_list"></datalist>
                                    </div>
                                    <div class="col-4 text-center bg-success m-2 p-2">PROCESS</div>
                                    <div class="col-6 text-center">
                                        <select name="process_name" id="process_id" class="form-control">
                                            <option value="">Select Area</option>
                                            <option value="Cutting">Cutting</option>
                                            <option value="Preparation">Preparation</option>
                                            <option value="Sewing">Sewing</option>
                                            <option value="Assembling">Assembling</option>
                                            <option value="Stockfit">Stockfit</option>
                                        </select>
                                    </div>
                                    <div class="col-4 text-center bg-success m-2 p-2">DATE</div>
                                    <div class="col-6 text-center">
                                        <input type="date" class="form-control" readonly name="date_name" id="date_id">
                                    </div>
                                    <div class="col-4 text-center bg-success m-2 p-2">QTY ORDER</div>
                                    <div class="col-6 text-center">
                                        <input type="number" class="form-control" readonly name="qty_name" id="qty_id">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="card">
                <div class="body">
                    <div class="row">
                        <div class="col-12">
                            <div class="card-header bg-secondary">
                                <h3 class="card-title">DETAIL ORDER</h3>
                            </div>
                            <div class="card-body"style="font-size:85%">
                                <div class="row">
                                    <div class="col-4 text-center bg-success m-2 p-2 po_detail" style="display: none">STYLE - WIDE - WIDTH</div>
                                    <div class="col-6 text-center po_detail" style="display: none">
                                        <input type="text" class="form-control reset-onclick" list="detail_list" name="detail_name" id="detail_id">
                                        <datalist id="detail_list"></datalist>
                                    </div>
                                    <div class="col-4 text-center bg-success m-2 p-2">BM</div>
                                    <div class="col-6 text-center">
                                        <input type="text" class="form-control" readonly name="bm_name" id="bm_id">
                                    </div>
                                    <div class="col-4 text-center bg-success m-2 p-2">STYLE</div>
                                    <div class="col-6 text-center">
                                        <input type="text" class="form-control" readonly name="style_name" id="style_id">
                                    </div>
                                    <div class="col-4 text-center bg-success m-2 p-2">DUE DATE</div>
                                    <div class="col-6 text-center">
                                        <input type="text" class="form-control" readonly name="due_date_name" id="due_date_id">
                                    </div>
                                    <div class="col-4 text-center bg-success m-2 p-2">BALANCE</div>
                                    <div class="col-6 text-center">
                                        <input type="number" class="form-control" readonly name="balance_name" id="balance_id">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="body">
                    <div class="row">
                        <div class="col-12">
                            <div class="card-header bg-secondary">
                                <h3 class="card-title">SIZE RUN</h3>
                            </div>
                            <div class="card-body">
                                <div style="overflow-x:auto;">
                                    <table class="table table-bordered">
                                        <thead class="text-center">
                                            <tr id="th_size_run" class="bg-secondary" style="vertical-align: middle;"></tr>
                                            <tr id="th_balance" style="vertical-align: middle"></tr>
                                        </thead>
                                        <tbody class="text-center">
                                            <tr id="td_output" style="vertical-align: middle"></tr>
                                            <tr id="td_defect" style="vertical-align: middle"></tr>
                                            <tr id="td_shortage" style="vertical-align: middle"></tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="pageMessages"></div>
<div class="modal fade" id="modal_cell_target" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update <a id="title_update_cell_target"></a></h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" action="#" id="form_update_cell_target" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-1">
                          <label for="title" id="modal_title_input" class="form-label"> </label> <small class="text-danger" id="old_val"></small>
                          <input type="number" class="form-control" name="newData" id="newData_cell_target" aria-describedby="emailHelp">
                          <input type="hidden" name="id_cell_target" id="id_cell_target">
                          <input type="hidden" name="title_cell_target" id="title_cell_target">
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal_save" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel" style="text-transform:capitalize;">Save <a id="title_save"></a></h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" action="#" id="form_save" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-1">
                          <input type="number" class="form-control" id="id_value_save"autofocus name="value" aria-describedby="emailHelp">
                          <input type="hidden" name="size" id="id_size_save">
                          <input type="hidden" name="type" id="id_type_save">
                          <input type="hidden" name="area" id="id_area_save">
                          <input type="hidden" name="po" id="id_po_save">
                          <input type="hidden" name="detail" id="id_detail_save">
                          <input type="hidden" name="cell" id="id_cell_save">
                          <input type="hidden" name="qty_size" id="id_qty_size_save">
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@include('order_management.script.script_form')
@endsection

