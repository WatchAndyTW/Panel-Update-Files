{{-- Pterodactyl - Panel --}}
{{-- Copyright (c) 2015 - 2017 Dane Everitt <dane@daneeveritt.com> --}}

{{-- This software is licensed under the terms of the MIT license. --}}
{{-- https://opensource.org/licenses/MIT --}}
@extends('layouts.master')

@section('title')
@lang('base.api.index.header')
@endsection

@section('content-header')
<h1>@lang('base.api.index.header')<small>@lang('base.api.index.header_sub')</small></h1>
<ol class="breadcrumb">
    <li><a href="{{ route('index') }}">@lang('strings.home')</a></li>
    <li class="active">@lang('navigation.account.api_access')</li>
</ol>
@endsection

@section('content')
<div class="row mt--7">
    <div class="col-lg-12">
        <div class="card shadow">
            <div class="card-header border-0">
               <div class="row align-items-center">
                  <div class="col">
                     <h3 class="mb-0">API金鑰列表</h3>
                  </div>
                  <div class="col text-right">
                     <a href="{{ route('account.api.new') }}" class="btn btn-sm btn-primary">創建新的API金鑰</a>
                  </div>
               </div>
            </div>
            <div class="table-responsive">
                <table class="table align-items-center table-flush">
                  <thead class="thead-light">
                    <tr>
                        <th>金鑰</th>
                        <th>說明</th>
                        <th>最後使用</th>
                        <th>創建時間</th>
                        <th></th>
                    </tr>
                  </thead>
                    @foreach($keys as $key)
                        <tr>
                            <td>
                                <code class="toggle-display" style="cursor:pointer" data-toggle="tooltip" data-placement="right" title="Click to Reveal">
                                    <i class="fas fa-key"></i> &bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;
                                </code>
                                <code class="d-none" data-attr="api-key">
                                    {{ $key->identifier }}{{ decrypt($key->token) }}
                                </code>
                            </td>
                            <td>{{ $key->memo }}</td>
                            <td>
                                @if(!is_null($key->last_used_at))
                                    @datetimeHuman($key->last_used_at)
                                    @else
                                    &mdash;
                                @endif
                            </td>
                            <td>@datetimeHuman($key->created_at)</td>
                            <td>
                                <a href="#" data-action="revoke-key" data-attr="{{ $key->identifier }}">
                                    <i class="fas fa-trash text-danger"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('footer-scripts')
    @parent
    <script>
    $(document).ready(function() {
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        });
        $('.toggle-display').on('click', function () {
            $(this).parent().find('code[data-attr="api-key"]').removeClass('d-none');
            $(this).hide();
        });

        $('[data-action="revoke-key"]').click(function (event) {
            var self = $(this);
            event.preventDefault();
            swal({
                type: 'error',
                title: '移除您的API金鑰',
                text: '當您移除了此API金鑰後，使用此金鑰的所有應用都將立即失效',
                showCancelButton: true,
                allowOutsideClick: true,
                closeOnConfirm: false,
                confirmButtonText: 'Revoke',
                confirmButtonColor: '#d9534f',
                showLoaderOnConfirm: true
            }, function () {
                $.ajax({
                    method: 'DELETE',
                    url: Router.route('account.api.revoke', { identifier: self.data('attr') }),
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                }).done(function (data) {
                    swal({
                        type: 'success',
                        title: '',
                        text: 'API金鑰移除成功!'
                    });
                    self.parent().parent().slideUp();
                }).fail(function (jqXHR) {
                    console.error(jqXHR);
                    swal({
                        type: 'error',
                        title: '可....可惡',
                        text: '移除API金鑰時發生了未知的錯誤!'
                    });
                });
            });
        });
    });
    </script>
@endsection
