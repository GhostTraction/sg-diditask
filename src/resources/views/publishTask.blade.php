@extends('web::layouts.grids.12')

@section('title', '滴滴任务')
@section('page_header', '老板发布任务')

@push('head')
    <link rel="stylesheet"
          type="text/css"
          href="https://snoopy.crypta.tech/snoopy/seat-srp-approval.css"/>

    <link rel="stylesheet" type="text/css" href="{{ asset('web/css/denngarr-srp-hook.css') }}"/>
@endpush

@section('full')
    <div class="card card-primary card-solid">
        <div class="card-body">
            <form class="form-horizontal" action="{{ route('diditask.submitMission') }}" method="post"
                  id="formCreateSetting">
                <div class="form-group row">
                    <label for="title" class="col-sm-3 col-form-label">安全关系学:
                    </label>
                    <div class="col-sm-4">
                        <select class="form-control" name="setting_label" id="setting_label"
                                onchange="selectLabel()">
                            <option value="1" selected>0级</option>
                            <option value="1.1">1级</option>
                            <option value="1.2">2级</option>
                            <option value="1.3">3级</option>
                            <option value="1.4">4级</option>
                            <option value="1.5">5级</option>
                        </select>
                    </div>
                </div>

                {{-- LP比例 --}}
                <div id="score" class="form-group row">
                    <label for="title" class="col-sm-3 col-form-label">LP比例:
                    </label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" name="score" id="lpScore"
                               placeholder="LP比例" value="600" oninput="selectLabel()">
                    </div>
                </div>
                {{-- 任务名 --}}
                <div style="display: none">
                    <input type="text" class="form-control" name="missionName" id="missionName"
                           placeholder="任务名" value="">
                </div>
                {{-- 任务奖励 --}}
                <div style="display: none">
                    <input type="text" class="form-control" name="missionScore" id="missionScore"
                           placeholder="任务奖励" value="">
                </div>
                {{ csrf_field() }}
            </form>
            <div>
                速刷
                <br>
                <button type="button" id="sushuabaoleim"
                        name="" value="Success">堡垒(M)[14m]
                </button>
                <button type="button" id="sushuabaoleig"
                        name="" value="Success">堡垒(G)[14m]
                </button>
                <button type="button" id="mielongixngdong"
                        name="" value="Success">灭龙行动[14m]
                </button>
                <button type="button" id="jinghuahuoyan"
                        name="" value="Success">净化火焰[14m]
                </button>
                <button type="button" id="koushuizhan"
                        name="" value="Success">口水战[19m]
                </button>
                <button type="button" id="kaituohao"
                        name="" value="Success">开拓号[15m]
                </button>
                <button type="button" id="xideng"
                        name="" value="Success">熄灯[14m]
                </button>
            </div>
            <br>
            <div>
                牌子1
                <br>
                <button type="button" id="jueduiyansu"
                        name="" value="Success">绝对严肃[19m]
                </button>
                <button type="button" id="xijihuhangduim"
                        name="" value="Success">袭击护航队(M)[17m]
                </button>
                <button type="button" id="quzhuqiangdaom"
                        name="" value="Success">驱逐强盗(M)[19m]
                </button>
                <button type="button" id="xijihuhangduig"
                        name="" value="Success">袭击护航队(G)[19m]
                </button>
                <button type="button" id="quzhuqiangdaog"
                        name="" value="Success">驱逐强盗(G)[18m]
                </button>
            </div>
            <br>
            <div>
                牌子2
                <br>
                <button type="button" id="juxingqudongqi"
                        name="" value="Success">巨型驱动器[19m]
                </button>
                <button type="button" id="zhongzhongyibie1"
                        name="" value="Success">重重一鳖(1/3)[19m]
                </button>
                <button type="button" id="zhongzhongyibie2"
                        name="" value="Success">重重一鳖(2/3)[19m]
                </button>
            </div>
            <br>
            <div>
                赏金
                <br>
                <button type="button" id="ziyoujiandie1"
                        name="" value="Success">自由间谍(1/3)[19m]
                </button>
                <button type="button" id="ziyouzhuibu2"
                        name="" value="Success">自由追捕(2/3)[19m]
                </button>
                <button type="button" id="ziyougenchu3"
                        name="" value="Success">自由根除(3/3)[19m]
                </button>
            </div>
            <br>
            <div>
                其他
                <br>
                <button type="button" id="sazhuquwu"
                        name="" value="Success">萨沙取物[14m]
                </button>
                <button type="button" id="sazhadihengxian"
                        name="" value="Success">萨沙地平线[9m]
                </button>
                <button type="button" id="qinglimenh"
                        name="" value="Success">清理门户[14m]
                </button>
                <button type="button" id="tianshidemingyun"
                        name="" value="Success">天使的命运[19m]
                </button>
                <button type="button" id="tianshidefennu"
                        name="" value="Success">天使的愤怒[13m]
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
                                                   data-toggle="tab">我发布的任务</a>
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
                                    @if(($myTask->status == 0))
                                        <td>
                                            <button type="button" class="btn btn-xs btn-danger srp-status" id="status"
                                                    name="{{ $myTask->id }}" value="Delete">删除
                                            </button>
                                        </td>
                                    @else
                                        <td>
                                            /
                                        </td>
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
        });

        function selectLabel() {
            var val = $('#setting_label option:selected').val();
            var score = $('#lpScore').val();
            //速刷
            document.getElementById('sushuabaoleim').innerHTML = '堡垒(M)[' + Math.round(45202 * val * score / 2000000) + 'm]';
            document.getElementById('sushuabaoleig').innerHTML = '堡垒(G)[' + Math.round(45202 * val * score / 2000000) + 'm]';
            document.getElementById('mielongixngdong').innerHTML = '灭龙行动[' + Math.round(47185.33 * val * score / 2000000) + 'm]';
            document.getElementById('jinghuahuoyan').innerHTML = '净化火焰[' + Math.round(47216.67 * val * score / 2000000) + 'm]';
            document.getElementById('koushuizhan').innerHTML = '口水战[' + Math.round(62248.67 * val * score / 2000000) + 'm]';
            document.getElementById('kaituohao').innerHTML = '开拓号[' + Math.round(51360.67 * val * score / 2000000) + 'm]';
            document.getElementById('xideng').innerHTML = '熄灯[' + Math.round(47216.67 * val * score / 2000000) + 'm]';
            //牌子1
            document.getElementById('jueduiyansu').innerHTML = '绝对严肃[' + Math.round(62248.67 * val * score / 2000000) + 'm]';
            document.getElementById('xijihuhangduim').innerHTML = '袭击护航队(M)[' + Math.round(57940 * val * score / 2000000) + 'm]';
            document.getElementById('xijihuhangduig').innerHTML = '袭击护航队(G)[' + Math.round(64221 * val * score / 2000000) + 'm]';
            document.getElementById('quzhuqiangdaom').innerHTML = '驱逐强盗(M)[' + Math.round(62248.67 * val * score / 2000000) + 'm]';
            document.getElementById('quzhuqiangdaog').innerHTML = '驱逐强盗(G)[' + Math.round(60576.67 * val * score / 2000000) + 'm]';
            //牌子2
            document.getElementById('juxingqudongqi').innerHTML = '巨型驱动器[' + Math.round(62248.67 * val * score / 2000000) + 'm]';
            document.getElementById('zhongzhongyibie1').innerHTML = '重重一鳖(1/3)[' + Math.round(62248.67 * val * score / 2000000) + 'm]';
            document.getElementById('zhongzhongyibie2').innerHTML = '重重一鳖(2/3)[' + Math.round(62248.67 * val * score / 2000000) + 'm]';
            //赏金
            document.getElementById('ziyoujiandie1').innerHTML = '自由间谍(1/3)[' + Math.round(62248.67 * val * score / 2000000) + 'm]';
            document.getElementById('ziyouzhuibu2').innerHTML = '自由追捕(2/3)[' + Math.round(62248.67 * val * score / 2000000) + 'm]';
            document.getElementById('ziyougenchu3').innerHTML = '自由根除(3/3)[' + Math.round(62248.67 * val * score / 2000000) + 'm]';
            //其他
            document.getElementById('sazhuquwu').innerHTML = '萨沙取物[' + Math.round(45750.67 * val * score / 2000000) + 'm]';
            document.getElementById('sazhadihengxian').innerHTML = '萨沙地平线[' + Math.round(29294.67 * val * score / 2000000) + 'm]';
            document.getElementById('qinglimenh').innerHTML = '清理门户[' + Math.round(46962 * val * score / 2000000) + 'm]';
            document.getElementById('tianshidemingyun').innerHTML = '天使的命运[' + Math.round(62248.67 * val * score / 2000000) + 'm]';
            document.getElementById('tianshidefennu').innerHTML = '天使的愤怒[' + Math.round(43078.67 * val * score / 2000000) + 'm]';

        }

        $('#sushuabaoleim').click(function () {
            var val = $('#setting_label option:selected').val();
            var score = $('#lpScore').val();
            $('#formCreateSetting').find('input[name="missionName"]').val('堡垒(M)');
            $('#formCreateSetting').find('input[name="missionScore"]').val(Math.round(45202 * val * score / 2));
            $('#formCreateSetting').submit();
        });
        $('#sushuabaoleig').click(function () {
            var val = $('#setting_label option:selected').val();
            var score = $('#lpScore').val();
            $('#formCreateSetting').find('input[name="missionName"]').val('堡垒(G)');
            $('#formCreateSetting').find('input[name="missionScore"]').val(Math.round(45202 * val * score / 2));
            $('#formCreateSetting').submit();
        });
        $('#mielongixngdong').click(function () {
            var val = $('#setting_label option:selected').val();
            var score = $('#lpScore').val();
            $('#formCreateSetting').find('input[name="missionName"]').val('灭龙行动');
            $('#formCreateSetting').find('input[name="missionScore"]').val(Math.round(47185.33 * val * score / 2));
            $('#formCreateSetting').submit();
        });
        $('#jinghuahuoyan').click(function () {
            var val = $('#setting_label option:selected').val();
            var score = $('#lpScore').val();
            $('#formCreateSetting').find('input[name="missionName"]').val('净化火焰');
            $('#formCreateSetting').find('input[name="missionScore"]').val(Math.round(47216.67 * val * score / 2));
            $('#formCreateSetting').submit();
        });
        $('#koushuizhan').click(function () {
            var val = $('#setting_label option:selected').val();
            var score = $('#lpScore').val();
            $('#formCreateSetting').find('input[name="missionName"]').val('口水战');
            $('#formCreateSetting').find('input[name="missionScore"]').val(Math.round(62248.67 * val * score / 2));
            $('#formCreateSetting').submit();
        });
        $('#kaituohao').click(function () {
            var val = $('#setting_label option:selected').val();
            var score = $('#lpScore').val();
            $('#formCreateSetting').find('input[name="missionName"]').val('开拓号');
            $('#formCreateSetting').find('input[name="missionScore"]').val(Math.round(51360.67 * val * score / 2));
            $('#formCreateSetting').submit();
        });
        $('#xideng').click(function () {
            var val = $('#setting_label option:selected').val();
            var score = $('#lpScore').val();
            $('#formCreateSetting').find('input[name="missionName"]').val('熄灯');
            $('#formCreateSetting').find('input[name="missionScore"]').val(Math.round(47216.67 * val * score / 2));
            $('#formCreateSetting').submit();
        });
        $('#jueduiyansu').click(function () {
            var val = $('#setting_label option:selected').val();
            var score = $('#lpScore').val();
            $('#formCreateSetting').find('input[name="missionName"]').val('绝对严肃');
            $('#formCreateSetting').find('input[name="missionScore"]').val(Math.round(62248.67 * val * score / 2));
            $('#formCreateSetting').submit();
        });
        $('#xijihuhangduim').click(function () {
            var val = $('#setting_label option:selected').val();
            var score = $('#lpScore').val();
            $('#formCreateSetting').find('input[name="missionName"]').val('袭击护航队(M)');
            $('#formCreateSetting').find('input[name="missionScore"]').val(Math.round(57940 * val * score / 2));
            $('#formCreateSetting').submit();
        });
        $('#xijihuhangduig').click(function () {
            var val = $('#setting_label option:selected').val();
            var score = $('#lpScore').val();
            $('#formCreateSetting').find('input[name="missionName"]').val('袭击护航队(G)');
            $('#formCreateSetting').find('input[name="missionScore"]').val(Math.round(64221 * val * score / 2));
            $('#formCreateSetting').submit();
        });
        $('#quzhuqiangdaom').click(function () {
            var val = $('#setting_label option:selected').val();
            var score = $('#lpScore').val();
            $('#formCreateSetting').find('input[name="missionName"]').val('驱逐强盗(M)');
            $('#formCreateSetting').find('input[name="missionScore"]').val(Math.round(62248.67 * val * score / 2));
            $('#formCreateSetting').submit();
        });
        $('#quzhuqiangdaog').click(function () {
            var val = $('#setting_label option:selected').val();
            var score = $('#lpScore').val();
            $('#formCreateSetting').find('input[name="missionName"]').val('驱逐强盗(G)');
            $('#formCreateSetting').find('input[name="missionScore"]').val(Math.round(60576.67 * val * score / 2));
            $('#formCreateSetting').submit();
        });
        $('#juxingqudongqi').click(function () {
            var val = $('#setting_label option:selected').val();
            var score = $('#lpScore').val();
            $('#formCreateSetting').find('input[name="missionName"]').val('巨型驱动器');
            $('#formCreateSetting').find('input[name="missionScore"]').val(Math.round(62248.67 * val * score / 2));
            $('#formCreateSetting').submit();
        });
        $('#zhongzhongyibie1').click(function () {
            var val = $('#setting_label option:selected').val();
            var score = $('#lpScore').val();
            $('#formCreateSetting').find('input[name="missionName"]').val('重重一鳖(1/3)');
            $('#formCreateSetting').find('input[name="missionScore"]').val(Math.round(62248.67 * val * score / 2));
            $('#formCreateSetting').submit();
        });
        $('#zhongzhongyibie2').click(function () {
            var val = $('#setting_label option:selected').val();
            var score = $('#lpScore').val();
            $('#formCreateSetting').find('input[name="missionName"]').val('重重一鳖2/3');
            $('#formCreateSetting').find('input[name="missionScore"]').val(Math.round(62248.67 * val * score / 2));
            $('#formCreateSetting').submit();
        });
        $('#ziyoujiandie1').click(function () {
            var val = $('#setting_label option:selected').val();
            var score = $('#lpScore').val();
            $('#formCreateSetting').find('input[name="missionName"]').val('自由间谍(1/3)');
            $('#formCreateSetting').find('input[name="missionScore"]').val(Math.round(62248.67 * val * score / 2));
            $('#formCreateSetting').submit();
        });
        $('#ziyouzhuibu2').click(function () {
            var val = $('#setting_label option:selected').val();
            var score = $('#lpScore').val();
            $('#formCreateSetting').find('input[name="missionName"]').val('自由追捕(2/3)');
            $('#formCreateSetting').find('input[name="missionScore"]').val(Math.round(62248.67 * val * score / 2));
            $('#formCreateSetting').submit();
        });
        $('#ziyougenchu3').click(function () {
            var val = $('#setting_label option:selected').val();
            var score = $('#lpScore').val();
            $('#formCreateSetting').find('input[name="missionName"]').val('自由根除(3/3)');
            $('#formCreateSetting').find('input[name="missionScore"]').val(Math.round(62248.67 * val * score / 2));
            $('#formCreateSetting').submit();
        });
        $('#sazhuquwu').click(function () {
            var val = $('#setting_label option:selected').val();
            var score = $('#lpScore').val();
            $('#formCreateSetting').find('input[name="missionName"]').val('萨沙取物');
            $('#formCreateSetting').find('input[name="missionScore"]').val(Math.round(45750.67 * val * score / 2));
            $('#formCreateSetting').submit();
        });
        $('#sazhadihengxian').click(function () {
            var val = $('#setting_label option:selected').val();
            var score = $('#lpScore').val();
            $('#formCreateSetting').find('input[name="missionName"]').val('萨沙地平线');
            $('#formCreateSetting').find('input[name="missionScore"]').val(Math.round(29294.67 * val * score / 2));
            $('#formCreateSetting').submit();
        });
        $('#qinglimenh').click(function () {
            var val = $('#setting_label option:selected').val();
            var score = $('#lpScore').val();
            $('#formCreateSetting').find('input[name="missionName"]').val('清理门户');
            $('#formCreateSetting').find('input[name="missionScore"]').val(Math.round(46962 * val * score / 2));
            $('#formCreateSetting').submit();
        });
        $('#tianshidemingyun').click(function () {
            var val = $('#setting_label option:selected').val();
            var score = $('#lpScore').val();
            $('#formCreateSetting').find('input[name="missionName"]').val('天使的命运');
            $('#formCreateSetting').find('input[name="missionScore"]').val(Math.round(62248.67 * val * score / 2));
            $('#formCreateSetting').submit();
        });
        $('#tianshidefennu').click(function () {
            var val = $('#setting_label option:selected').val();
            var score = $('#lpScore').val();
            $('#formCreateSetting').find('input[name="missionName"]').val('天使的愤怒');
            $('#formCreateSetting').find('input[name="missionScore"]').val(Math.round(43078.67 * val * score / 2));
            $('#formCreateSetting').submit();
        });

    </script>
@endpush