{{-- Pterodactyl - Panel --}}
{{-- Copyright (c) 2015 - 2017 Dane Everitt <dane@daneeveritt.com> --}}

{{-- This software is licensed under the terms of the MIT license. --}}
{{-- https://opensource.org/licenses/MIT --}}
@extends('layouts.auth')

@section('title')
忘記密碼
@endsection

@section('content')
<div class="header bg-gradient-primary py-7 py-lg-8">
   <div class="container">
      <div class="header-body text-center mb-7">
         <div class="row justify-content-center">
            <div class="col-lg-5 col-md-6">
               <h1 class="text-white">歡迎使用 Amtz Hosting!</h1>
               <p class="text-lead text-white">忘記密碼了嗎？在此救援您的帳號吧！</p>
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
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            @lang('auth.auth_error')<br><br>
            <ul>
               @foreach ($errors->all() as $error)
               <li>{{ $error }}</li>
               @endforeach
            </ul>
         </div>
         @endif
         @if (session('status'))
         <div class="alert alert-success">
            @lang('auth.email_sent')
         </div>
         @endif
      </div>
   </div>
   <div class="row justify-content-center">
      <div class="col-lg-5 col-md-7">
         <div class="card bg-secondary shadow border-0">
            <div class="card-body px-lg-5 py-lg-5">
               <div class="text-center text-muted mb-4 mt--3">
                  <small>需要您的電子郵件才能繼續救援您的帳號</small>
               </div>
               <form role="form" id="resetForm" action="{{ route('auth.password') }}" method="POST">
                  <div class="form-group mb-3">
                     <div class="input-group input-group-alternative">
                        <div class="input-group-prepend">
                           <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                        </div>
                        <input type="email" name="email" class="form-control" value="{{ old('email') }}" required placeholder="@lang('strings.email')" autofocus>
                     </div>
                  </div>
                  <div class="text-center">
                     {!! csrf_field() !!}
                     <button type="submit" class="btn btn-primary btn-block g-recaptcha mb-0" @if(config('recaptcha.enabled')) data-sitekey="{{ config('recaptcha.website_key') }}" data-callback='onSubmit' @endif>@lang('auth.request_reset')</button>
                  </div>
               </form>
            </div>
         </div>
         <div class="row mt-3">
            <div class="col-6">
               <a href="{{ route('index') }}" class="text-light"><small>我記得帳號，我要登入</small></a>
            </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection

@section('scripts')
    @parent
    @if(config('recaptcha.enabled'))
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script>
       function onSubmit(token) {
           document.getElementById("resetForm").submit();
       }
    </script>
    @endif
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