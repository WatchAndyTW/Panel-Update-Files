{{-- Pterodactyl - Panel --}}
{{-- Copyright (c) 2015 - 2017 Dane Everitt <dane@daneeveritt.com> --}}

{{-- This software is licensed under the terms of the MIT license. --}}
{{-- https://opensource.org/licenses/MIT --}}
@extends('layouts.master')

@section('title')
    Backup
@endsection

@section('content-header')
    <h1>Backup</h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('index') }}">@lang('strings.home')</a></li>
        <li><a href="{{ route('server.index', $server->uuidShort) }}">{{ $server->name }}</a></li>
        <li>@lang('navigation.server.configuration')</li>
        <li class="active">Backup</li>
    </ol>
@endsection

@section('content')
<div class="row mt--7">
        <div class="col-lg-12">
            <div class="card shadow">
                <div class="card-header border-0">
                   <div class="row align-items-center">
                      <div class="col">
                    <h3 class="box-title">備份管理 | <button data-action="create" class="btn btn-sm btn-primary" style="border-radius: 0 3px 3px 0;margin-left:-1px;" type="button">建立新的備份</button></h3>
                    </div>
                </div>
            </div>
        </div>


        @if(!$saves->isEmpty())
            @foreach($saves as $save)
        <div class="card-header">
        <div class="box">
                        <h3 class="box-title"><i class="fa text-success fa-check-circle fa-1.5x">&nbsp;<i class="fa fa-save">  已儲存成功！</i></i> | 名稱：{{$save->name}}</h3>
                        <div class="col-xs-3 align-items-center">
									<span title="日期"><i style="color: green;" class="fa fa-history"></i> 備份日期：{{$save->date}}</span><br>
									<span title="原始備份名稱"><i style="color: orange;" class="fa fa-folder"></i> 原始備份名稱：{{$save->name}}.zip</span><br>
									<span title="加密備份名稱"><i style="color: red;" class="fa fa-terminal"></i> 加密備份名稱：{{$save->file}}.zip</span>
                        <div class="box-body">				
							<div class="row">
								<div class=" col-xs-3"> 
								</div>
								</div>
                        </div>
						<div class="box-footer">
							<div class="text-center">
								<a class="btn btn-success"
								   href="{{ route('server.backup.download', [$server->uuidShort, $save->id])}}"
								   title="下載備份">
									<b>下載備份</b>
								</a>
								<a class="btn btn-warning" href="#" data-action="restore"
								   data-id="{{$save->id}}"
								   title="還原備份">
                                   <b>還原備份</b>
								</a>
								<a class="btn btn-danger" href="#" data-action="delete"
								   data-id="{{$save->id}}"
								   title="刪除備份">
                                   <b>刪除備份</b>
								</a>
							</div>
						</div>
                    </div>
                </div>
                </div>
            @endforeach
        
        @else
            <div class="col-xs-12">
                <div class="alert alert-info alert-dismissable" role="alert">
                    目前沒有任何備份！
                </div>
            </div>
        @endif
    </div>
@endsection

@section('footer-scripts')
    @parent
    {!! Theme::js('js/frontend/server.socket.js') !!}
    <script>
        $('[data-action="create"]').click(function (event) {
            event.preventDefault();
            swal({
                type: 'warning',
                title: '建立備份',
                text: '這將會將您的伺服器強制關機並且開始備份，要繼續嗎？',
                showCancelButton: true,
                showConfirmButton: true,
                confirmButtonText: '我已經知道風險！',
                confirmButtonColor: '#d9534f',
                cancelButtonText: '取消',
                closeOnConfirm: false,
            }, function () {
                swal({
                    type: 'input',
                    title: '備份名稱',
                    text: '為您的備份取一個容易分辨的名字',
                    showCancelButton: true,
                    showConfirmButton: true,
                    confirmButtonText: '繼續',
                    cancelButtonText: '取消',
                    closeOnConfirm: false,
                    showLoaderOnConfirm: true
                }, function (name) {
                    if (name === false) return false;

                    if (name.trim() === '' || name.length < 1) {
                        swal.showInputError('無效的名稱或名稱過短！請試試別的名稱');
                        return false;
                    }

                    if (name.length > 20) {
                        swal.showInputError('名稱過長（最多20個字元），請嘗試縮短名稱');
                        return false;
                    }

                    $.ajax({
                        method: 'POST',
                        url: '/server/{{$server->uuidShort}}/backup/create',
                        headers: {'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')},
                        data: {name: name}
                    }).done(function (data) {
                        if (data.success === true) {
                            swal({
                                type: 'success',
                                title: '成功！',
                                text: '已成功建立備份，將會在備份完成後通知您',
                                confirmButtonText: '結束'
                            }, () => {
                                location.reload();
                            });
                        } else {
                            swal({
                                type: 'error',
                                title: '喔歐！',
                                text: (typeof data.error !== 'undefined') ? data.error : '目前暫時無法建立備份，請稍後再試...',
                                confirmButtonText: '結束'
                            });
                        }
                    }).fail(function (jqXHR) {
                        swal({
                            type: 'error',
                            title: '喔歐！',
                            text: (typeof jqXHR.responseJSON.error !== 'undefined') ? jqXHR.responseJSON.error : '在建立備份時發生了錯誤，請稍後再試...',
                            confirmButtonText: '結束'
                        });
                    });
                });
            });
        });

        $('[data-action="restore"]').click(function (event) {
            event.preventDefault();
            let self = $(this);
            swal({
                type: 'info',
                title: '恢復備份',
                text: '這將會將您的伺服器強制關機並且重新安裝和還原檔案，要繼續嗎？（這將會覆蓋現有檔案，請謹慎使用）',
                showCancelButton: true,
                showConfirmButton: true,
                confirmButtonText: '我已經知道風險！',
                confirmButtonColor: '#d9534f',
                cancelButtonText: '取消',
                closeOnConfirm: false,
                showLoaderOnConfirm: true
            }, function () {
                $.ajax({
                    method: 'POST',
                    url: '/server/{{$server->uuidShort}}/backup/restore',
                    headers: {'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')},
                    data: {id: self.data('id')}
                }).done(function (data) {
                    if (data.success === true) {
                        swal({
                            type: 'success',
                            title: '成功！',
                            text: '已開始還原備份，將會在還原完成後通知您',
                            confirmButtonText: '結束'
                        }, () => {
                            location.reload();
                        });
                    } else {
                        swal({
                            type: 'error',
                            title: '喔歐！',
                            text: (typeof data.error !== 'undefined') ? data.error : '目前暫時無法還原備份，請稍後再試...',
                            confirmButtonText: '結束'
                        });
                    }
                }).fail(function (jqXHR) {
                    swal({
                        type: 'error',
                        title: '喔歐！',
                        text: (typeof jqXHR.responseJSON.error !== 'undefined') ? jqXHR.responseJSON.error : '在還原備份時發生了錯誤，請稍後再試...',
                        confirmButtonText: '結束'
                    });
                });

            });
        });

        $('[data-action="delete"]').click(function (event) {
            event.preventDefault();
            let self = $(this);
            swal({
                title: '',
                type: 'warning',
                title: '刪除備份',
                text: '您確定要刪除這個備份？',
                showCancelButton: true,
                confirmButtonText: '確認刪除！',
                confirmButtonColor: '#d9534f',
                closeOnConfirm: false,
                showLoaderOnConfirm: true,
                cancelButtonText: '取消',
            }, function () {
                $.ajax({
                    method: 'DELETE',
                    url: '/server/{{$server->uuidShort}}/backup/delete',
                    headers: {'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')},
                    data: {
                        id: self.data('id')
                    }
                }).done(function (data) {
                        if (data.success === true) {
                            swal({
                                type: 'success',
                                title: '成功！',
                                text: '這個備份已經從系統刪除',
                                confirmButtonText: '結束'
                            }, () => {
                                location.reload();
                            });
                    } else {
                        swal({
                            type: 'error',
                            title: '喔歐！',
                            text: (typeof data.error !== 'undefined') ? data.error : '目前暫時無法刪除此備份，請稍後再試...',
                            confirmButtonText: '結束'
                        });
                    }
                }).fail(function (jqXHR) {
                    swal({
                        type: 'error',
                        title: '喔歐！',
                        text: (typeof jqXHR.responseJSON.error !== 'undefined') ? jqXHR.responseJSON.error : '在刪除備份時發生了錯誤，請稍後再試...',
                        confirmButtonText: '結束'
                    });
                });
            });
        });
    </script>
@endsection
