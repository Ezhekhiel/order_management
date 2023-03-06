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
        <section class="col-lg-12 connectedSortable">
            <div class="card">
                <div class="card-header bg-secondary">
                    <h3 class="card-title">WORKING REPORT CELL</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div style="overflow-x:auto;">
                        <br>
                        <table class="table table-bordered text-center">
                            <thead class="table-primary">
                                <tr>
                                    <th style="vertical-align: middle" rowspan="2">Cell</th>
                                    <th style="vertical-align: middle">Target</th>
                                    <th style="vertical-align: middle">% EOLR</th>
                                    <th style="vertical-align: middle">PO</th>
                                    <th style="vertical-align: middle">7</th>
                                    <th style="vertical-align: middle">8</th>
                                    <th style="vertical-align: middle">9</th>
                                    <th style="vertical-align: middle">10</th>
                                    <th style="vertical-align: middle">11</th>
                                    <th style="vertical-align: middle">12</th>
                                    <th style="vertical-align: middle">13</th>
                                    <th style="vertical-align: middle">14</th>
                                    <th style="vertical-align: middle">15</th>
                                    <th style="vertical-align: middle">16</th>
                                    <th style="vertical-align: middle">17</th>
                                    <th style="vertical-align: middle">18</th>
                                </tr>
                                <tr>
                                </tr>
                            </thead>
                            <tbody id="tbody_working_report_cell">
                            </tbody>
                        </table>
                        <h3></h3>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
<section class="content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <section class="col-lg-12 connectedSortable">
                <div class="card">
                    <div class="card-header bg-secondary">
                        <h3 class="card-title">ORDER MANAGEMENT</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div style="overflow-x:auto;">
                            <table class="table table-bordered table-dark text-center">
                                <thead class="table-primary">
                                    <tr id="list_size_id">
                                        <th style="vertical-align: middle">Cell</th>
                                        <th>
                                            <input type="text" class="form-control reset" list="list_cell" id="cell_id">
                                            <datalist id="list_cell"></datalist>
                                        </th>
                                        <th colspan="3" style="vertical-align: middle">PO Number</th>
                                        <th rowspan="2" style="vertical-align: middle" id="gender_id"></th>
                                        <th class="remove" rowspan="2"></th>
                                        <th class="remove" rowspan="2"></th>
                                        <th class="remove" rowspan="2"></th>
                                        <th class="remove" rowspan="2"></th>
                                        <th class="remove" rowspan="2"></th>
                                        <th class="remove" rowspan="2"></th>
                                        <th class="remove" rowspan="2"></th>
                                        <th class="remove" rowspan="2"></th>
                                        <th class="remove" rowspan="2"></th>
                                        <th class="remove" rowspan="2"></th>
                                        <th class="remove" rowspan="2"></th>
                                        <th class="remove" rowspan="2"></th>
                                        <th class="remove" rowspan="2"></th>
                                        <th class="remove" rowspan="2"></th>
                                        <th class="remove" rowspan="2"></th>
                                        <th class="remove" rowspan="2"></th>
                                        <th class="remove" rowspan="2"></th>
                                        <th class="remove" rowspan="2"></th>
                                        <th class="remove" rowspan="2"></th>
                                        <th class="remove" rowspan="2"></th>
                                        <th class="remove" rowspan="2"></th>
                                        <th class="remove" rowspan="2"></th>
                                        <th class="remove" rowspan="2"></th>
                                        <th class="remove" rowspan="2"></th>
                                        <th class="remove" rowspan="2"></th>
                                        <th class="remove" rowspan="2"></th>
                                        <th class="remove" rowspan="2"></th>
                                        <th class="remove" rowspan="2"></th>
                                        <th class="remove" rowspan="2"></th>
                                    </tr>
                                    <tr>
                                        <th style="vertical-align: middle">Produce Date</th>
                                        <th style="vertical-align: middle" id="orig_cfm_xfd_id">Test Date</th>
                                        <th colspan="3" id="column_po_id">
                                            <input type="text" name="po_name" class="form-control reset" list="list_po_id" id="po_id" autocomplete="off">
                                            <datalist id="list_po_id"></datalist>
                                        </th>
                                    </tr>
                                    <tr id="list_qty_size">
                                        <th>Division</th>
                                        <th>Process</th>
                                        <th>Date</th>
                                        <th>Qty Order</th>
                                        <th>%</th>
                                        <th class="remove"></th>
                                        <th class="remove"></th>
                                        <th class="remove"></th>
                                        <th class="remove"></th>
                                        <th class="remove"></th>
                                        <th class="remove"></th>
                                        <th class="remove"></th>
                                        <th class="remove"></th>
                                        <th class="remove"></th>
                                        <th class="remove"></th>
                                        <th class="remove"></th>
                                        <th class="remove"></th>
                                        <th class="remove"></th>
                                        <th class="remove"></th>
                                        <th class="remove"></th>
                                        <th class="remove"></th>
                                        <th class="remove"></th>
                                        <th class="remove"></th>
                                        <th class="remove"></th>
                                        <th class="remove"></th>
                                        <th class="remove"></th>
                                        <th class="remove"></th>
                                        <th class="remove"></th>
                                        <th class="remove"></th>
                                        <th class="remove"></th>
                                        <th class="remove"></th>
                                        <th class="remove"></th>
                                        <th class="remove"></th>
                                        <th class="remove"></th>
                                        <th class="remove"></th>
                                    </tr>
                                </thead>
                                <tbody class="table-light" style="font-size:90%">
                                {{-- cutting --}}
                                    <tr id="list_balance_cutting_id">
                                        <td rowspan="12" style="vertical-align: middle">Upper</td>
                                        <td rowspan="4" style="vertical-align: middle">Cutting</td>
                                        <td rowspan="4" style="vertical-align: middle">test Date</td>
                                        <td>Balance</td>
                                        <td id="percent_id_cutting" rowspan="4" style="vertical-align: middle">Test Percent</td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                    </tr>
                                    <tr id="list_output_cutting_id">
                                        <td>Output</td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                    </tr>
                                    <tr id="list_defect_cutting_id">
                                        <td>Defect</td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                    </tr>
                                    <tr id="list_shortage_cutting_id">
                                        <td>Shortage</td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                    </tr>
                                {{-- Preparation --}}
                                    <tr id="list_balance_preparation_id">
                                        <td rowspan="4" style="vertical-align: middle">Preparation</td>
                                        <td rowspan="4" style="vertical-align: middle">test Date</td>
                                        <td>Balance</td>
                                        <td id="percent_id_preparation" rowspan="4" style="vertical-align: middle">Test Percent</td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                    </tr>
                                    <tr id="list_output_preparation_id">
                                        <td>Output</td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                    </tr>
                                    <tr id="list_defect_preparation_id">
                                        <td>Defect</td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                    </tr>
                                    <tr id="list_shortage_preparation_id">
                                        <td>Shortage</td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                    </tr>
                                {{-- sewing --}}
                                    <tr id="list_balance_sewing_id">
                                        <td rowspan="4" style="vertical-align: middle">Sewing</td>
                                        <td rowspan="4" style="vertical-align: middle">test Date</td>
                                        <td>Balance</td>
                                        <td id="percent_id_sewing" rowspan="4" style="vertical-align: middle">Test Percent</td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                    </tr>
                                    <tr id="list_output_sewing_id">
                                        <td>Output</td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                    </tr>
                                    <tr id="list_defect_sewing_id">
                                        <td>Defect</td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                    </tr>
                                    <tr id="list_shortage_sewing_id">
                                        <td>Shortage</td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                    </tr>
                                {{-- Assembling --}}
                                    <tr id="list_balance_assembling_id">
                                        <td rowspan="8" style="vertical-align: middle">Shoe</td>
                                        <td rowspan="4" style="vertical-align: middle">Assembling</td>
                                        <td rowspan="4" style="vertical-align: middle">test Date</td>
                                        <td>Balance</td>
                                        <td id="percent_id_assembling" rowspan="4" style="vertical-align: middle">Test Percent</td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                    </tr>
                                    <tr id="list_output_assembling_id">
                                        <td>Output</td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                    </tr>
                                    <tr id="list_defect_assembling_id">
                                        <td>Defect</td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                    </tr>
                                    <tr id="list_shortage_assembling_id">
                                        <td>Shortage</td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                    </tr>
                                {{-- Stockfit --}}
                                    <tr id="list_balance_stockfit_id">
                                        <td rowspan="4" style="vertical-align: middle">Assembling</td>
                                        <td rowspan="4" style="vertical-align: middle">test Date</td>
                                        <td>Balance</td>
                                        <td id="percent_id_stockfit" rowspan="4" style="vertical-align: middle">Test Percent</td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                    </tr>
                                    <tr id="list_output_stockfit_id">
                                        <td>Output</td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                    </tr>
                                    <tr id="list_defect_stockfit_id">
                                        <td>Defect</td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                    </tr>
                                    <tr id="list_shortage_stockfit_id">
                                        <td>Shortage</td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                        <td class="remove"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

<div id="pageMessages"></div>
<div class="modal fade" id="modal_detail" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel" style="text-transform:capitalize;">Save <a id="title_save"></a></h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" action="#" id="searchDetail" enctype="multipart/form-data">
                        @csrf
                        <input type="text" name="style" class="form-control reset" id="modal_style_id" list="list_style_id" autocomplete="off" placeholder="Select style">
                        <datalist id="list_style_id"></datalist>
                        <input type="text" name="wide" class="form-control mt-2 reset" id="modal_wide_id" list="list_wide_id" autocomplete="off" placeholder="Select Wide">
                        <datalist id="list_wide_id"></datalist>
                        <input type="text" name="width" class="form-control mt-2 reset" id="modal_width_id" list="list_width_id" autocomplete="off" placeholder="Select Width">
                        <datalist id="list_width_id"></datalist>
                        <input type="text" name="cell" class="form-control mt-2" id="modal_cell_id" list="list_cell_id" readonly>
                        <input type="hidden" name="po" id="modal_po_id">
                    </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Search</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@include('order_management.script.script_dashboard')
@endsection

