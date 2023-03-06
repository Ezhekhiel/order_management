@extends('layouts.app_index')

@section('content')
<br>

<div class="container-fluid">
    <div class="row justify-content-center">
        <section class="col-lg-12 connectedSortable">
            <div class="card">
                <div class="card-header bg-light">
                    {{-- <h3 class="card-title">DISTRIBUTION CENTER STATUS</h3> --}}
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                          <a class="nav-link active" id="main-tab" data-toggle="tab" href="#main" role="tab" aria-controls="main" aria-selected="true">DISTRIBUTION CENTER STATUS</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Profile</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Contact</a>
                        </li>
                      </ul>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="main" role="tabpanel" aria-labelledby="main-tab">
                        <div class="card-body text-center">
                            <div style="overflow-x:auto;">
                                <table class="table table-bordered text-center">
                                    <thead>
                                        <tr>
                                            <th style="font-size:180%" class="align-middle" rowspan="2">JAM</th>
                                            <th style="font-size:180%" colspan="10">CELL</th>
                                        </tr>
                                        <tr id="table_cell_id">
                                            <th style="font-size:120%">Cell - 1</th>
                                            <th style="font-size:120%">Cell - 2</th>
                                            <th style="font-size:120%">Cell - 3</th>
                                            <th style="font-size:120%">Cell - 4</th>
                                            <th style="font-size:120%">Cell - 5</th>
                                            <th style="font-size:120%">Cell - 6</th>
                                            <th style="font-size:120%">Cell - 7</th>
                                            <th style="font-size:120%">Cell - 8</th>
                                            <th style="font-size:120%">Cell - 9</th>
                                            <th style="font-size:120%">SU</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr id="colomn_jam_7">
                                            <td class="font-weight-bold" style="font-size:120%">07:00 - 08:00</td>
                                            <td><div id="7_1" class="circle"></div></td>
                                            <td><div id="7_2" class="circle"></div></td>
                                            <td><div id="7_3" class="circle"></div></td>
                                            <td><div id="7_4" class="circle"></div></td>
                                            <td><div id="7_5" class="circle"></div></td>
                                            <td><div id="7_6" class="circle"></div></td>
                                            <td><div id="7_7" class="circle"></div></td>
                                            <td><div id="7_8" class="circle"></div></td>
                                            <td><div id="7_9" class="circle"></div></td>
                                            <td><div id="7_SU" class="circle"></div></td>
                                        </tr>
                                        <tr id="colomn_jam_8">
                                            <td class="font-weight-bold" style="font-size:120%">08:00 - 09:00</td>
                                            <td><div id="8_1" class="circle"></div></td>
                                            <td><div id="8_2" class="circle"></div></td>
                                            <td><div id="8_3" class="circle"></div></td>
                                            <td><div id="8_4" class="circle"></div></td>
                                            <td><div id="8_5" class="circle"></div></td>
                                            <td><div id="8_6" class="circle"></div></td>
                                            <td><div id="8_7" class="circle"></div></td>
                                            <td><div id="8_8" class="circle"></div></td>
                                            <td><div id="8_9" class="circle"></div></td>
                                            <td><div id="8_SU" class="circle"></div></td>
                                        </tr>
                                        <tr id="colomn_jam_9">
                                            <td class="font-weight-bold" style="font-size:120%">09:00 - 10:00</td>
                                            <td><div id="9_1" class="circle"></div></td>
                                            <td><div id="9_2" class="circle"></div></td>
                                            <td><div id="9_3" class="circle"></div></td>
                                            <td><div id="9_4" class="circle"></div></td>
                                            <td><div id="9_5" class="circle"></div></td>
                                            <td><div id="9_6" class="circle"></div></td>
                                            <td><div id="9_7" class="circle"></div></td>
                                            <td><div id="9_8" class="circle"></div></td>
                                            <td><div id="9_9" class="circle"></div></td>
                                            <td><div id="9_SU" class="circle"></div></td>
                                        </tr>
                                        <tr id="colomn_jam_10">
                                            <td class="font-weight-bold" style="font-size:120%">10:00 - 11:00</td>
                                            <td><div id="10_1" class="circle"></div></td>
                                            <td><div id="10_2" class="circle"></div></td>
                                            <td><div id="10_3" class="circle"></div></td>
                                            <td><div id="10_4" class="circle"></div></td>
                                            <td><div id="10_5" class="circle"></div></td>
                                            <td><div id="10_6" class="circle"></div></td>
                                            <td><div id="10_7" class="circle"></div></td>
                                            <td><div id="10_8" class="circle"></div></td>
                                            <td><div id="10_9" class="circle"></div></td>
                                            <td><div id="10_SU" class="circle"></div></td>
                                        </tr>
                                        <tr id="colomn_jam_11">
                                            <td class="font-weight-bold" style="font-size:120%">11:00 - 12:00</td>
                                            <td><div id="11_1" class="circle"></div></td>
                                            <td><div id="11_2" class="circle"></div></td>
                                            <td><div id="11_3" class="circle"></div></td>
                                            <td><div id="11_4" class="circle"></div></td>
                                            <td><div id="11_5" class="circle"></div></td>
                                            <td><div id="11_6" class="circle"></div></td>
                                            <td><div id="11_7" class="circle"></div></td>
                                            <td><div id="11_8" class="circle"></div></td>
                                            <td><div id="11_9" class="circle"></div></td>
                                            <td><div id="11_SU" class="circle"></div></td>
                                        </tr>
                                        {{-- <tr>
                                            <td class="font-weight-bold" style="font-size:120%">12:00 - 13:00</td>
                                            <div id="colomn_jam_12"></div>
                                            <td><div id="12_1" class="circle"></div></td>
                                            <td><div id="12_2" class="circle"></div></td>
                                            <td><div id="12_3" class="circle"></div></td>
                                            <td><div id="12_4" class="circle"></div></td>
                                            <td><div id="12_5" class="circle"></div></td>
                                            <td><div id="12_6" class="circle"></div></td>
                                            <td><div id="12_7" class="circle"></div></td>
                                            <td><div id="12_8" class="circle"></div></td>
                                            <td><div id="12_9" class="circle"></div></td>
                                            <td><div id="12_SU" class="circle"></div></td>
                                        </tr> --}}
                                        <tr id="colomn_jam_13">
                                            <td class="font-weight-bold" style="font-size:120%">13:00 - 14:00</td>
                                            <td><div id="13_1" class="circle"></div></td>
                                            <td><div id="13_2" class="circle"></div></td>
                                            <td><div id="13_3" class="circle"></div></td>
                                            <td><div id="13_4" class="circle"></div></td>
                                            <td><div id="13_5" class="circle"></div></td>
                                            <td><div id="13_6" class="circle"></div></td>
                                            <td><div id="13_7" class="circle"></div></td>
                                            <td><div id="13_8" class="circle"></div></td>
                                            <td><div id="13_9" class="circle"></div></td>
                                            <td><div id="13_SU" class="circle"></div></td>
                                        </tr>
                                        <tr id="colomn_jam_14">
                                            <td class="font-weight-bold" style="font-size:120%">14:00 - 15:00</td>
                                            <td><div class="circle"></div></td>
                                            <td><div class="circle"></div></td>
                                            <td><div class="circle"></div></td>
                                            <td><div class="circle"></div></td>
                                            <td><div class="circle"></div></td>
                                            <td><div class="circle"></div></td>
                                            <td><div class="circle"></div></td>
                                            <td><div class="circle"></div></td>
                                            <td><div class="circle"></div></td>
                                            <td><div class="circle"></div></td>
                                        </tr>
                                        <tr id="colomn_jam_15">
                                            <td class="font-weight-bold" style="font-size:120%">15:00 - 16:00</td>
                                            <td><div class="circle"></div></td>
                                            <td><div class="circle"></div></td>
                                            <td><div class="circle"></div></td>
                                            <td><div class="circle"></div></td>
                                            <td><div class="circle"></div></td>
                                            <td><div class="circle"></div></td>
                                            <td><div class="circle"></div></td>
                                            <td><div class="circle"></div></td>
                                            <td><div class="circle"></div></td>
                                            <td><div class="circle"></div></td>
                                        </tr>
                                        <tr id="colomn_jam_16">
                                            <td class="font-weight-bold" style="font-size:120%">16:00 - 17:00</td>
                                            <td><div class="circle"></div></td>
                                            <td><div class="circle"></div></td>
                                            <td><div class="circle"></div></td>
                                            <td><div class="circle"></div></td>
                                            <td><div class="circle"></div></td>
                                            <td><div class="circle"></div></td>
                                            <td><div class="circle"></div></td>
                                            <td><div class="circle"></div></td>
                                            <td><div class="circle"></div></td>
                                            <td><div class="circle"></div></td>
                                        </tr>
                                        <tr id="colomn_jam_17">
                                            <td class="font-weight-bold" style="font-size:120%">17:00 - 18:00</td>
                                            <td><div class="circle"></div></td>
                                            <td><div class="circle"></div></td>
                                            <td><div class="circle"></div></td>
                                            <td><div class="circle"></div></td>
                                            <td><div class="circle"></div></td>
                                            <td><div class="circle"></div></td>
                                            <td><div class="circle"></div></td>
                                            <td><div class="circle"></div></td>
                                            <td><div class="circle"></div></td>
                                            <td><div class="circle"></div></td>
                                        </tr>
                                        <tr id="colomn_jam_18">
                                            <td class="font-weight-bold" style="font-size:120%">18:00 - 19:00</td>
                                            <td><div class="circle"></div></td>
                                            <td><div class="circle"></div></td>
                                            <td><div class="circle"></div></td>
                                            <td><div class="circle"></div></td>
                                            <td><div class="circle"></div></td>
                                            <td><div class="circle"></div></td>
                                            <td><div class="circle"></div></td>
                                            <td><div class="circle"></div></td>
                                            <td><div class="circle"></div></td>
                                            <td><div class="circle"></div></td>
                                        </tr>
                                    </tbody>
                                </table>
                              </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">...</div>
                    <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">...</div>
                </div>

            </div>
        </section>
    </div>
</div>
<div id="pageMessages"></div>

@include('distribution_center.script.script_database')
@endsection

