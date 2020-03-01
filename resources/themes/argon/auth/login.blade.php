{{-- Pterodactyl - Panel --}}
{{-- Copyright (c) 2015 - 2017 Dane Everitt <dane@daneeveritt.com> --}}

{{-- This software is licensed under the terms of the MIT license. --}}
{{-- https://opensource.org/licenses/MIT --}}
@extends('layouts.auth')

@section('title')
登入
@endsection

@section('content')
<div class="header bg-gradient-primary py-7 py-lg-8">
  <div class="container">
    <div class="header-body text-center mb-7">
      <div class="row justify-content-center">
        <div class="col-lg-5 col-md-6">
          <h1 class="text-white">歡迎使用 Amtz Hosting!</h1>
          <p class="text-lead text-white">請輸入帳號密碼來使用此面板之功能</p>
        </div>
      </div>
    </div>
  </div>
  <div class="separator separator-bottom separator-skew zindex-100">
    <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
      <polygon class="fill-default" points="2560 0 2560 100 0 100"></polygon>
    </svg>
  </div>
</div>
<div class="container mt--8 pb-5">
  <div class="row justify-content-center">
    <div class="col-lg-5 col-md-7">
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-label="關閉"><span aria-hidden="true">&times;</span></button>
            @lang('auth.auth_error')<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @foreach (Alert::getMessages() as $type => $messages)
        @foreach ($messages as $message)
            <div class="alert alert-{{ $type }} alert-dismissable" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="關閉"><span aria-hidden="true">&times;</span></button>
                {!! $message !!}
            </div>
        @endforeach
    @endforeach
  </div>
  </div>
  <div class="row justify-content-center">
    <div class="col-lg-5 col-md-7">
      <div class="card bg-secondary shadow border-0">
        <div class="card-body px-lg-5 py-lg-5">
          <div class="text-center text-muted mb-4 mt--3">
            <small>需要帳號驗證才能使用面板</small>
          </div>
          <form role="form" id="loginForm" action="{{ route('auth.login') }}" method="POST">
            <div class="form-group mb-3">
              <div class="input-group input-group-alternative">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                </div>
                <input type="text" name="user" class="form-control" value="{{ old('user') }}" required placeholder="@lang('strings.user_identifier')" autofocus>
              </div>
            </div>
            <div class="form-group">
              <div class="input-group input-group-alternative">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-lock"></i></span>
                </div>
                <input type="password" name="password" class="form-control" required placeholder="@lang('strings.password')">
              </div>
            </div>
            <div class="text-center">
              {!! csrf_field() !!}
              <button type="submit" class="btn btn-primary btn-block g-recaptcha mb-0" @if(config('recaptcha.enabled')) data-sitekey="{{ config('recaptcha.website_key') }}" data-callback='onSubmit' @endif>@lang('auth.sign_in')</button>
            </div>
          </form>
        </div>
      </div>
      <div class="row mt-3">
        <div class="col-6">
          <a href="{{ route('auth.password') }}" class="text-light"><small>忘記密碼了嗎？</small></a>
        </div>
        </div>
      </div>
    </div>
  </div>
</div>
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

@section('scripts')
    @parent
    @if(config('recaptcha.enabled'))
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script>
    function onSubmit(token) {
      document.getElementById("loginForm").submit();
    }
    </script>
    @endif
@endsection
