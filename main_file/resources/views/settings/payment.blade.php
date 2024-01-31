@extends('layouts.app')
@section('page-title')
    {{__('Payment Settings')}}
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
            <a href="#">{{__('Payment Settings')}}</a>
        </li>
    </ul>
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    {{Form::model($settings, array('route' => array('setting.payment'), 'method' => 'post')) }}
                    <div class="row">
                        <div class="form-group col-md-6">
                            {{Form::label('currency',__('Currency'),array('class'=>'form-label')) }}
                            {{Form::text('currency',$settings['CURRENCY'],array('class'=>'form-control font-style','placeholder'=>__('Enter currency'),'required'))}}
                        </div>
                        <div class="form-group col-md-6">
                            {{Form::label('currency_symbol',__('Currency Symbol'),array('class'=>'form-label')) }}
                            {{Form::text('currency_symbol',$settings['CURRENCY_SYMBOL'],array('class'=>'form-control','placeholder'=>__('Enter currency symbol'),'required'))}}
                        </div>

                    </div>
                    <hr>
                    {{--------------------------Bank Transfer settings---------------------------------}}
                    <div class="row mt-2">
                        <div class="col-auto">
                            {{Form::label('bank_transfer_payment',__('Bank Transfer Payment'),array('class'=>'form-label')) }}
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="form-check custom-chek">
                                    <input class="form-check-input" type="checkbox" name="bank_transfer_payment" id="bank_transfer_payment" {{ $settings['bank_transfer_payment'] == 'on' ? 'checked' : '' }}>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            {{Form::label('bank_details',__('Bank Details'),array('class'=>'form-label')) }}
                            {{Form::textarea('bank_details',$settings['bank_details'],['class'=>'form-control','rows'=>3,'placeholder'=>__('Enter bank details')])}}
                        </div>
                    </div>
                    <hr>
                    {{--------------------------Stripe Payment settings---------------------------------}}
                    <div class="row mt-2">
                        <div class="col-auto">
                            {{Form::label('stripe_payment',__('Stripe Payment'),array('class'=>'form-label')) }}
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="form-check custom-chek">
                                    <input class="form-check-input" type="checkbox" name="stripe_payment" id="stripe_payment" {{ $settings['STRIPE_PAYMENT'] == 'on' ? 'checked' : '' }}>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            {{Form::label('stripe_key',__('Stripe Key'),array('class'=>'form-label')) }}
                            {{Form::text('stripe_key',$settings['STRIPE_KEY'],['class'=>'form-control','placeholder'=>__('Enter stripe key')])}}
                        </div>
                        <div class="form-group col-md-6">
                            {{Form::label('stripe_secret',__('Stripe Secret'),array('class'=>'form-label')) }}
                            {{Form::text('stripe_secret',$settings['STRIPE_SECRET'],['class'=>'form-control ','placeholder'=>__('Enter stripe secret')])}}
                        </div>
                    </div>
                    <hr>
                    {{--------------------------Paypal Payment settings---------------------------------}}
                    <div class="row mt-2">
                        <div class="col-auto">
                            {{Form::label('paypal_payment',__('Paypal Payment'),array('class'=>'form-label')) }}
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="form-check custom-chek">
                                    <input class="form-check-input" type="checkbox" name="paypal_payment"
                                           id="paypal_payment" {{ $settings['paypal_payment'] == 'on' ? 'checked' : '' }}>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            {{Form::label('paypal_mode',__('Mode'),array('class'=>'form-label me-2')) }}
                            <div class="form-check custom-chek form-check-inline">
                                <input class="form-check-input" type="radio" value="sandbox" id="sandbox" name="paypal_mode" {{ $settings['paypal_mode'] == 'sandbox' ? 'checked' : '' }}>
                                <label class="form-check-label" for="sandbox">{{__('Sandbox')}} </label>
                            </div>
                            <div class="form-check custom-chek form-check-inline">
                                <input class="form-check-input" type="radio" value="live" id="live"
                                       name="paypal_mode" {{ $settings['paypal_mode'] == 'live' ? 'checked' : '' }}>
                                <label class="form-check-label" for="live">{{__('Live')}} </label>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            {{Form::label('paypal_client_id',__('Client ID'),array('class'=>'form-label')) }}
                            {{Form::text('paypal_client_id',$settings['paypal_client_id'],['class'=>'form-control','placeholder'=>__('Enter client id')])}}
                        </div>
                        <div class="form-group col-md-6">
                            {{Form::label('paypal_secret_key',__('Secret Key'),array('class'=>'form-label')) }}
                            {{Form::text('paypal_secret_key',$settings['paypal_secret_key'],['class'=>'form-control ','placeholder'=>__('Enter secret key')])}}
                        </div>
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

