@extends('layouts.app_index')

@section('content')
<br>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="alert alert-secondary">
                    <div class="card-header">PT. PARKLAND WORLD INDONESIA 2</div>
                </div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">{{ session('status') }}</div>
                    @endif
                    WELCOME !
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

