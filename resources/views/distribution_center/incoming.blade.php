@extends('layouts.app_index')

@section('content')
<br>

<div class="container-fluid">
    <div class="row justify-content-center r-font">
        <section class="col-lg-12 connectedSortable">
            <div class="card">
                <div class="card-header bg-secondary">
                    <h3 class="card-title">INCOMING INPUT</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="card">
                            <div class="card-body">
                                <div class="alert {{ session('color') }}" id="alert_incoming">
                                    {{ session('status') }}
                                </div>
                            </div>
                        </div>
                    @endif
                    <form action="#" method="post" id="form_incoming" enctype="multipart/form-data">
                        @csrf
                        <div class="row d-flex justify-content-center">
                            <div class="col-3 border p-3 m-2">
                                <div class="mb-6">
                                    <label for="logistic_id" class="form-label">Logistik</label>
                                    <input type="text" class="form-control clickReset" name="logistik" id="logistic_id" aria-describedby="logisticID" list="logistic_list">
                                    <datalist id="logistic_list"></datalist>
                                </div>
                                <div class="card p-2 mt-4">
                                    <div class="mb-6">
                                        <label for="buymonth_id" class="form-label">BM</label>
                                        <input type="text" class="form-control clickReset" name="buymonth" id="buymonth_id" aria-describedby="buymontID" list="buymonth_list" autocomplete="off">
                                        <datalist id="buymonth_list"></datalist>
                                    </div>
                                    <div class="mb-6">
                                        <label for="po_id" class="form-label">PO</label>
                                        <input type="text" class="form-control clickReset" name="po" id="po_id" list="po_list" aria-describedby="poID" autocomplete="off">
                                        <datalist id="po_list"></datalist>
                                    </div>
                                    <div class="mb-6">
                                        <label for="komponen_id" class="form-label">Komponen</label>
                                        <select name="komponen" id="komponen_id" class="form-control">
                                        </select>
                                    </div>
                                </div>
                                <div class="card p-2 mt-4">
                                    <div class="mb-6">
                                        <label for="wide_id" class="form-label">Wide</label>
                                        <input type="text" readonly class="form-control" name="wide" id="wide_id" aria-describedby="wideID" list="wide_list" autocomplete="off">
                                        <datalist id="wide_list"></datalist>
                                    </div>
                                    <div class="mb-6">
                                        <label for="cell_id" class="form-label">Cell</label>
                                        <input type="text" readonly class="form-control" name="cell" id="cell_id" aria-describedby="cellID">
                                    </div>
                                    <div class="mb-6">
                                        <label for="article_id" class="form-label">Article / Style</label>
                                        <input type="text" readonly class="form-control" name="style" id="style_id" aria-describedby="styleID">
                                    </div>
                                    <div class="mb-6">
                                        <label for="qty_po_id" class="form-label">QTY PO</label>
                                        <input type="number" readonly class="form-control" name="qty_po" id="qty_po_id" aria-describedby="qtyID">
                                    </div>
                                    <div class="mb-6">
                                        <label for="gender_id" class="form-label">Gender</label>
                                        <input type="text" readonly class="form-control" name="gender"id="gender_id" aria-describedby="genderID">
                                    </div>
                                </div>
                                <div class="card p-2 mt-4">
                                    <div class="mb-6">
                                        <label for="date_id" class="form-label">Date</label>
                                        <input type="date" class="form-control" name="date" id="date_id" aria-describedby="dateID" value="{{ date("Y-m-d") }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-7 border p-3 m-2">
                                <div class="row border m-2" style="font-size:82%">
                                    <div class="col-12 text-center pt-4 pb-2">
                                        <h5 class="fw-bold">SIZE INCOMING</h5>
                                    </div>
                                    <div class="col-2 text-center">
                                        <div class="mb-6 form-group row">
                                            <label for="size_1" id="label_size_1" class="col-sm-2 col-form-label validation">1</label>
                                            <div class="col-sm-10">
                                                <input type="number" class="form-control clickReset validation" id="size_1" name="qty_incoming[]" aria-describedby="size_1">
                                            </div>
                                        </div>
                                        <div class="mb-6 form-group row">
                                            <label for="size_2" id="label_size_2" class="col-sm-2 col-form-label validation">2</label>
                                            <div class="col-sm-10">
                                                <input type="number" class="form-control clickReset validation" id="size_2" name="qty_incoming[]" aria-describedby="size_2">
                                            </div>
                                        </div>
                                        <div class="mb-6 form-group row">
                                            <label for="size_3" id="label_size_3" class="col-sm-2 col-form-label validation">3</label>
                                            <div class="col-sm-10">
                                                <input type="number" class="form-control clickReset validation" id="size_3" name="qty_incoming[]" aria-describedby="size_3">
                                            </div>
                                        </div>
                                        <div class="mb-6 form-group row">
                                            <label for="size_4" id="label_size_4" class="col-sm-2 col-form-label validation">4</label>
                                            <div class="col-sm-10">
                                                <input type="number" class="form-control clickReset validation" id="size_4" name="qty_incoming[]" aria-describedby="size_4">
                                            </div>
                                        </div>
                                        <div class="mb-6 form-group row">
                                            <label for="size_5" id="label_size_5" class="col-sm-2 col-form-label validation">5</label>
                                            <div class="col-sm-10">
                                                <input type="number" class="form-control clickReset validation" id="size_5" name="qty_incoming[]" aria-describedby="size_5">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-2 text-center">
                                        <div class="mb-6 form-group row">
                                            <label for="size_6" id="label_size_6" class="col-sm-2 col-form-label validation">6</label>
                                            <div class="col-sm-10">
                                                <input type="number" class="form-control clickReset validation" id="size_6" name="qty_incoming[]" aria-describedby="size_6">
                                            </div>
                                        </div>
                                        <div class="mb-6 form-group row">
                                            <label for="size_7" id="label_size_7" class="col-sm-2 col-form-label validation">7</label>
                                            <div class="col-sm-10">
                                                <input type="number" class="form-control clickReset validation" id="size_7" name="qty_incoming[]" aria-describedby="size_7">
                                            </div>
                                        </div>
                                        <div class="mb-6 form-group row">
                                            <label for="size_8" id="label_size_8" class="col-sm-2 col-form-label validation">8</label>
                                            <div class="col-sm-10">
                                                <input type="number" class="form-control clickReset validation" id="size_8" name="qty_incoming[]" aria-describedby="size_8">
                                            </div>
                                        </div>
                                        <div class="mb-6 form-group row">
                                            <label for="size_9" id="label_size_9" class="col-sm-2 col-form-label validation">9</label>
                                            <div class="col-sm-10">
                                                <input type="number" class="form-control clickReset validation" id="size_9" name="qty_incoming[]" aria-describedby="size_9">
                                            </div>
                                        </div>
                                        <div class="mb-6 form-group row">
                                            <label for="size_10" id="label_size_10" class="col-sm-2 col-form-label validation">10</label>
                                            <div class="col-sm-10">
                                                <input type="number" class="form-control clickReset validation" id="size_10" name="qty_incoming[]" aria-describedby="size_10">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-2 text-center">
                                        <div class="mb-6 form-group row">
                                            <label for="size_11" id="label_size_11" class="col-sm-2 col-form-label validation">11</label>
                                            <div class="col-sm-10">
                                                <input type="number" class="form-control clickReset validation" id="size_11" name="qty_incoming[]" aria-describedby="size_11">
                                            </div>
                                        </div>
                                        <div class="mb-6 form-group row">
                                            <label for="size_12" id="label_size_12" class="col-sm-2 col-form-label validation">12</label>
                                            <div class="col-sm-10">
                                                <input type="number" class="form-control clickReset validation" id="size_12" name="qty_incoming[]" aria-describedby="size_12">
                                            </div>
                                        </div>
                                        <div class="mb-6 form-group row">
                                            <label for="size_13" id="label_size_13" class="col-sm-2 col-form-label validation">13</label>
                                            <div class="col-10">
                                                <input type="number" class="form-control clickReset validation" id="size_13" name="qty_incoming[]" aria-describedby="size_13">
                                            </div>
                                        </div>
                                        <div class="mb-6 form-group row">
                                            <label for="size_14" id="label_size_14" class="col-sm-2 col-form-label validation">14</label>
                                            <div class="col-sm-10">
                                                <input type="number" class="form-control clickReset validation" id="size_14" name="qty_incoming[]" aria-describedby="size_14">
                                            </div>
                                        </div>
                                        <div class="mb-6 form-group row">
                                            <label for="size_15" id="label_size_15" class="col-sm-2 col-form-label validation">15</label>
                                            <div class="col-sm-10">
                                                <input type="number" class="form-control clickReset validation" id="size_15" name="qty_incoming[]" aria-describedby="size_15">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-2 text-center">
                                        <div class="mb-6 form-group row">
                                            <label for="size_16" id="label_size_16" class="col-sm-2 col-form-label validation">16</label>
                                            <div class="col-sm-10">
                                                <input type="number" class="form-control clickReset validation" id="size_16" name="qty_incoming[]" aria-describedby="size_1">
                                            </div>
                                        </div>
                                        <div class="mb-6 form-group row">
                                            <label for="size_17" id="label_size_17" class="col-sm-2 col-form-label validation">17</label>
                                            <div class="col-sm-10">
                                                <input type="number" class="form-control clickReset validation" id="size_17" name="qty_incoming[]" aria-describedby="size_16">
                                            </div>
                                        </div>
                                        <div class="mb-6 form-group row">
                                            <label for="size_18" id="label_size_18" class="col-sm-2 col-form-label validation">18</label>
                                            <div class="col-sm-10">
                                                <input type="number" class="form-control clickReset validation" id="size_18" name="qty_incoming[]" aria-describedby="size_17">
                                            </div>
                                        </div>
                                        <div class="mb-6 form-group row">
                                            <label for="size_19" id="label_size_19" class="col-sm-2 col-form-label validation">19</label>
                                            <div class="col-sm-10">
                                                <input type="number" class="form-control clickReset validation" id="size_19" name="qty_incoming[]" aria-describedby="size_18">
                                            </div>
                                        </div>
                                        <div class="mb-6 form-group row">
                                            <label for="size_20" id="label_size_20" class="col-sm-2 col-form-label validation">20</label>
                                            <div class="col-sm-10">
                                                <input type="number" class="form-control clickReset validation" id="size_20" name="qty_incoming[]" aria-describedby="size_19">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-2 text-center">
                                        <div class="mb-6 form-group row">
                                            <label for="size_21" id="label_size_21" class="col-sm-2 col-form-label validation">21</label>
                                            <div class="col-sm-10">
                                                <input type="number" class="form-control clickReset validation" id="size_21" name="qty_incoming[]" aria-describedby="size_20">
                                            </div>
                                        </div>
                                        <div class="mb-6 form-group row">
                                            <label for="size_22" id="label_size_22" class="col-sm-2 col-form-label validation">22</label>
                                            <div class="col-sm-10">
                                                <input type="number" class="form-control clickReset validation" id="size_22" name="qty_incoming[]" aria-describedby="size_21">
                                            </div>
                                        </div>
                                        <div class="mb-6 form-group row">
                                            <label for="size_23" id="label_size_23" class="col-sm-2 col-form-label validation">23</label>
                                            <div class="col-sm-10">
                                                <input type="number" class="form-control clickReset validation" id="size_23" name="qty_incoming[]" aria-describedby="size_22">
                                            </div>
                                        </div>
                                        <div class="mb-6 form-group row">
                                            <label for="size_24" id="label_size_24" class="col-sm-2 col-form-label validation">24</label>
                                            <div class="col-sm-10">
                                                <input type="number" class="form-control clickReset validation" id="size_24" name="qty_incoming[]" aria-describedby="size_23">
                                            </div>
                                        </div>
                                        <div class="mb-6 form-group row">
                                            <label for="size_25" id="label_size_25" class="col-sm-2 col-form-label validation">25</label>
                                            <div class="col-sm-10">
                                                <input type="number" class="form-control clickReset validation" id="size_25" name="qty_incoming[]" aria-describedby="size_24">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-2 text-center">
                                        <div class="mb-6 form-group row">
                                            <label for="size_26" id="label_size_26" class="col-sm-2 col-form-label validation">26</label>
                                            <div class="col-sm-10">
                                                <input type="number" class="form-control clickReset validation" id="size_26" name="qty_incoming[]" aria-describedby="size_26">
                                            </div>
                                        </div>
                                        <div class="mb-6 form-group row">
                                            <label for="size_27" id="label_size_27" class="col-sm-2 col-form-label validation">27</label>
                                            <div class="col-sm-10">
                                                <input type="number" class="form-control clickReset validation" id="size_27" name="qty_incoming[]" aria-describedby="size_27">
                                            </div>
                                        </div>
                                        <div class="mb-6 form-group row">
                                            <label for="size_28" id="label_size_28" class="col-sm-2 col-form-label validation">28</label>
                                            <div class="col-sm-10">
                                                <input type="number" class="form-control clickReset validation" id="size_28" name="qty_incoming[]" aria-describedby="size_28">
                                            </div>
                                        </div>
                                        <div class="mb-6 form-group row">
                                            <label for="size_29" id="label_size_29" class="col-sm-2 col-form-label validation">29</label>
                                            <div class="col-sm-10">
                                                <input type="number" class="form-control clickReset validation" id="size_29" name="qty_incoming[]" aria-describedby="size_29">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row border m-2 mt-4" style="font-size:82%">
                                    <div class="col-12 text-center pt-4 pb-2">
                                        <h5 class="fw-bold">BALANCE</h5>
                                    </div>
                                    <div class="col-2 text-center">
                                        <div class="mb-6 form-group row">
                                            <label for="balance_1" id="label_balance_1" class="col-sm-2 col-form-label validation">1</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control validation_balance" onclick="openModal(1)" id="visual_1"  aria-describedby="balance_1" readonly>
                                                <input type="hidden" id="balance_1" class="balance_value" name="qty_balance[]">
                                            </div>
                                        </div>
                                        <div class="mb-6 form-group row">
                                            <label for="balance_2" id="label_balance_2" class="col-sm-2 col-form-label">2</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control validation_balance" onclick="openModal(2)" id="visual_2" aria-describedby="visual_2" readonly>
                                                <input type="hidden" id="balance_2" class="balance_value" name="qty_balance[]">
                                            </div>
                                        </div>
                                        <div class="mb-6 form-group row">
                                            <label for="balance_3" id="label_balance_3" class="col-sm-2 col-form-label">3</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control validation_balance" onclick="openModal(3)" id="visual_3" aria-describedby="visual_3" readonly>
                                                <input type="hidden" id="balance_3" class="balance_value" name="qty_balance[]">
                                            </div>
                                        </div>
                                        <div class="mb-6 form-group row">
                                            <label for="balance_4" id="label_balance_4" class="col-sm-2 col-form-label">4</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control validation_balance" onclick="openModal(4)" id="visual_4" aria-describedby="visual_4" readonly>
                                                <input type="hidden" id="balance_4" class="balance_value" name="qty_balance[]">
                                            </div>
                                        </div>
                                        <div class="mb-6 form-group row">
                                            <label for="balance_5" id="label_balance_5" class="col-sm-2 col-form-label">5</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control validation_balance" onclick="openModal(5)" id="visual_5" aria-describedby="visual_5" readonly>
                                                <input type="hidden" id="balance_5" class="balance_value" name="qty_balance[]">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-2 text-center">
                                        <div class="mb-6 form-group row">
                                            <label for="balance_6" id="label_balance_6" class="col-sm-2 col-form-label">6</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control validation_balance" onclick="openModal(6)" id="visual_6" aria-describedby="visual_6" readonly>
                                                <input type="hidden" id="balance_6" class="balance_value" name="qty_balance[]">
                                            </div>
                                        </div>
                                        <div class="mb-6 form-group row">
                                            <label for="balance_7" id="label_balance_7" class="col-sm-2 col-form-label">7</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control validation_balance" onclick="openModal(7)" id="visual_7" aria-describedby="visual_7" readonly>
                                                <input type="hidden" id="balance_7" class="balance_value" name="qty_balance[]">
                                            </div>
                                        </div>
                                        <div class="mb-6 form-group row">
                                            <label for="balance_8" id="label_balance_8" class="col-sm-2 col-form-label">8</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control validation_balance" onclick="openModal(8)" id="visual_8" aria-describedby="visual_8" readonly>
                                                <input type="hidden" id="balance_8" class="balance_value" name="qty_balance[]">
                                            </div>
                                        </div>
                                        <div class="mb-6 form-group row">
                                            <label for="balance_9" id="label_balance_9" class="col-sm-2 col-form-label">9</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control validation_balance" onclick="openModal(9)" id="visual_9" aria-describedby="visual_9" readonly>
                                                <input type="hidden" id="balance_9" class="balance_value" name="qty_balance[]">
                                            </div>
                                        </div>
                                        <div class="mb-6 form-group row">
                                            <label for="balance_10" id="label_balance_10" class="col-sm-2 col-form-label">10</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control validation_balance" onclick="openModal(10)" id="visual_10" aria-describedby="visual_10" readonly>
                                                <input type="hidden" id="balance_10" class="balance_value" name="qty_balance[]">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-2 text-center">
                                        <div class="mb-6 form-group row">
                                            <label for="balance_11" id="label_balance_11" class="col-sm-2 col-form-label">11</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control validation_balance" onclick="openModal(11)" id="visual_11" aria-describedby="visual_11" readonly>
                                                <input type="hidden" id="balance_11" class="balance_value" name="qty_balance[]">
                                            </div>
                                        </div>
                                        <div class="mb-6 form-group row">
                                            <label for="balance_12" id="label_balance_12" class="col-sm-2 col-form-label">12</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control validation_balance" onclick="openModal(12)" id="visual_12" aria-describedby="visual_12" readonly>
                                                <input type="hidden" id="balance_12" class="balance_value" name="qty_balance[]">
                                            </div>
                                        </div>
                                        <div class="mb-6 form-group row">
                                            <label for="balance_13" id="label_balance_13" class="col-sm-2 col-form-label">13</label>
                                            <div class="col-10">
                                                <input type="text" class="form-control validation_balance" onclick="openModal(13)" id="visual_13" aria-describedby="visual_13" readonly>
                                                <input type="hidden" id="balance_13" class="balance_value" name="qty_balance[]">
                                            </div>
                                        </div>
                                        <div class="mb-6 form-group row">
                                            <label for="balance_14" id="label_balance_14" class="col-sm-2 col-form-label">14</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control validation_balance" onclick="openModal(14)" id="visual_14" aria-describedby="visual_14" readonly>
                                                <input type="hidden" id="balance_14" class="balance_value" name="qty_balance[]">
                                            </div>
                                        </div>
                                        <div class="mb-6 form-group row">
                                            <label for="balance_15" id="label_balance_15" class="col-sm-2 col-form-label">15</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control validation_balance" onclick="openModal(15)" id="visual_15" aria-describedby="visual_15" readonly>
                                                <input type="hidden" id="balance_15" class="balance_value" name="qty_balance[]">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-2 text-center">
                                        <div class="mb-6 form-group row">
                                            <label for="balance_16" id="label_balance_16" class="col-sm-2 col-form-label">16</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control validation_balance" onclick="openModal(16)" id="visual_16" aria-describedby="visual_16" readonly>
                                                <input type="hidden" id="balance_16" class="balance_value" name="qty_balance[]">
                                            </div>
                                        </div>
                                        <div class="mb-6 form-group row">
                                            <label for="balance_17" id="label_balance_17" class="col-sm-2 col-form-label">17</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control validation_balance" onclick="openModal(17)" id="visual_17" aria-describedby="visual_17" readonly>
                                                <input type="hidden" id="balance_17" class="balance_value" name="qty_balance[]">
                                            </div>
                                        </div>
                                        <div class="mb-6 form-group row">
                                            <label for="balance_18" id="label_balance_18" class="col-sm-2 col-form-label">18</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control validation_balance" onclick="openModal(18)" id="visual_18" aria-describedby="visual_18" readonly>
                                                <input type="hidden" id="balance_18" class="balance_value" name="qty_balance[]">
                                            </div>
                                        </div>
                                        <div class="mb-6 form-group row">
                                            <label for="balance_19" id="label_balance_19" class="col-sm-2 col-form-label">19</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control validation_balance" onclick="openModal(19)" id="visual_19" aria-describedby="visual_19" readonly>
                                                <input type="hidden" id="balance_19" class="balance_value" name="qty_balance[]">
                                            </div>
                                        </div>
                                        <div class="mb-6 form-group row">
                                            <label for="balance_20" id="label_balance_20" class="col-sm-2 col-form-label">20</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control validation_balance" onclick="openModal(20)" id="visual_20" aria-describedby="visual_20" readonly>
                                                <input type="hidden" id="balance_20" class="balance_value" name="qty_balance[]">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-2 text-center">
                                        <div class="mb-6 form-group row">
                                            <label for="balance_21" id="label_balance_21" class="col-sm-2 col-form-label">21</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control validation_balance" onclick="openModal(21)" id="visual_21" aria-describedby="visual_21" readonly>
                                                <input type="hidden" id="balance_21" class="balance_value" name="qty_balance[]">
                                            </div>
                                        </div>
                                        <div class="mb-6 form-group row">
                                            <label for="balance_22" id="label_balance_22" class="col-sm-2 col-form-label">22</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control validation_balance" onclick="openModal(22)" id="visual_22" aria-describedby="visual_22" readonly>
                                                <input type="hidden" id="balance_22" class="balance_value" name="qty_balance[]">
                                            </div>
                                        </div>
                                        <div class="mb-6 form-group row">
                                            <label for="balance_23" id="label_balance_23" class="col-sm-2 col-form-label">23</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control validation_balance" onclick="openModal(23)" id="visual_23" aria-describedby="visual_23" readonly>
                                                <input type="hidden" id="balance_23" class="balance_value" name="qty_balance[]">
                                            </div>
                                        </div>
                                        <div class="mb-6 form-group row">
                                            <label for="balance_24" id="label_balance_24" class="col-sm-2 col-form-label">24</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control validation_balance" onclick="openModal(24)" id="visual_24"aria-describedby="visual_24" readonly>
                                                <input type="hidden" id="balance_24" class="balance_value" name="qty_balance[]">
                                            </div>
                                        </div>
                                        <div class="mb-6 form-group row">
                                            <label for="balance_25" id="label_balance_25" class="col-sm-2 col-form-label">25</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control validation_balance" onclick="openModal(25)" id="visual_25" aria-describedby="visual_25" readonly>
                                                <input type="hidden" id="balance_25" class="balance_value" name="qty_balance[]">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-2 text-center">
                                        <div class="mb-6 form-group row">
                                            <label for="balance_26" id="label_balance_26" class="col-sm-2 col-form-label">26</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control validation_balance" onclick="openModal(26)" id="visual_26" aria-describedby="visual_26" readonly>
                                                <input type="hidden" id="balance_26" class="balance_value" name="qty_balance[]">
                                            </div>
                                        </div>
                                        <div class="mb-6 form-group row">
                                            <label for="balance_27" id="label_balance_27" class="col-sm-2 col-form-label">27</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control validation_balance" onclick="openModal(27)" id="visual_27" aria-describedby="visual_27" readonly>
                                                <input type="hidden" id="balance_27" class="balance_value" name="qty_balance[]">
                                            </div>
                                        </div>
                                        <div class="mb-6 form-group row">
                                            <label for="balance_28" id="label_balance_28" class="col-sm-2 col-form-label">28</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control validation_balance" onclick="openModal(28)" id="visual_28" aria-describedby="visual_28" readonly>
                                                <input type="hidden" id="balance_28" class="balance_value" name="qty_balance[]">
                                            </div>
                                        </div>
                                        <div class="mb-6 form-group row">
                                            <label for="balance_29" id="label_balance_29" class="col-sm-2 col-form-label">29</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control validation_balance" onclick="openModal(29)" id="visual_29" aria-describedby="visual_29" readonly>
                                                <input type="hidden" id="balance_29" class="balance_value" name="qty_balance[]">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-1 border p-3 m-2">
                                <button type="submit" class="btn btn-secondary btn-lg btn-block">SAVE</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
</div>
<div id="pageMessages"></div>
<!-- Modal -->
    <div class="modal fade" id="modal_not_the_same" tabindex="-1" role="dialog" aria-labelledby="Modal Not the Same" aria-hidden="true">
        <div class="modal-dialog  modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Apakah anda ingin menambahkan atau mengganti yang lama?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div style="overflow-x:auto;">
                        <form method="post" action="#" id="not_the_same" enctype="multipart/form-data">
                        @csrf
                        <table class="table table-striped text-center">
                            <thead class="thead-dark">
                                <tr>
                                    <th rowspan="2">Component</th>
                                    <th rowspan="2">Old</th>
                                    <th rowspan="2">New</th>
                                    <th colspan="2">Action</th>
                                </tr>
                                <tr>
                                    <th>Ubah?</th>
                                    <th>Jangan Ubah!</th>
                                </tr>
                            </thead>
                            <tbody id="data_not_the_same">
                            </tbody>
                        </table>
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
    <div class="modal fade" id="modal_update_income" tabindex="-1" role="dialog" aria-labelledby="Modal Not the Same" aria-hidden="true">
        <div class="modal-dialog  modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="#" id="update_incoming" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-6">
                            <label for="modal_qty_po" class="form-label">PO</label>
                            <input type="text" readonly class="form-control" name="po" id="modal_po" aria-describedby="modal_po">
                        </div>
                        <div class="mb-6">
                            <label for="modal_qty_po" class="form-label">Wide</label>
                            <input type="text" readonly class="form-control" name="wide" id="modal_wide" aria-describedby="modal_wide">
                        </div>
                        <div class="mb-6">
                            <label for="modal_qty_po" class="form-label">Size</label>
                            <input type="text" readonly class="form-control" name="size" id="modal_size" aria-describedby="modal_size">
                        </div>
                        <div class="mb-6">
                            <label for="modal_komponen" class="form-label">Komponen</label>
                            <input type="text" readonly class="form-control" name="komponen" id="modal_komponen" aria-describedby="modal_komponen">
                        </div>
                        <div class="mb-6">
                            <label for="modal_qty_incoming" class="form-label">QTY Incoming</label>
                            <input type="number" readonly class="form-control" name="qty_incoming" id="modal_qty_incoming">
                        </div>
                        <div class="mb-6">
                            <label for="modal_qty_update" class="form-label">QTY Update</label>
                            <input type="text" class="form-control" name="qty_update" id="modal_qty_update" aria-describedby="modal_qty_update">
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
@include('distribution_center.script.script_incoming')
@endsection

