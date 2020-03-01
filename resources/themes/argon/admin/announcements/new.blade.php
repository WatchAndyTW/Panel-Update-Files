{{-- Pterodactyl - Panel --}}
{{-- Copyright (c) 2015 - 2017 Dane Everitt <dane@daneeveritt.com> --}}

{{-- This software is licensed under the terms of the MIT license. --}}
{{-- https://opensource.org/licenses/MIT --}}
@extends('layouts.admin')

@section('title')
    建立公告
@endsection

@section('content-header')
    <h1>建立公告
        <small>You can create announcements.</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.index') }}">Admin</a></li>
        <li class="active">建立公告</li>
    </ol>
@endsection

@section('content')
     <div class="row mt--7">
        <div class="col-lg-12">
            <div class="card shadow">
                <div class="card-header border-0">
                   <div class="row align-items-center">
                      <div class="col">
                    <h3 class="box-title">建立公告 | <a href="{{ route('admin.announcements') }}"><button type="button" class="btn btn-sm btn-primary" style="border-radius: 0 3px 3px 0;margin-left:-1px;">回到上一頁</button></a></h3>
                    <ol class="breadcrumb">
                           <li><a href="{{ route('admin.index') }}">管理員面板</a></li>
                           <li class="active">&nbsp;>>&nbsp;</li>
                           <li><a href="{{ route('admin.announcements') }}">公告管理</a></li>
                           <li class="active">&nbsp;>>&nbsp;</li>
                           <li class="active">建立公告</a></li>
                           </div>
                </div>
                <form method="post" action="{{ route('admin.announcements.create')  }}">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="title" class="form-label">標題</label>
                            <input type="text" name="title" id="title" class="form-control" value="" />
                        </div>
                        <div class="form-group">
                            <label for="body" class="form-label">內文</label>
                            <textarea name="body" id="body" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="box-footer">
                        {!! csrf_field() !!}
                        <button class="btn btn-success pull-right" type="submit">建立公告</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('footer-scripts')
    @parent
    <script src="//cdn.ckeditor.com/ckeditor5/12.4.0/classic/ckeditor.js"></script>

    <script>
        function MinHeightPlugin(editor) {
            this.editor = editor;
        }

        MinHeightPlugin.prototype.init = function() {
            this.editor.ui.view.editable.extendTemplate({
                attributes: {
                    style: {
                        minHeight: '300px'
                    }
                }
            });
        };

        ClassicEditor.builtinPlugins.push(MinHeightPlugin);
        ClassicEditor
            .create( document.querySelector( '#body' ) )
            .catch( error => {
                console.error( error );
            } );
    </script>
@endsection
