@extends('layouts.app_index')

@section('content')
<br>

<div class="container-fluid">
    <div class="row justify-content-center">
        <section class="col-lg-12 connectedSortable">
            <div class="card">
                <div class="card-header bg-secondary">
                    <h3 class="card-title">INCOMING DATABASE</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    @if(count($errors) > 0)
                        <div class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                            {{ $error }} <br/>
                            @endforeach
                        </div>
                    @endif
                    @if ($message = Session::get('status'))
                        <div class="alert alert-success alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>{{ $message }}</strong>
                        </div>
                    @endif
                    <div class="card col-2 p-2">
                        <div class="card-body">
                            <form action="{{ '/dc/database/import' }}" method="post" enctype="multipart/form-data">
                            @csrf
                                <div class="col-2">
                                    <input type="file" name="file" id="fileID">
                                </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary btn-block mb-2">Upload</button>
                            </form>
                            <form action="/dc/database/download" method="post" enctype="multipart/form-data">
                                @csrf
                                <button type="submit" class="btn btn-info btn-block">Download Contoh File</button>
                            </form>
                        </div>
                    </div>
                    <div class="card-col-12">
                        <div style="overflow-x:auto;">
                            <table class="table">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Buymonth</th>
                                        <th>New Cell</th>
                                        <th>Style</th>
                                        <th>Wide</th>
                                        <th>PO NO</th>
                                        <th>XFD</th>
                                        <th>QTY</th>
                                        <th>Size_1</th>
                                        <th>Size_2</th>
                                        <th>Size_3</th>
                                        <th>Size_4</th>
                                        <th>Size_5</th>
                                        <th>Size_6</th>
                                        <th>Size_7</th>
                                        <th>Size_8</th>
                                        <th>Size_9</th>
                                        <th>Size_10</th>
                                        <th>Size_11</th>
                                        <th>Size_12</th>
                                        <th>Size_13</th>
                                        <th>Size_14</th>
                                        <th>Size_15</th>
                                        <th>Size_16</th>
                                        <th>Size_17</th>
                                        <th>Size_18</th>
                                        <th>Size_19</th>
                                        <th>Size_20</th>
                                        <th>Size_21</th>
                                        <th>Size_22</th>
                                        <th>Size_23</th>
                                        <th>Size_24</th>
                                        <th>Size_25</th>
                                        <th>Size_26</th>
                                        <th>Size_27</th>
                                        <th>Size_28</th>
                                        <th>Size_29</th>
                                    </tr>
                                </thead>
                            </table>
                          </div>
                    </div>
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
@include('distribution_center.script.script_database')
@endsection

