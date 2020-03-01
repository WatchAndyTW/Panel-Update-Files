{{-- Pterodactyl - Panel --}}
{{-- Copyright (c) 2015 - 2017 Dane Everitt <dane@daneeveritt.com> --}}

{{-- This software is licensed under the terms of the MIT license. --}}
{{-- https://opensource.org/licenses/MIT --}}
@extends('layouts.admin')

@section('title')
    公告管理
@endsection

@section('content-header')
    <h1>Announcements<small>You can create, edit, delete announcements.</small></h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.index') }}">Admin</a></li>
        <li class="active">Announcements</li>
    </ol>
@endsection

@section('content')
<div class="row mt--7">
        <div class="col-lg-12">
            <div class="card shadow">
                <div class="card-header border-0">
                   <div class="row align-items-center">
                      <div class="col">
                    <h3 class="box-title">公告管理 | <a href="{{ route('admin.announcements.new') }}"><button type="button" class="btn btn-sm btn-primary" style="border-radius: 0 3px 3px 0;margin-left:-1px;">建立新的公告</button></a></h3>
                    <ol class="breadcrumb">
                           <li><a href="{{ route('admin.index') }}">管理員面板</a></li>
                           <li class="active">&nbsp;>>&nbsp;</li>
                           <li class="active">公告管理</a></li>
                    </div>
                </div>
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tbody>
                        <tr>
                            <th>編號</th>
                            <th>標題</th>
                            <th>內文</th>
                            <th>建立時間</th>
                            <th>上次更新時間</th>
                            <th>編輯/刪除</th>
                        </tr>
                        @foreach ($announcements as $announcement)
                            <tr>
                                <td>{{$announcement->id}}</td>
                                <td>{{$announcement->title}}</td>
                                <td>{{str_limit(strip_tags($announcement->body), 50)}}</td>
                                <td>{{$announcement->created_at}}</td>
                                <td>{{$announcement->updated_at}}</td>
                                <td class="text-center">
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.announcements.edit', $announcement->id) }}"><b>編輯</b></a>
                                    <a class="btn btn-xs btn-danger" data-action="delete" data-id="{{$announcement->id}}"><b>刪除</b></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer-scripts')
    @parent
    <script>
        $('[data-action="delete"]').click(function (event) {
            event.preventDefault();
            let self = $(this);
            swal({
                title: '',
                type: 'warning',
                text: '您確定要刪除這個公告？',
                showCancelButton: true,
                confirmButtonText: '刪除！',
                confirmButtonColor: '#d9534f',
                closeOnConfirm: false,
                showLoaderOnConfirm: true,
                cancelButtonText: 'Cancel',
            }, function () {
                $.ajax({
                    method: 'DELETE',
                    url: '/admin/announcements/delete',
                    headers: {'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')},
                    data: {
                        id: self.data('id')
                    }
                }).done(function (data) {
                    if (data.success === true) {
                        swal({
                            type: 'success',
                            title: '成功！',
                            text: '你成功刪除了這個公告！'
                        });

                        self.parent().parent().slideUp(1000);
                    } else {
                        swal({
                            type: 'error',
                            title: '喔歐!',
                            text: (typeof data.error !== 'undefined') ? data.error : '無法刪除公告，請稍後再試'
                        });
                    }
                }).fail(function (jqXHR) {
                    swal({
                        type: 'error',
                        title: '喔歐!',
                        text: (typeof jqXHR.responseJSON.error !== 'undefined') ? jqXHR.responseJSON.error : '在刪除公告的過程中發生了一點錯誤，請稍後再試'
                    });
                });
            });
        });
    </script>
@endsection
