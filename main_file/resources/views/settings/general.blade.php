@extends('layouts.app')
@section('page-title')
    {{__('General Settings')}}
@endsection
@php
    $settings=settings();

@endphp
@section('breadcrumb')
    <ul class="breadcrumb mb-0">
        <li class="breadcrumb-item">
            <a href="{{route('dashboard')}}"><h1>{{__('Dashboard')}}</h1></a>
        </li>
        <li class="breadcrumb-item active">
            <a href="#">{{__('General Settings')}}</a>
        </li>
    </ul>
@endsection
@section('content')
    <div class="row">
        <div class="col-xl-4 col-lg-5">
            <div class="card text-center">
                <div class="card-body">
                    <div class="col-12">
                        <h4 class="mb-0 mt-2">
                            @if(\Auth::user()->type=='super admin')
                                {{env('APP_NAME')}}
                            @else
                                {{!empty($settings['app_name'])?$settings['app_name']:env('APP_NAME')}}
                            @endif
                        </h4>
                        <p class="text-muted font-14">{{__('Application Name')}}</p>
                    </div>
                    <hr>
                    <div class="col-12 mt-20">
                        <img src="{{asset(Storage::url('upload/logo')).'/'.$settings['company_logo']}}"
                             class="setting-logo" alt="">
                        <h4 class="mb-0 mt-2">{{__('Logo')}}</h4>
                    </div>

                    @if(\Auth::user()->type=='super admin')
                        <hr>
                        <div class="col-12 mt-20">
                            <img src="{{asset(Storage::url('upload/logo')).'/'.$settings['landing_logo']}}"
                                 class="setting-logo landing_logo" alt="">
                            <h4 class="mb-0 mt-2">{{__('Landing Page Logo')}}</h4>
                        </div>
                    @endif
                    <hr>
                    <div class="col-12 mt-20">
                        <img src="{{asset(Storage::url('upload/logo')).'/'.$settings['company_favicon']}}" class=""
                             alt="">
                        <h4 class="mb-0 mt-2">{{__('Favicon')}}</h4>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-xl-8 col-lg-7">
            <div class="card">
                <div class="card-body">
                    {{Form::model($settings, array('route' => array('setting.general'), 'method' => 'post', 'enctype' => "multipart/form-data")) }}
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                {{Form::label('application_name',__('Application Name'),array('class'=>'form-label'))}}
                                {{Form::text('application_name',!empty($settings['app_name'])?$settings['app_name']:env('APP_NAME'),array('class'=>'form-control','placeholder'=>__('Enter your application name'),'required'=>'required'))}}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {{Form::label('logo',__('Logo'),array('class'=>'form-label'))}}
                                {{Form::file('logo',array('class'=>'form-control'))}}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {{Form::label('favicon',__('Favicon'),array('class'=>'form-label'))}}
                                {{Form::file('favicon',array('class'=>'form-control'))}}
                            </div>
                        </div>
                        @if(\Auth::user()->type=='super admin')
                            <div class="col-md-6">
                                <div class="form-group">
                                    {{Form::label('landing_logo',__('Landing Page Logo'),array('class'=>'form-label'))}}
                                    {{Form::file('landing_logo',array('class'=>'form-control'))}}
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group col-md-6">
                                    <label for="landing_page" class="form-label">{{__('Landing Page')}}</label>
                                    <div>
                                        <label class="switch with-icon switch-primary">
                                            <input type="checkbox" name="landing_page"
                                                   id="landing_page" {{$settings['landing_page']=='on'?'checked':''}}>
                                            <span class="switch-btn"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group col-md-6">
                                    <label for="register_page" class="form-label">{{__('Register Page')}}</label>
                                    <div>
                                        <label class="switch with-icon switch-primary">
                                            <input type="checkbox" name="register_page"
                                                   id="register_page" {{$settings['register_page']=='on'?'checked':''}}>
                                            <span class="switch-btn"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="text-right">
                        {{Form::submit(__('Save'),array('class'=>'btn btn-primary btn-rounded'))}}
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
@endsection

