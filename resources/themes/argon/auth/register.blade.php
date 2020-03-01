{{-- Pterodactyl - Panel --}}
{{-- Copyright (c) 2015 - 2017 Dane Everitt <dane@daneeveritt.com> --}}

{{-- This software is licensed under the terms of the MIT license. --}}
{{-- https://opensource.org/licenses/MIT --}}
@extends('layouts.auth')

@section('title')
    Register
@endsection

@section('content')
<div class="row">
    <div class="col-sm-offset-3 col-xs-offset-1 col-sm-6 col-xs-10">
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
        @php
        if (isset($_GET['password'])) {
        @endphp
            <div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                There was an error while attempting to register.<br><br>
                <ul>
                        <li>The passwords you entered don't match.</li>
                </ul>
            </div>
        @php
        }
        @endphp
        @php
        if (isset($_GET['unknown'])) {
        @endphp
            <div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                There was an error while attempting to register.<br><br>
                <ul>
                        <li>This is a unknown error, contact one of our employees.</li>
                </ul>
            </div>
        @php
        }
        @endphp
        @php
        if (isset($_GET['exists'])) {
        @endphp
            <div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                There was an error while attempting to register.<br><br>
                <ul>
                        <li>This account already exists.</li>
                </ul>
            </div>
        @php
        }
        @endphp
        @php
        if (isset($_GET['success'])) {
        @endphp
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                Succesfully created a account.<br><br>
                <ul>
                        <li>Your account has succesfully been created.</li>
                </ul>
            </div>
        @php
        }
        @endphp
        @foreach (Alert::getMessages() as $type => $messages)
            @foreach ($messages as $message)
                <div class="callout callout-{{ $type }} alert-dismissable" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    {!! $message !!}
                </div>
            @endforeach
        @endforeach
    </div>
</div>
<div class="row">
    <div class="col-sm-offset-3 col-xs-offset-1 col-sm-6 col-xs-10 pterodactyl-login-box">
        <form action="/auth/register/account" method="POST">
            <div class="form-group has-feedback">
                <div class="pterodactyl-login-input">
                    <input type="text" name="fname" class="form-control input-lg" required placeholder="First Name" autofocus>
                    <span class="fa fa-user form-control-feedback fa-lg"></span>
                </div>
            </div>
            <div class="form-group has-feedback">
                <div class="pterodactyl-login-input">
                    <input type="text" name="lname" class="form-control input-lg" required placeholder="Last Name" autofocus>
                    <span class="fa fa-user form-control-feedback fa-lg"></span>
                </div>
            </div>
            <div class="form-group has-feedback">
                <div class="pterodactyl-login-input">
                    <input type="text" name="user" class="form-control input-lg" required placeholder="Username" autofocus>
                    <span class="fa fa-user form-control-feedback fa-lg"></span>
                </div>
            </div>
            <div class="form-group has-feedback">
                <div class="pterodactyl-login-input">
                    <input type="text" name="email" class="form-control input-lg" required placeholder="Email">
                    <span class="fa fa-envelope form-control-feedback fa-lg"></span>
                </div>
            </div>
            <div class="form-group has-feedback">
                <div class="pterodactyl-login-input">
                    <input type="password" name="password" class="form-control input-lg" required placeholder="@lang('strings.password')">
                    <span class="fa fa-lock form-control-feedback fa-lg"></span>
                </div>
            </div>
            <div class="form-group has-feedback">
                <div class="pterodactyl-login-input">
                    <input type="password" name="passwordrepeat" class="form-control input-lg" required placeholder="Repeat Password">
                    <span class="fa fa-lock form-control-feedback fa-lg"></span>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-4">
    				<a style="color: #ddd;" href="{{ route('auth.login') }}">Or sign in</a>
                </div>
                <div class="col-xs-offset-4 col-xs-4">
                    {!! csrf_field() !!}
                    <button type="submit" class="btn btn-block g-recaptcha pterodactyl-login-button--main">Sign up</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

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
