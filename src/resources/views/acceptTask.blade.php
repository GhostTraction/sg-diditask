@extends('web::layouts.grids.12')

@section('title', '滴滴任务')
@section('page_header', '打手接受任务')

@push('head')
    <link rel="stylesheet"
          type="text/css"
          href="https://snoopy.crypta.tech/snoopy/seat-srp-approval.css"/>

    <link rel="stylesheet" type="text/css" href="{{ asset('web/css/denngarr-srp-hook.css') }}"/>
@endpush

@section('full')
    <div class="card card-primary card-solid">
        <div class="card-body">
            累计获取:123
        </div>
    </div>
    <br>
@stop

@push('javascript')

@endpush