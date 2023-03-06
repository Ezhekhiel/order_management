<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <!-- Bootstrap -->
        <link rel="stylesheet" href="{{ asset('dist/css/bootstrap.min.css') }}">
        <link href="https://fonts.cdnfonts.com/css/calibri-light" rel="stylesheet">
    <style>
        @import url('https://fonts.cdnfonts.com/css/calibri-light');
        body {
            background: rgb(204,204,204);
            font-family: 'Calibri Light', sans-serif;
        }
        page[size="A4"] {
            background: white;
            width: 21cm;
            height: 29.7cm;
            display: block;
            margin: 0 auto;
            margin-bottom: 0.5cm;
            box-shadow: 0 0 0.5cm rgba(0,0,0,0.5);
            border: 1px solid #000;
        }
        @media print {
            body, page[size="A4"] {
                margin: 0;
                box-shadow: 0;
            }
        }
        table tr{
            line-height: 14px;
            font-size: 80%;
        }
        .r-font{
            font-size: 80%;
        }
    </style>
</head>
<body>
    <page size="A4">
        <table class="m-2 table-responsive table-bordered" style="max-width:100%">
            <thead>
                <tr>
                    <th style="width: 20%" class="text-center" colspan="2" rowspan="4"><img width="50%" height="50%" src="{{ asset('/dist/img/ICON - FORM MUTASI.png') }}" alt="Responsive image"></th>
                    <th colspan="2" rowspan="2" class="fw-bolder fs-3">{{ $title }}</th>
                    <th colspan="4" style="font-size:80%" id="no_dokument">Dokumen : PWI-LEAN-F-006</th>
                    <th>Halaman</th>
                    <th id="halaman_id">1 / 2</th>
                </tr>
                <tr>
                    <th colspan="4" style="font-style:italic">No Dukumen</th>
                    <th style="font-size:80%">Tanggal-Efektif :</th>
                    <th style="font-size:80%" colspan="2">: {{ $tanggal }}</th>
                </tr>
                <tr>
                    <th colspan="6" class="fs-5 fw-bolder">Area : Distribution Center</th>
                    <th>Revisi</th>
                    <th>: -</th>
                </tr>
                <tr>
                    <th colspan="6" style="font-style:italic">Nama Dokumen</th>
                    <th>R. Tanggal</th>
                    <th>: -</th>
                </tr>
            </thead>
        </table>
        <table class="table m-2 table-responsive table-bordered text-center" style="max-width:20.5cm;">
            <thead style="background-color:rgb(149, 149, 149); border:1px solid black">
                <tr>
                    <th>N0</th>
                    <th>PO</th>
                    <th>STYLE</th>
                    <th>XFD</th>
                    <th>CELL AWAL</th>
                    @if ($title == "FORM MUTASI")
                        <th>CELL REQ</th>
                    @endif
                    <th>SIZE</th>
                    <th>QTY SET</th>
                </tr>
            </thead>
            <tbody style="font-size: 80%; border:1px solid black">
                @php
                    $no=0;
                @endphp
                @foreach ($getDataSPK as $a)
                @php
                    $no++;
                @endphp
                    <tr>
                        <td>{{ $no }}</td>
                        <td>{{ $a->po }}</td>
                        <td>{{ $a->style }}</td>
                        <td>{{ $a->xfd }}</td>
                        <td>{{ $a->cell }}</td>
                        @if ($title == "FORM MUTASI")
                            <td>{{ $a->new_cell }}</td>
                        @endif
                        <td>{{ $a->size }}</td>
                        <td>{{ $a->qty_set }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <p class="m-2 fw-bolder r-font" style="font-style:italic;">Menyetujui :</p>
        <table class="m-2 table-bordered table-responsive text-center r-font"style="width:20%;">
            <thead style=" border:1px solid black">
                <tr>
                    <th>ADMIN DC</th>
                </tr>
            </thead>
            <tbody style=" border:1px solid black">
                <tr>
                    <td style="height:65px"></td>
                </tr>
            </tbody>
        </table>
            <small class="m-2" style="color:red">Dokumen untuk Production</small>
        @if ($counttable<=8)
            <hr style="border-top: 5px dashed black;" />
        @endif
        @php
            $style = "";
            if($counttable>8){
                $style = "visibility: hidden;";
            }
        @endphp
        <div style="{{ $style }}">
            <table class="m-2 table-responsive table-bordered" style="max-width:100%">
                <thead>
                    <tr>
                        <th style="width: 20%" class="text-center" colspan="2" rowspan="4"><img width="50%" height="50%" src="{{ asset('/dist/img/ICON - FORM MUTASI.png') }}" alt="Responsive image"></th>
                        <th colspan="2" rowspan="2" class="fw-bolder fs-3">{{ $title }}</th>
                        <th colspan="4" style="font-size:80%">Dokumen : PWI-LEAN-F-006</th>
                        <th>Halaman</th>
                        <th>2 / 2</th>
                    </tr>
                    <tr>
                        <th colspan="4" style="font-style:italic">No Dukumen</th>
                        <th style="font-size:80%">Tanggal-Efektif :</th>
                        @if ($counttable<=8)
                            <th style="font-size:80%" colspan="2">: {{ $tanggal }}</th>
                        @endif
                    </tr>
                    <tr>
                        <th colspan="6" class="fs-5 fw-bolder">Area : Distribution Center</th>
                        <th>Revisi</th>
                        <th>: -</th>
                    </tr>
                    <tr>
                        <th colspan="6" style="font-style:italic">Nama Dokumen</th>
                        <th>R. Tanggal</th>
                        <th>: -</th>
                    </tr>
                    {{-- <tr>
                        <th class="text-center" colspan="2" style="font-size: 80%">PT. PARKLAND WORLD INDONESIA 2</th>
                    </tr> --}}
                </thead>
            </table>
            <table class="table m-2 table-responsive table-bordered text-center" style="max-width:20.5cm;">
                <thead style="background-color:rgb(149, 149, 149); border:1px solid black">
                    <tr>
                        <th>N0</th>
                        <th>PO</th>
                        <th>STYLE</th>
                        <th>XFD</th>
                        <th>CELL AWAL</th>
                        @if ($title == "FORM MUTASI")
                            <th>CELL REQ</th>
                        @endif
                        <th>SIZE</th>
                        <th>QTY SET</th>
                    </tr>
                </thead>
                <tbody style="font-size: 80%; border:1px solid black">
                    @php
                        $no=0;
                    @endphp
                    @foreach ($getDataSPK as $a)
                        @php
                            $no++;
                        @endphp
                        @if ($counttable<=8)
                            <tr>
                                <td>{{ $no }}</td>
                                <td>{{ $a->po }}</td>
                                <td>{{ $a->style }}</td>
                                <td>{{ $a->xfd }}</td>
                                <td>{{ $a->cell }}</td>
                                @if ($title == "FORM MUTASI")
                                    <td>{{ $a->new_cell }}</td>
                                @endif
                                <td>{{ $a->size }}</td>
                                <td>{{ $a->qty_set }}</td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
            <p class="m-2 fw-bolder r-font" style="font-style:italic;">Menyetujui :</p>
            @if ($title=="FORM MUTASI")
                <table class="table m-2 table-bordered table-responsive text-center r-font" style="max-width:20.5cm;">
                    <thead style="border:1px solid black">
                        <tr>
                            <th class="col-md-2">PLANNER PEMOHON</th>
                            <th class="col-md-2">PLANNER PEMILIK</th>
                            <th class="col-md-2">LEADER DC</th>
                            <th class="col-md-2">MANAGER</th>
                            <th class="col-md-2">FACTORY MANAGER</th>
                        </tr>
                    </thead>
                    <tbody style="border:1px solid black">
                        <tr>
                            <td style="height: 65px"></td>
                            <td style="height: 65px"></td>
                            <td style="height: 65px"></td>
                            <td style="height: 65px"></td>
                            <td style="height: 65px"></td>
                        </tr>
                        <tr>
                            @if ($counttable<=8)
                                <td>{{ $planner_A }}</td>
                                <td>{{ $planner_B }}</td>
                                <td>{{ $leader }}</td>
                                <td>{{ $manager }}</td>
                                <td>{{ $fact_manager }}</td>
                            @endif
                        </tr>
                    </tbody>
                </table>
            @endif
            @if ($title == "FORM TRANSFER")
                <table class="m-2 table-bordered table-responsive text-center r-font"style="width:20%;">
                    <thead style=" border:1px solid black">
                        <tr>
                            <th>PENERIMA</th>
                        </tr>
                    </thead>
                    <tbody style=" border:1px solid black">
                        <tr>
                            <td style="height: 65px"></td>
                        </tr>
                        <tr>
                            <td>{{ $serah_terima }}</td>
                        </tr>
                    </tbody>
                </table>
            @endif
            <small class="m-2" style="color:red">Dokumen untuk admin DC</small>
        </div>
    </page>
    @if ($counttable>8)
        <page size="A4">
            <table class="m-2 table-responsive table-bordered" style="max-width:100%">
                <thead>
                    <tr>
                        <th style="width: 20%" class="text-center" colspan="2" rowspan="4"><img width="50%" height="50%" src="{{ asset('/dist/img/ICON - FORM MUTASI.png') }}" alt="Responsive image"></th>
                        <th colspan="2" rowspan="2" class="fw-bolder fs-3">{{ $title }}</th>
                        <th colspan="4" style="font-size:80%" id="no_dokument">Dokumen : PWI-LEAN-F-006</th>
                        <th>Halaman</th>
                        <th id="halaman_id">2 / 2</th>
                    </tr>
                    <tr>
                        <th colspan="4" style="font-style:italic">No Dukumen</th>
                        <th style="font-size:80%">Tanggal-Efektif :</th>
                        <th style="font-size:80%" colspan="2">: {{ $tanggal }}</th>
                    </tr>
                    <tr>
                        <th colspan="6" class="fs-5 fw-bolder">Area : Distribution Center</th>
                        <th>Revisi</th>
                        <th>: -</th>
                    </tr>
                    <tr>
                        <th colspan="6" style="font-style:italic">Nama Dokumen</th>
                        <th>R. Tanggal</th>
                        <th>: -</th>
                    </tr>
                </thead>
            </table>
            <table class="table m-2 table-responsive table-bordered text-center" style="max-width:20.5cm;">
                <thead style="background-color:rgb(149, 149, 149); border:1px solid black">
                    <tr>
                        <th>N0</th>
                        <th>PO</th>
                        <th>STYLE</th>
                        <th>XFD</th>
                        <th>CELL AWAL</th>
                        @if ($title == "FORM MUTASI")
                            <th>CELL REQ</th>
                        @endif
                        <th>SIZE</th>
                        <th>QTY SET</th>
                        <th>JAM</th>
                    </tr>
                </thead>
                <tbody style="font-size: 80%; border:1px solid black">
                    @php
                        $no=0;
                    @endphp
                    @foreach ($getDataSPK as $a)
                    @php
                        $no++;
                    @endphp
                        <tr>
                            <td>{{ $no }}</td>
                            <td>{{ $a->po }}</td>
                            <td>{{ $a->style }}</td>
                            <td>{{ $a->xfd }}</td>
                            <td>{{ $a->cell }}</td>
                            @if ($title == "FORM MUTASI")
                                <td>{{ $a->new_cell }}</td>
                            @endif
                            <td>{{ $a->size }}</td>
                            <td>{{ $a->qty_set }}</td>
                            <td>{{ $a->jam }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <p class="m-2 fw-bolder" style="font-style:italic;">Menyetujui :</p>
            @if ($title=="FORM MUTASI")
            <table class="table m-2 table-bordered table-responsive text-center" style="max-width:20.5cm;">
                <thead style="border:1px solid black">
                    <tr>
                        <th class="col-md-2">PLANNER PEMOHON</th>
                        <th class="col-md-2">PLANNER PEMILIK</th>
                        <th class="col-md-2">LEADER DC</th>
                        <th class="col-md-2">MANAGER</th>
                        <th class="col-md-2">FACTORY MANAGER</th>
                    </tr>
                </thead>
                <tbody style="border:1px solid black">
                    <tr>
                        <td style="height: 65px"></td>
                        <td style="height: 65px"></td>
                        <td style="height: 65px"></td>
                        <td style="height: 65px"></td>
                        <td style="height: 65px"></td>
                    </tr>
                    <tr>
                        <td>{{ $planner_A }}</td>
                        <td>{{ $planner_B }}</td>
                        <td>{{ $leader }}</td>
                        <td>{{ $manager }}</td>
                        <td>{{ $fact_manager }}</td>
                    </tr>
                </tbody>
            </table>
            @endif
            @if ($title == "FORM TRANSFER")
                <table class="m-2 table-bordered table-responsive text-center"style="width:20%;">
                    <thead style=" border:1px solid black">
                        <tr>
                            <th>PENERIMA</th>
                        </tr>
                    </thead>
                    <tbody style=" border:1px solid black">
                        <tr>
                            <td style="height: 65px"></td>
                        </tr>
                        <tr>
                            <td>{{ $serah_terima }}</td>
                        </tr>
                    </tbody>
                </table>
            @endif
            <small class="m-2" style="color:red">Dokumen untuk admin DC</small>
        </page>
    @endif
</html>
