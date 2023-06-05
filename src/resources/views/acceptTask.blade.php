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
            <div class="col-sm-9">
                <form action="{{ route('diditask.getMission') }}" method="post" id="formCreateSetting">
                    在此处粘贴 [待接受] 的信标名
                    <textarea type="text" class="form-control" name="missionList" id="missionList" rows="5">
                </textarea>
                    {{ csrf_field() }}
                </form>
                <br>
                <button type="button" class="btn btn-xs btn-primary srp-status" id="getMission"
                        value="Primary">接受任务
                </button>

            </div>
        </div>
    </div>
    <br>
    <div class="card card-primary card-solid">
        <div class="card-body">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active nav-item"><a class="nav-link active" href="#tab_1"
                                                   data-toggle="tab">我接受的任务</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="tab_1">
                        <table id="mineTask" class="table table-bordered">
                            <thead>
                            <tr>
                                <th>任务名</th>
                                <th>地点</th>
                                <th>任务奖励</th>
                                <th>任务状态</th>
                                <th>发布时间</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($myTasksList as $myTask)
                                <tr>
                                    <td>
                                        {{$myTask->taskname}}
                                    </td>
                                    <td>
                                        {{$myTask->location}}
                                    </td>
                                    <td>{{$myTask->Receiver_Rewards}}</td>
                                    @if(($myTask->status == 0))
                                        <td><span class="badge badge-primary">已发布</span></td>
                                    @elseif(($myTask->status == 1))
                                        <td><span class="badge badge-warning">已接受</span></td>
                                    @elseif(($myTask->status == 2))
                                        <td><span class="badge badge-success">已完成</span></td>
                                    @endif
                                    <td>
                                        {{$myTask->send_time}}
                                    </td>
                                    @if(($myTask->status ==1))
                                        <td>
                                            <button type="button" class="btn btn-xs btn-success srp-status" id="status"
                                                    name="{{ $myTask->id }}" value="Success">完成
                                            </button>
                                            <button type="button" class="btn btn-xs btn-danger srp-status" id="status"
                                                    name="{{ $myTask->id }}" value="Abandon">放弃
                                            </button>

                                        </td>
                                    @else
                                        <td>/</td>
                                    @endif
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@push('javascript')
    <script>
        $(document).ready(function () {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>

    <script type="application/javascript">

        $(function () {
            $('#mineTask').DataTable();
            $('#mineTask tbody').on('click', 'button', function (btn) {
                $.ajax({
                    headers: function () {
                    },
                    url: "{{ route('diditask.acceptTask') }}/" + btn.target.name + "/" + btn.target.value,
                    dataType: 'json',
                    timeout: 5000
                }).done(function (data) {
                    location.reload(bForceGet = true);
                });

            });
            $('#getMission').click(function () {
                $('#formCreateSetting').submit();
            });
        });


    </script>
@endpush