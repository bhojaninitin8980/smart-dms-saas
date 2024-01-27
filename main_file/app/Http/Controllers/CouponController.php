<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Models\CouponHistory;
use App\Models\Subscription;
use Illuminate\Http\Request;

class CouponController extends Controller
{

    public function index()
    {
        if (\Auth::user()->can('manage coupon')) {
            $coupons = Coupon::get();
            return view('coupon.index', compact('coupons'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }


    public function create()
    {
        $packages = Subscription::get()->pluck('name', 'id');
        $status = Coupon::$status;
        $type = Coupon::$type;
        return view('coupon.create', compact('packages', 'status', 'type'));
    }


    public function store(Request $request)
    {
        if (\Auth::user()->can('create coupon')) {
            $validator = \Validator::make(
                $request->all(), [
                    'name' => 'required',
                    'type' => 'required',
                    'rate' => 'required',
                    'applicable_packages' => 'required',
                    'code' => 'required',
                    'valid_for' => 'required',
                    'use_limit' => 'required',
                ]
            );
            if ($validator->fails()) {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }

            $coupon = new Coupon();
            $coupon->name = $request->name;
            $coupon->type = $request->type;
            $coupon->rate = $request->rate;
            $coupon->applicable_packages = !empty($request->applicable_packages) ? implode(',', $request->applicable_packages) : '';
            $coupon->code = $request->code;
            $coupon->valid_for = $request->valid_for;
            $coupon->use_limit = $request->use_limit;
            $coupon->status = $request->status;
            $coupon->save();

            return redirect()->back()->with('success', __('Coupon successfully created.'));
        } else {
            return redirect()->back()->with('error', __('Permission Denied.'));
        }
    }


    public function show(Coupon $coupon)
    {
        //
    }


    public function edit(Coupon $coupon)
    {
        $packages = Subscription::get()->pluck('name', 'id');
        $status = Coupon::$status;
        $type = Coupon::$type;
        return view('coupon.edit', compact('coupon', 'packages', 'status', 'type'));
    }


    public function update(Request $request, Coupon $coupon)
    {
        if (\Auth::user()->can('edit coupon')) {
            $validator = \Validator::make(
                $request->all(), [
                    'name' => 'required',
                    'type' => 'required',
                    'rate' => 'required',
                    'applicable_packages' => 'required',
                    'code' => 'required',
                    'valid_for' => 'required',
                    'use_limit' => 'required',
                ]
            );
            if ($validator->fails()) {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }

            $coupon->name = $request->name;
            $coupon->type = $request->type;
            $coupon->rate = $request->rate;
            $coupon->applicable_packages = !empty($request->applicable_packages) ? implode(',', $request->applicable_packages) : '';
            $coupon->code = $request->code;
            $coupon->valid_for = $request->valid_for;
            $coupon->use_limit = $request->use_limit;
            $coupon->status = $request->status;
            $coupon->save();

            return redirect()->back()->with('success', __('Coupon successfully updated.'));
        } else {
            return redirect()->back()->with('error', __('Permission Denied.'));
        }
    }


    public function destroy(Coupon $coupon)
    {
        if (\Auth::user()->can('delete coupon')) {
            $coupon->delete();
            return redirect()->back()->with('success', 'Coupon successfully deleted.');
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function history()
    {
        if (\Auth::user()->can('manage coupon history')) {
            $couponhistory = CouponHistory::get();
            return view('coupon.history', compact('couponhistory'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function historyDestroy($id)
    {
        if (\Auth::user()->can('manage coupon history')) {
            $coupon = CouponHistory::find($id);
            $coupon->delete();
            return redirect()->back()->with('success', 'Coupon history successfully deleted.');
        } else {
            return redirect()->back()->with('error', __('Permission Denied.'));
        }
    }

    public function apply(Request $request)
    {
        $settings=subscriptionPaymentSettings();

        $package = Subscription::find(\Illuminate\Support\Facades\Crypt::decrypt($request->package));

        if ($package && $request->coupon != '') {
            $currency = isset($settings['CURRENCY_SYMBOL'])?$settings['CURRENCY_SYMBOL']:'$';
            $originalPrice=$currency.$package->price;
            $coupons = Coupon::where('code', $request->coupon)->where('status', '1')->first();
            if (!empty($coupons)) {
                $applicable_packages = Coupon::whereRaw("find_in_set($package->id,applicable_packages)")->first();

                if (empty($applicable_packages)) {
                    return response()->json(
                        [
                            'is_success' => false,
                            'final_price' => $originalPrice,
                            'price' => $package->price,
                            'message' => __('This coupon code do not applicable packages for this package.'),
                        ]
                    );
                }
                $usedCoupun = $coupons->usedCoupon();

                if (($coupons->use_limit == $usedCoupun) || $coupons->valid_for<date('Y-m-d')) {
                    return response()->json(
                        [
                            'is_success' => false,
                            'discoutedPrice' => $originalPrice,
                            'message' => __('This coupon code has expired.'),
                        ]
                    );
                } else {

                    if($coupons->type=='fixed'){
                        $discoutedPrice = $currency.($package->price - $coupons->rate);
                    }else{
                        $discount_value = ($package->price / 100) * $coupons->rate;
                        $discoutedPrice = $currency.($package->price - $discount_value);
                    }

                    return response()->json(
                        [
                            'is_success' => true,
                            'discoutedPrice' => $discoutedPrice,
                            'message' => __('Coupon code has applied successfully.'),
                        ]
                    );
                }
            } else {
                return response()->json(
                    [
                        'is_success' => false,
                        'discoutedPrice' => $originalPrice,
                        'message' => __('This coupon code is invalid or has expired.'),
                    ]
                );
            }
        }

    }
}
