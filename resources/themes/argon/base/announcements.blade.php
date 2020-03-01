{{-- Pterodactyl - Panel --}}
{{-- Copyright (c) 2015 - 2017 Dane Everitt <dane@daneeveritt.com> --}}

{{-- This software is licensed under the terms of the MIT license. --}}
{{-- https://opensource.org/licenses/MIT --}}
@extends('layouts.master')

@section('title')
    公告區域
@endsection

@section('content-header')
    <h1>公告區域<small></small></h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('index') }}">@lang('strings.home')</a></li>
        <li class="active">公告</li>
    </ol>
@endsection

@section('content')
     <div class="row mt--7">
        <div class="col-lg-12">
            <div class="card shadow">
                <div class="card-header border-0">
                   <div class="row align-items-center">
                      <div class="col">
                    <h3 class="box-title">公告</h3>
        @if (count($announcements) > 0)
            @foreach($announcements as $announcement)
                <div class="col-xs-12">
                <ol class="breadcrumb">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">{{$announcement->title}}</h3>
                            <div class="box-tools">
                                <p class="text-muted">{{$announcement->updated_at}}</p>
                            </div>
                        </div>
                        <div class="box-body">
                            {!! $announcement->body !!}
                        </div>
                    </div>
                </div>
            @endforeach

            <div class="col-xs-12">
                <div class="text-center">
                    {{ $announcements->links() }}
                </div>
            </div>
        @else
            <div class="col-xs-12">
                <div class="alert alert-info alert-dismissable" role="alert">
                    目前沒有公告！
                </div>
            </div>
        @endif
    </div>
@endsection

@section('footer-scripts')
    @parent
@endsection

<!-- Load Facebook SDK for JavaScript -->
<div id="fb-root"></div>
      <script>
        window.fbAsyncInit = function() {
          FB.init({
            xfbml            : true,
            version          : 'v5.0'
          });
        };

        (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = 'https://connect.facebook.net/zh_TW/sdk/xfbml.customerchat.js';
        fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));</script>

      <!-- Your customer chat code -->
      <div class="fb-customerchat"
        attribution=setup_tool
        page_id="106025764198380"
  theme_color="#44bec7"
  logged_in_greeting="您好！請問需要什麼服務呢？"
  logged_out_greeting="您好！請登入 Facebook 來取用支援服務喔">
      </div>