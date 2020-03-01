{{-- Pterodactyl - Panel --}}
{{-- Copyright (c) 2015 - 2017 Dane Everitt <dane@daneeveritt.com> --}}

{{-- This software is licensed under the terms of the MIT license. --}}
{{-- https://opensource.org/licenses/MIT --}}
@extends('layouts.master')

@section('title')
@lang('server.config.name.header')
@endsection

@section('content-header')
<h1>@lang('server.config.name.header')<small>@lang('server.config.name.header_sub')</small></h1>
<ol class="breadcrumb">
   <li><a href="{{ route('index') }}">@lang('strings.home')</a></li>
   <li><a href="{{ route('server.index', $server->uuidShort) }}">{{ $server->name }}</a></li>
   <li>@lang('navigation.server.configuration')</li>
   <li class="active">@lang('navigation.server.server_name')</li>
</ol>
@endsection

@section('content')
<a><td><code>{{ $allocation->ip }}</code></td></a>
@endsection

@section('footer-scripts')
@parent
{!! Theme::js('js/frontend/server.socket.js') !!}
@endsection
