@extends('layouts.app')
@section('page-title')
    {{__('Subscription')}}
@endsection

@push('script-page')
    <script src="https://js.stripe.com/v3/"></script>

    <script type="text/javascript">
        @if($subscription->price > 0.0 &&  $settings['STRIPE_PAYMENT'] == 'on' && !empty($settings['STRIPE_KEY']) && !empty($settings['STRIPE_SECRET']))
        var stripe = Stripe('{{ $settings['STRIPE_KEY'] }}');
        var elements = stripe.elements();
        var style = {
            base: {
                fontSize: '14px',
                color: '#32325d',
            },
        };

        var card = elements.create('card', {style: style});
        card.mount('#card-element');

        var form = document.getElementById('stripe-payment');
        form.addEventListener('submit', function (event) {
            event.preventDefault();

            stripe.createToken(card).then(function (result) {
                if (result.error) {
                    $("#card-errors").html(result.error.message);
                    $.NotificationApp.send("Error", result.error.message, "top-right", "rgba(0,0,0,0.2)", "error");
                } else {
                    stripeTokenHandler(result.token);
                }
            });
        });

        function stripeTokenHandler(token) {
            var form = document.getElementById('stripe-payment');
            var hiddenInput = document.createElement('input');
            hiddenInput.setAttribute('type', 'hidden');
            hiddenInput.setAttribute('name', 'stripeToken');
            hiddenInput.setAttribute('value', token.id);
            form.appendChild(hiddenInput);
            form.submit();
        }

        @endif

        $(document).ready(function () {
            $(document).on('click', '.coupon_apply', function () {
                var ele = $(this);
                var coupon = ele.closest('.row').find('.coupon_code').val();
                $.ajax({
                    url: '{{route('coupons.apply')}}',
                    datType: 'json',
                    data: {
                        package: '{{\Illuminate\Support\Facades\Crypt::encrypt($subscription->id)}}',
                        coupon: coupon
                    },
                    success: function (data) {
                        console.log(data)
                        $('.discoutedPrice').text(data.discoutedPrice);
                        // $('#stripe_coupon, #paypal_coupon').val(coupon);
                        if (data != '') {
                            if (data.is_success == true) {
                                toastrs('success', data.message, 'success');
                            } else {
                                toastrs('Error', data.message, 'error');
                            }

                        } else {
                            toastrs('Error', "{{__('Coupon code required.')}}", 'error');
                        }
                    }
                })
            });
        });
    </script>
@endpush
@section('breadcrumb')
    <ul class="breadcrumb mb-0">
        <li class="breadcrumb-item">
            <a href="{{route('dashboard')}}"><h1>{{__('Dashboard')}}</h1></a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{route('subscriptions.index')}}">{{__('Subscription')}}</a>
        </li>
        <li class="breadcrumb-item active">
            <a href="#">{{__('Details')}}</a>
        </li>
    </ul>
@endsection
@section('content')
    <div class="row pricing-grid">
        <div class="col-xxl-3 cdx-xl-50 col-sm-6">
            <div class="codex-pricingtbl">
                <div class="price-header">
                    <h2>{{$subscription->name}}</h2>
                    <div class="price-value">
                        <span class="discoutedPrice">{{$settings['CURRENCY_SYMBOL'].$subscription->price}}</span>
                        <span>/ {{$subscription->duration}}</span>
                    </div>
                </div>
                <ul class="cdxprice-list">
                    <li><span>{{$subscription->total_user}}</span>{{__('Users Limit')}}</li>
                    <li><span>{{$subscription->total_property}}</span>{{__('Property Limit')}}</li>
                    <li><span>{{$subscription->total_tenant}}</span>{{__('Tenant Limit')}}</li>
                    <li>
                        <div class="delet-mail">
                            @if($subscription->couponCheck()>0)
                                <i class="text-success mr-4" data-feather="check-circle"></i>
                            @else
                                <i class="text-danger mr-4" data-feather="x-circle"></i>
                            @endif
                            {{__('Coupon Applicable')}}
                        </div>
                    </li>
                    <li>
                        <div class="delet-mail">
                            @if($subscription->enabled_logged_history==1)
                                <i class="text-success mr-4" data-feather="check-circle"></i>
                            @else
                                <i class="text-danger mr-4" data-feather="x-circle"></i>
                            @endif
                            {{__('User Logged History')}}
                        </div>
                    </li>
                </ul>
            </div>
        </div>

        <div class="col-lg-9">
            @if($settings['STRIPE_PAYMENT'] == 'on' && !empty($settings['STRIPE_KEY']) && !empty($settings['STRIPE_SECRET']))
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-header">
                                <h5>{{__('Stripe Payment')}}</h5>
                            </div>
                            <div class="card-body profile-user-box">
                                <form
                                    action="{{ route('subscription.stripe.payment',\Illuminate\Support\Facades\Crypt::encrypt($subscription->id)) }}"
                                    method="post" class="require-validation" id="stripe-payment">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="card-name-on"
                                                       class="form-label text-dark">{{__('Card Name')}}</label>
                                                <input type="text" name="name" id="card-name-on"
                                                       class="form-control required"
                                                       placeholder="{{__('Card Holder Name')}}">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="card-name-on"
                                                   class="form-label text-dark">{{__('Card Details')}}</label>
                                            <div id="card-element">
                                            </div>
                                            <div id="card-errors" role="alert"></div>
                                        </div>

                                        @if($subscription->couponCheck()>0)
                                            <div class="col-md-12 mt-15">
                                                <div class="form-group">
                                                    <label for="card-name-on"
                                                           class="form-label text-dark">{{__('Coupon Code')}}</label>
                                                    <input type="text" name="coupon"
                                                           class="form-control required coupon_code"
                                                           placeholder="{{__('Coupon Code')}}">
                                                </div>
                                            </div>
                                        @endif
                                        <div class="col-sm-12 mt-15">
                                            <input type="button" value="{{__('Coupon Apply')}}" class="btn btn-warning coupon_apply">
                                            <input type="submit" value="{{__('Pay')}}" class="btn btn-primary">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection

