{{-- Pterodactyl - Panel --}}
{{-- Copyright (c) 2015 - 2017 Dane Everitt <dane@daneeveritt.com> --}}

{{-- This software is licensed under the terms of the MIT license. --}}
{{-- https://opensource.org/licenses/MIT --}}
@extends('layouts.master')

@section('title')
    伺服器核心更換
@endsection

@section('content-header')
    <h1>Minecraft Server Version<small>Switch your server version with one click</small></h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('index') }}">@lang('strings.home')</a></li>
        <li><a href="{{ route('server.index', $server->uuidShort) }}">{{ $server->name }}</a></li>
        <li>@lang('navigation.server.configuration')</li>
        <li class="active">伺服器核心更換</li>
    </ol>
@endsection

@section('content')
<div class="mt--7">
   <div class="row">
      <div class="col-lg-12 mb-cs">
         <div class="card shadow">
            <div class="card-header border-transparent">
               <div class="row align-items-center">
                  <div class="col">
                     <h3 class="mb-0">伺服器核心管理</h3>
               <div>
                                <select id="version" name="version" class="form-control">
                                    @foreach($versions as $version)
                                        @if (str_replace('.jar', '', $version) == $nowVersion)
                                            <option selected value="{{str_replace('.jar', '', $version)}}">{{str_replace('.jar', '', $version)}}</option>
                                        @else
                                            <option value="{{str_replace('.jar', '', $version)}}">{{str_replace('.jar', '', $version)}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="col-lg-12 mb-cs">
            <div class="card shadow">
               <div class="card-footer">
                        {{ csrf_field() }}
                        <input type="submit" class="btn btn-sm btn-primary pull-right" value="@lang('strings.submit')" />
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('footer-scripts')
    @parent
    {!! Theme::js('js/frontend/server.socket.js') !!}
@endsection
