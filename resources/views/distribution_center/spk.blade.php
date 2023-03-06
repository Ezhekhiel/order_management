@extends('layouts.app_index')

@section('content')
<br>

<div class="container-fluid">
    <div class="row justify-content-center">
        <section class="col-lg-12 connectedSortable">
            <div class="card">
                <div class="card-header bg-secondary">
                    <h3 class="card-title">SPK INPUT</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body r-font">
                    @if (session('status'))
                        <div class="card">
                            <div class="card-body">
                                <div class="alert {{ session('color') }}" id="alert_incoming">
                                    {{ session('status') }}
                                </div>
                            </div>
                        </div>
                    @endif
                    {{-- <form action="#" method="post" id="form_incoming" enctype="multipart/form-data"> --}}
                        {{-- @csrf --}}
                        <div class="row d-flex border p-2">
                            <div class="col-6 border p-2 mt-2 mb-2">
                                <div class="row">
                                    <label for="cell_id" class="form-label">DATA INCOMING</label>
                                    <div class="col-3">
                                        <label for="cell_id" class="form-label">CELL</label>
                                        <select name="cell" id="cell_id" class="form-control"></select>
                                    </div>
                                    <div class="col-3">
                                        <label for="po_id" class="form-label">PO</label>
                                        <select name="po" id="po_id" class="form-control">
                                            <option value="">Select PO</option>
                                        </select>
                                    </div>
                                </div>
                                <label for="po_list_id" class="form-label mt-2">PO LIST</label>
                                <div style="overflow-x:auto;" class="border p-2 mb-2">
                                    <table class="table table-striped table-hover text-center">
                                      <thead>
                                          <tr>
                                              <th>BM</th>
                                              <th>PO</th>
                                              <th>WIDE</th>
                                              <th>XFD</th>
                                              <th>QTY INCOMING</th>
                                              <th>QTY ORDER</th>
                                              <th>%</th>
                                          </tr>
                                      </thead>
                                      <tbody id="tbody_po_list"></tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-6 border p-2 mt-2 mb-2">
                                <label for="po_list_id" class="form-label mt-2">DETAIL INCOMING</label>
                                <div style="overflow-x:auto;" class="border p-2 mb-2">
                                    <table class="table table-striped table-hover text-center" id="table_detail_incoming">
                                      <thead>
                                          <tr>
                                              <th style="vertical-align : middle;text-align:center;" rowspan="2">PO</th>
                                              <th style="vertical-align : middle;text-align:center;" rowspan="2">Size</th>
                                              <th style="vertical-align : middle;text-align:center;" colspan="5" id="th_komponen">Komponen</th>
                                              <th style="vertical-align : middle;text-align:center;" rowspan="2">QTY SET</th>
                                              <th style="vertical-align : middle;text-align:center;" rowspan="2">QTY SPK</th>
                                              {{-- <th style="vertical-align : middle;text-align:center;" rowspan="2">%</th> --}}
                                            </tr>
                                          <tr id="tr_aksesoris">
                                                <th>Upper</th>
                                                <th>Outsole</th>
                                                <th>Texon</th>
                                                <th>Insole</th>
                                          </tr>
                                      </thead>
                                      <tbody id="tbody_detail_incoming"></tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-12 border p-2">
                                <label for="po_list_id" class="form-label mt-2 mr-2">MAPPING CELL / JAM (BELUM TRANSFER)</label>
                                <select name="time" id="time_mapping_cell" disabled>
                                    <option value="sekarang">Sekarang</option>
                                    <option value="besok">Besok</option>
                                </select>
                                <div class="row justify-content-center">
                                    <div class="col-1 text-center">
                                        <label for="jam_7" class="form-label">07:00-08:00</label>
                                        <div class="progress">
                                            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="0" aria-valuemin="0" id="jam_7" aria-valuemax="100" style="width: 0%"></div>
                                        </div>
                                        <div class="display-progress-bar" style="font-size:95%" id="display_jam_7"></div>
                                    </div>
                                    <div class="col-1 text-center">
                                        <label for="jam_8" class="form-label">08:00-09:00</label>
                                        <div class="progress">
                                            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="0" aria-valuemin="0" id="jam_8" aria-valuemax="100" style="width: 0%"></div>
                                        </div>
                                        <div class="display-progress-bar" style="font-size:95%" id="display_jam_8"></div>
                                    </div>
                                    <div class="col-1 text-center">
                                        <label for="jam_9" class="form-label">09:00-10:00</label>
                                        <div class="progress">
                                            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="0" aria-valuemin="0" id="jam_9" aria-valuemax="100" style="width: 0%"></div>
                                        </div>
                                        <div class="display-progress-bar" style="font-size:95%" id="display_jam_9"></div>
                                    </div>
                                    <div class="col-1 text-center">
                                        <label for="jam_10" class="form-label">10:00-11:00</label>
                                        <div class="progress">
                                            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="0" aria-valuemin="0" id="jam_10" aria-valuemax="100" style="width: 0%"></div>
                                        </div>
                                        <div class="display-progress-bar" style="font-size:95%" id="display_jam_10"></div>
                                    </div>
                                    <div class="col-1 text-center">
                                        <label for="jam_11" class="form-label">11:00-12:00</label>
                                        <div class="progress">
                                            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="0" aria-valuemin="0" id="jam_11" aria-valuemax="100" style="width: 0%"></div>
                                        </div>
                                        <div class="display-progress-bar" style="font-size:95%" id="display_jam_11"></div>
                                    </div>
                                    <div class="col-1 text-center">
                                        <label for="jam_12" class="form-label">12:00-13:00</label>
                                        <h5 class="font-weight-bold">ISTIRAHAT</h5>
                                    </div>
                                    <div class="col-1 text-center">
                                        <label for="jam_13" class="form-label">13:00-14:00</label>
                                        <div class="progress">
                                            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="0" aria-valuemin="0" id="jam_13" aria-valuemax="100" style="width: 0%"></div>
                                        </div>
                                        <div class="display-progress-bar" style="font-size:95%" id="display_jam_13"></div>
                                    </div>
                                    <div class="col-1 text-center">
                                        <label for="jam_14" class="form-label">14:00-15:00</label>
                                        <div class="progress">
                                            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="0" aria-valuemin="0" id="jam_14" aria-valuemax="100" style="width: 0%"></div>
                                        </div>
                                        <div class="display-progress-bar" style="font-size:95%" id="display_jam_14"></div>
                                    </div>
                                    <div class="col-1 text-center">
                                        <label for="jam_15" class="form-label">15:00-16:00</label>
                                        <div class="progress">
                                            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="0" aria-valuemin="0" id="jam_15" aria-valuemax="100" style="width: 0%"></div>
                                        </div>
                                        <div class="display-progress-bar" style="font-size:95%" id="display_jam_15"></div>
                                    </div>
                                    <div class="col-1 text-center">
                                        <label for="jam_16" class="form-label">16:00-17:00</label>
                                        <div class="progress">
                                            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="0" aria-valuemin="0" id="jam_16" aria-valuemax="100" style="width: 0%"></div>
                                        </div>
                                        <div class="display-progress-bar" style="font-size:95%" id="display_jam_16"></div>
                                    </div>
                                    <div class="col-1 text-center">
                                        <label for="jam_17" class="form-label">17:00-18:00</label>
                                        <div class="progress">
                                            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="0" aria-valuemin="0" id="jam_17" aria-valuemax="100" style="width: 0%"></div>
                                        </div>
                                        <div class="display-progress-bar" style="font-size:95%" id="display_jam_17"></div>
                                    </div>
                                    <div class="col-1 text-center">
                                        <label for="jam_18" class="form-label">18:00-19:00</label>
                                        <div class="progress">
                                            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="0" aria-valuemin="0" id="jam_18" aria-valuemax="100" style="width: 0%"></div>
                                        </div>
                                        <div class="display-progress-bar" style="font-size:95%" id="display_jam_18"></div>
                                    </div>
                                </div>
                                <div class="row justify-content-md-center p-4">
                                    <div class="col col-md-2 text-center">
                                        <label class="mt-2" style="font-size: 80%">TRANSFER</label>
                                        <div class="progress">
                                            <div class="progress-bar-striped progress-bar-animated bg-success" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                                        </div>
                                    </div>
                                    <div class="col col-md-2 text-center">
                                        <label class="mt-2" style="font-size: 80%">SPK = 100%</label>
                                        <div class="progress">
                                            <div class="progress-bar-striped progress-bar-animated bg-info" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                                        </div>
                                    </div>
                                    <div class="col col-md-2 text-center">
                                        <label class="mt-2" style="font-size: 80%">50% < SPK > 100%</label>
                                        <div class="progress">
                                            <div class="progress-bar-striped progress-bar-animated bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                                        </div>
                                    </div>
                                    <div class="col col-md-2 text-center">
                                        <label class="mt-2" style="font-size: 80%">SPK < 50%</label>
                                        <div class="progress">
                                            <div class="progress-bar-striped progress-bar-animated bg-danger" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                                        </div>
                                    </div>
                                </div>
                                </div>
                            </div>
                            <div class="col-12 border p-2">
                                <label for="po_list_id" class="form-label mt-2">LIST SPK</label>
                                <div class="row justify-content-center">
                                    <input type="hidden" id="statusShow" value="0">
                                    <table class="table table-condensed table-striped text-center">
                                        <thead>
                                            <tr>
                                                <th colspan="2">Jam</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbodyListSPK">
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    {{-- </form> --}}
                </div>
            </div>
        </section>
    </div>
</div>
<div id="pageMessages"></div>
<!-- Modal -->
    <div class="modal fade" id="modalSetSPK" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-lg r-font">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title title_po">PO</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body row fw-bold">
                    <form action="#" method="post" id="form_set_spk" enctype="multipart/form-data">
                        @csrf
                        <table class="table text-center">
                            <thead class="thead-dark">
                                <tr>
                                    <th>PO</th>
                                    <th>WIDE</th>
                                    <th>CELL</th>
                                    <th>SIZE</th>
                                    <th>QTY SIZE</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><input type="type" name="po" id="modal_po_id" class="form-control" readonly></td>
                                    <td><input type="type" name="wide" id="modal_wide_id" class="form-control" readonly></td>
                                    <td><input type="type" name="cell" id="modal_cell_id" class="form-control" readonly></td>
                                    <td><input type="type" name="size" id="modal_size_id" class="form-control" readonly></td>
                                    <td><input type="type" name="qty_size" id="modal_qty_size_id" class="form-control" readonly></td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="row mt-4">
                            <div class="col-2">
                                QTY SPK
                            </div>
                            <div class="col-10">
                                <td><input type="text" name="qty_set_spk" autocomplete="off" class="form-control resetValue"></td>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-2">
                                SET JAM
                            </div>
                            <div class="col-10" id="modal_qty_size_id">
                                <select id="set_jam" class="form-control" name="set_jam">
                                    <option value="">Pilih jam</option>
                                    <option value="7">07:00</option>
                                    <option value="8">08:00</option>
                                    <option value="9">09:00</option>
                                    <option value="10">10:00</option>
                                    <option value="11">11:00</option>
                                    <option value="13">13:00</option>
                                    <option value="14">14:00</option>
                                    <option value="15">15:00</option>
                                    <option value="16">16:00</option>
                                    <option value="17">17:00</option>
                                    <option value="18">18:00</option>
                                </select>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalMutasiSPK" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-lg r-font">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 id="title_mutasi_spk"></h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="#" method="post" id="proses_mutasi" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body row fw-bold">
                        <table class="table">
                            <thead class="thead-dark">
                                <tr>
                                    <th>CELL</th>
                                    <th>JAM</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><input type="text" name="cell" id="mutasi_cell_id" readonly class="form-control"></td>
                                    <td><input type="text" name="jam" id="mutasi_jam_id" readonly class="form-control"></td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="row mt-2" id="html_modal_mutasi"></div>
                    </div>
                    <div class="modal-footer" id="actionModalMutasiSPK">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalPoMutasi" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog r-font">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title title_po">MUTASI <h5 id="modalPoMutasiTitle"></h5></h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body row fw-bold">
                    <form action="#" method="post" id="form_set_mutasi" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id_balance" id="modal_mutasi_id_balance">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" id="modalBacksetSPK" class="btn btn-info">Back</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </form>
            </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalTransferSPK" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-lg r-font">
            <div class="modal-content ">
                <div class="modal-header">
                    <h5 class="modal-title title_po">FORM TRANSFER</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body row fw-bold" id="modal_body_form_transfer">

                </div>
                <form action="#" method="post" id="proses_transfer" enctype="multipart/form-data">
                    @csrf
                <div class="row mt-4 m-4" id="modal_serah_terima_id">

                </div>
                <input type="hidden" name="cell" id="cell_modalTransferSPK">
                <input type="hidden" name="jam" id="jam_modalTransferSPK">
                <input type="hidden" name="po" id="po_modalTransferSPK">
                <input type="hidden" name="wide" id="wide_modalTransferSPK">
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Transfer</button>
                </div>
                </form>
            </div>
            </div>
        </div>
    </div>
</div>
@include('distribution_center.script.script_spk')
@endsection

