@extends('layouts.master')

@section('title')
@lang('base.api.new.header')
@endsection

@section('content-header')
<h1>@lang('base.api.new.header')<small>@lang('base.api.new.header_sub')</small></h1>
<ol class="breadcrumb">
    <li><a href="{{ route('index') }}">@lang('strings.home')</a></li>
    <li class="active">@lang('navigation.account.api_access')</li>
    <li class="active">@lang('base.api.new.header')</li>
</ol>
@endsection

@section('content')
    <div class="mt--7">
        <form method="POST" action="{{ route('account.api.new') }}">
          <div class="row">
            <div class="col-lg-6 mb-cs">
                <div class="card shadow">
                  <div class="card-header bg-transparent">
                      <div class="row align-items-center">
                        <div class="col">
                          <h3 class="mb-0">創建API金鑰</h3>
                        </div>
                      </div>
                  </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label class="control-label" for="memoField">說明</label>
                            <input id="memoField" type="text" name="memo" class="form-control" value="{{ old('memo') }}">
                            <p class="text-muted small no-margin">為此API金鑰加上說明，後續處理一目了然!</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 mb-cs">
                <div class="card shadow">
                  <div class="card-header bg-transparent">
                      <div class="row align-items-center">
                        <div class="col">
                          <h3 class="mb-0">進階設定</h3>
                        </div>
                      </div>
                  </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label class="control-label" for="memoField">限制IP存取</label>
                            <textarea id="allowedIps" name="allowed_ips" class="form-control" rows="5">{{ old('allowed_ips') }}</textarea>
                            <p class="text-muted small no-margin">若您在此輸入IP，那此API金鑰只能使用於您輸入之IP地址!</p>
                        </div>
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-primary btn-sm pull-right">創建API金鑰</button>
                    </div>
                </div>
            </div>
            </div>
        </form>
    </div>
@endsection
