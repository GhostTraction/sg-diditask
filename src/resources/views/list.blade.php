@extends('web::layouts.grids.12')

@section('title', 'DKP')
@section('page_header', '我的DKP')

@push('head')
    <link rel="stylesheet"
          type="text/css"
          href="https://snoopy.crypta.tech/snoopy/seat-srp-approval.css"/>

    <link rel="stylesheet" type="text/css" href="{{ asset('web/css/denngarr-srp-hook.css') }}"/>
@endpush

@section('full')
    <div class="card card-primary card-solid">
        <div class="card-body">
            累计获取list:123456
        </div>
    </div>
@stop

@push('javascript')
@endpush