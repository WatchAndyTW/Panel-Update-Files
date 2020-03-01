@extends('layouts.admin')
@include('partials/admin.settings.nav', ['activeTab' => 'basic'])

@section('title')
    面板設定
@endsection

@section('content-header')
    <h1>面板設定<small>Configure Pterodactyl to your liking.</small></h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.index') }}">Admin</a></li>
        <li class="active">Settings</li>
    </ol>
@endsection

@section('content')
    @yield('settings::nav')
    <div class="row">
        <div class="col-lg-12">
          <form action="{{ route('admin.settings') }}" method="POST">
            <div class="card shadow">
                <div class="card-header border-transparent">
                   <div class="row align-items-center">
                      <div class="col">
                         <h3 class="mb-0">面板設定</h3>
                      </div>
                   </div>
                </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label class="control-label">公司名稱</label>
                                <div>
                                    <input type="text" class="form-control" name="app:name" value="{{ old('app:name', config('app.name')) }}" />
                                    <p class="text-muted"><small>此公司名稱將會用於顯示在面板和郵件中</small></p>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label class="control-label">兩步驟驗證</label>
                                <div>
                                    @php
                                        $level = old('pterodactyl:auth:2fa_required', config('pterodactyl.auth.2fa_required'));
                                    @endphp
                                    <select name="pterodactyl:auth:2fa_required" class="form-control">
                                            <option value="0"  @if ($level == 0) selected @endif>不要求設定</option>
                                            <option value="1"  @if ($level == 1) selected @endif>僅要求管理員設定</option>
                                            <option value="2"  @if ($level == 2) selected @endif>要求所有使用者設定</option>
                                    </select>
                                    <p class="text-muted"><small>開啟兩步驟驗證要求後，系統將會要求使用者需要先設定完兩步驟驗證後才能繼續使用面板</small></p>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label class="control-label">預設語言</label>
                                <div>
                                    <select name="app:locale" class="form-control">
                                        @foreach($languages as $key => $value)
                                            <option value="{{ $key }}" @if(config('app.locale') === $key) selected @endif>{{ $value }}</option>
                                        @endforeach
                                    </select>
                                    <p class="text-muted"><small>這個預設語言將會改變所有使用者的面板顯示語言</small></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer mt--3">
                        {!! csrf_field() !!}
                        <button type="submit" name="_method" value="PATCH" class="btn btn-sm btn-primary pull-right">儲存設定</button>
                    </div>
            </div>
          </form>
        </div>
    </div>
@endsection
