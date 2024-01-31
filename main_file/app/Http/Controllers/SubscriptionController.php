<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Models\CouponHistory;
use App\Models\Order;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Stripe;

class SubscriptionController extends Controller
{

    public function index()
    {
        if (\Auth::user()->can('manage pricing packages')) {
            $subscriptions = Subscription::get();

            return view('subscription.index', compact('subscriptions'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }


    public function create()
    {
        $durations = Subscription::$duration;

        return view('subscription.create', compact('durations'));
    }


    public function store(Request $request)
    {
        if (\Auth::user()->can('create pricing packages')) {
            $validator = \Validator::make(
                $request->all(), [
                    'name' => 'required',
                    'price' => 'required',
                    'duration' => 'required',
                    'total_user' => 'required',
                    'total_document' => 'required',
                ]
            );
            if ($validator->fails()) {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }

            $subscription = new Subscription();
            $subscription->name = $request->name;
            $subscription->price = $request->price;
            $subscription->duration = $request->duration;
            $subscription->total_user = $request->total_user;
            $subscription->total_document = $request->total_document;
            $subscription->enabled_document_history = isset($request->enabled_document_history)?1:0;
            $subscription->enabled_logged_history = isset($request->enabled_logged_history) ? 1 : 0;
            $subscription->description = $request->description;
            $subscription->save();

            return redirect()->route('subscriptions.index')->with('success', __('Subscription successfully created.'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }


    public function show($ids)
    {
        if (\Auth::user()->can('buy pricing packages')) {
            $id = Crypt::decrypt($ids);
            $subscription = Subscription::find($id);
            $settings = subscriptionPaymentSettings();

            return view('subscription.show', compact('subscription', 'settings'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }


    public function edit(subscription $subscription)
    {
        $durations = Subscription::$duration;

        return view('subscription.edit', compact('durations', 'subscription'));
    }


    public function update(Request $request, subscription $subscription)
    {

        if (\Auth::user()->can('edit pricing packages')) {
            $validator = \Validator::make(
                $request->all(), [
                    'name' => 'required',
                    'price' => 'required',
                    'duration' => 'required',
                    'total_user' => 'required',
                    'total_document' => 'required',
                ]
            );
            if ($validator->fails()) {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }

            $subscription->name = $request->name;
            $subscription->price = $request->price;
            $subscription->duration = $request->duration;
            $subscription->total_user = $request->total_user;
            $subscription->total_document = $request->total_document;
            $subscription->enabled_document_history = isset($request->enabled_document_history)?1:0;
            $subscription->enabled_logged_history = isset($request->enabled_logged_history) ? 1 : 0;
            $subscription->description = $request->description;
            $subscription->save();

            return redirect()->route('subscriptions.index')->with('success', __('Subscription successfully updated.'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }


    public function destroy(subscription $subscription)
    {
        if (\Auth::user()->can('delete pricing packages')) {
            $subscription->delete();

            return redirect()->route('subscriptions.index')->with('success', __('Subscription successfully deleted.'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function transaction()
    {
        if (\Auth::user()->can('manage pricing transation')) {
            $transactions = Order::orderBy('orders.created_at', 'DESC')->get();
            $settings=settings();
            return view('subscription.transaction', compact('transactions','settings'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function stripePayment(Request $request, $ids)
    {
        if (\Auth::user()->can('buy pricing packages')) {
            $settings = subscriptionPaymentSettings();
            $authUser = \Auth::user();
            $id = \Illuminate\Support\Facades\Crypt::decrypt($ids);
            $subscription = Subscription::find($id);
            if ($subscription) {
                try {
                    $price = Coupon::couponApply($id,$request->coupon);
                    $orderID = uniqid('', true);
                    if ($price > 0.0) {

                        Stripe\Stripe::setApiKey($settings['STRIPE_SECRET']);
                        $data = Stripe\Charge::create(
                            [
                                "amount" => 100 * $price,
                                "currency" => $settings['CURRENCY'],
                                "source" => $request->stripeToken,
                                "description" => " Subscription - " . $subscription->name,
                                "metadata" => ["order_id" => $orderID],
                            ]
                        );
                    } else {
                        $data['amount_refunded'] = 0;
                        $data['failure_code'] = '';
                        $data['paid'] = 1;
                        $data['captured'] = 1;
                        $data['status'] = 'succeeded';
                    }


                    if ($data['amount_refunded'] == 0 && empty($data['failure_code']) && $data['paid'] == 1 && $data['captured'] == 1) {

                        if ($data['status'] == 'succeeded') {

                            $data['order_id'] = $orderID;
                            $data['name'] = $request->name;
                            $data['subscription'] = $subscription->name;
                            $data['subscription_id'] = $subscription->id;
                            $data['price'] = $price;
                            $data['payment_type'] = 'Stripe';
                            Order::orderData($data);

                            if($subscription->couponCheck()>0){
                                $couhis['coupon']=$request->coupon;
                                $couhis['package']=$subscription->id;
                                CouponHistory::couponData($couhis);
                            }

                            $assignPlan = assignSubscription($subscription->id);
                            if ($assignPlan['is_success']) {
                                return redirect()->route('subscriptions.index')->with('success', __('Subscription successfully activated.'));
                            } else {
                                return redirect()->route('subscriptions.index')->with('error', __($assignPlan['error']));
                            }
                        } else {
                            return redirect()->route('subscriptions.index')->with('error', __('Your payment has failed.'));
                        }
                    } else {
                        return redirect()->route('subscriptions.index')->with('error', __('Transaction has been failed.'));
                    }
                } catch (\Exception $e) {
                    return redirect()->route('subscriptions.index')->with('error', __($e->getMessage()));
                }
            } else {
                return redirect()->route('subscriptions.index')->with('error', __('Subscription is deleted.'));
            }
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }

    }


}
