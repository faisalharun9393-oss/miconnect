@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-4">
        <div class="card text-white bg-primary mb-3 shadow">
            <div class="card-body">
                <h4 class="card-title">Jumlah Panitia</h4>
                <p class="card-text">{{ $jumlahPanitia }} orang</p>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card text-white bg-success mb-3 shadow">
            <div class="card-body">
                <h4 class="card-title">Jumlah Wali</h4>
                <p class="card-text">{{ $jumlahWali }} orang</p>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card text-white bg-info mb-3 shadow">
            <div class="card-body">
                <h4 class="card-title">Jumlah Murid</h4>
                <p class="card-text">{{ $jumlahMurid }} orang</p>
            </div>
        </div>
    </div>
</div>
@endsection
