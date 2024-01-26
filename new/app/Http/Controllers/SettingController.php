<?php

namespace App\Http\Controllers;

use App\Models\Custom;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SettingController extends Controller
{

    //    ---------------------- Account --------------------------------------------------------
    public function account()
    {
        $loginUser = \Auth::user();

        return view('settings.account', compact('loginUser'));
    }

    public function accountData(Request $request)
    {
        $loginUser = \Auth::user();
        $user = User::find($loginUser->id);
        $validator = \Validator::make(
            $request->all(), [
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => 'required|email|unique:users,email,' . $user->id,
            ]
        );
        if ($validator->fails()) {
            $messages = $validator->getMessageBag();

            return redirect()->back()->with('error', $messages->first());
        }


        if ($request->hasFile('profile')) {
            $filenameWithExt = $request->file('profile')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('profile')->getClientOriginalExtension();
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;

            $dir = storage_path('uploads/profile/');
            $image_path = $dir . $loginUser->avatar;

            if (\File::exists($image_path)) {
                \File::delete($image_path);
            }

            if (!file_exists($dir)) {
                mkdir($dir, 0777, true);
            }

            $path = $request->file('profile')->storeAs('upload/profile/', $fileNameToStore);

        }

        if (!empty($request->profile)) {
            $user->profile = $fileNameToStore;
        }
        $user->first_name  = $request->first_name;
        $user->last_name  = $request->last_name;
        $user->email = $request->email;
        $user->save();


        return redirect()->back()->with('success', 'Account settings successfully updated.');
    }

    public function accountDelete(Request $request)
    {
        $loginUser = \Auth::user();
        $loginUser->delete();

        return redirect()->back()->with('success', 'Your account successfully deleted.');
    }

    //    ---------------------- Password --------------------------------------------------------

    public function password()
    {
        $loginUser = \Auth::user();

        return view('settings.password', compact('loginUser'));
    }

    public function passwordData(Request $request)
    {
        if (\Auth::Check()) {
            $validator = \Validator::make(
                $request->all(), [
                    'current_password' => 'required',
                    'new_password' => 'required|min:6',
                    'confirm_password' => 'required|same:new_password',
                ]
            );
            if ($validator->fails()) {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }
            $loginUser = \Auth::user();
            $data = $request->All();

            $current_password = $loginUser->password;
            if (Hash::check($data['current_password'], $current_password)) {
                $user_id = $loginUser->id;
                $user = User::find($user_id);
                $user->password = Hash::make($data['new_password']);;
                $user->save();

                return redirect()->back()->with('success', __('Password successfully updated.'));
            } else {
                return redirect()->back()->with('error', __('Please enter valid current password.'));
            }
        } else {
            return redirect()->back()->with('error', __('Invalid user.'));
        }
    }

    //    ---------------------- General --------------------------------------------------------

    public function general()
    {
        $loginUser = \Auth::user();

        return view('settings.general', compact('loginUser'));
    }

    public function generalData(Request $request)
    {

        if (\Auth::user()->type == 'super admin') {

            $validator = \Validator::make(
                $request->all(), [
                    'application_name' => 'required',
                ]
            );

            if ($request->logo) {
                $validator = \Validator::make(
                    $request->all(), [
                        'logo' => 'required|mimes:png',
                    ]
                );
            }

            if ($request->landing_logo) {
                $validator = \Validator::make(
                    $request->all(), [
                        'landing_logo' => 'required|mimes:png',
                    ]
                );
            }

            if ($request->favicon) {
                $validator = \Validator::make(
                    $request->all(), [
                        'favicon' => 'required|mimes:png',
                    ]
                );
            }


            if ($validator->fails()) {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }

            if (!empty($request->application_name)) {
                $array = [
                    'APP_NAME' => $request->application_name,
                ];
                Custom::setCommon($array);
            }


            if ($request->logo) {
                $logoName = 'logo.png';
                $path = $request->file('logo')->storeAs('upload/logo/', $logoName);

            }

            if ($request->landing_logo) {
                $logoName = 'landing_logo.png';
                $path = $request->file('landing_logo')->storeAs('upload/logo/', $logoName);

            }

            if ($request->favicon) {
                $favicon = 'favicon.png';
                $path = $request->file('favicon')->storeAs('upload/logo/', $favicon);

            }

            $datas = [];
            if (isset($request->landing_page)) {
                $datas['landing_page'] = $request->landing_page;
            } else {
                $datas['landing_page'] = 'off';
            }

            if (isset($request->register_page)) {
                $datas['register_page'] = $request->register_page;
            } else {
                $datas['register_page'] = 'off';
            }

            if (!empty($datas['register_page']) || !empty($datas['landing_page'])) {
                foreach ($datas as $key => $data) {

                    \DB::insert(
                        'insert into settings (`value`, `name`,`type`,`parent_id`) values (?, ?, ?,?) ON DUPLICATE KEY UPDATE `value` = VALUES(`value`) ', [
                            $data,
                            $key,
                            'common',
                            parentId(),
                        ]
                    );
                }

            }
        } elseif (\Auth::user()->type == 'owner') {
            $validator = \Validator::make(
                $request->all(), [
                    'application_name' => 'required',
                ]
            );

            if ($request->logo) {
                $validator = \Validator::make(
                    $request->all(), [
                        'logo' => 'required|mimes:png',
                    ]
                );
            }

            if ($request->favicon) {
                $validator = \Validator::make(
                    $request->all(), [
                        'favicon' => 'required|mimes:png',
                    ]
                );
            }
            if ($request->front_website_logo) {
                $validator = \Validator::make(
                    $request->all(), [
                        'front_website_logo' => 'required|mimes:png',
                    ]
                );
            }
            if ($validator->fails()) {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }


            if (!empty($request->application_name)) {
                \DB::insert(
                    'insert into settings (`value`, `name`,`parent_id`) values (?, ?, ?) ON DUPLICATE KEY UPDATE `value` = VALUES(`value`) ', [
                        $request->application_name,
                        'app_name',
                        parentId(),
                    ]
                );
            }


            if ($request->logo) {
                $logoName = \Auth::user()->id . '_logo.png';
                $path = $request->file('logo')->storeAs('upload/logo/', $logoName);

                \DB::insert(
                    'insert into settings (`value`, `name`,`parent_id`) values (?, ?, ?) ON DUPLICATE KEY UPDATE `value` = VALUES(`value`) ', [
                        $logoName,
                        'company_logo',
                        parentId(),
                    ]
                );


            }

            if ($request->favicon) {
                $logoName = \Auth::user()->id . '_favicon.png';
                $path = $request->file('favicon')->storeAs('upload/logo/', $logoName);

                \DB::insert(
                    'insert into settings (`value`, `name`,`parent_id`) values (?, ?, ?) ON DUPLICATE KEY UPDATE `value` = VALUES(`value`) ', [
                        $logoName,
                        'company_favicon',
                        parentId(),
                    ]
                );
            }
            if ($request->front_website_logo) {
                $logoName = \Auth::user()->id . '_front_logo.png';
                $path = $request->file('favicon')->storeAs('upload/logo/', $logoName);

                \DB::insert(
                    'insert into settings (`value`, `name`,`parent_id`) values (?, ?, ?) ON DUPLICATE KEY UPDATE `value` = VALUES(`value`) ', [
                        $logoName,
                        'front_website_logo',
                        parentId(),
                    ]
                );
            }
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }


        return redirect()->back()->with('success', __('General setting successfully saved.'));
    }

    //    ---------------------- SMTP --------------------------------------------------------

    public function smtp()
    {
        $loginUser = \Auth::user();

        return view('settings.smtp', compact('loginUser'));
    }

    public function smtpData(Request $request)
    {
        if (\Auth::Check()) {
            $validator = \Validator::make(
                $request->all(), [
                    'server_driver' => 'required',
                    'server_host' => 'required',
                    'server_port' => 'required',
                    'server_username' => 'required',
                    'server_password' => 'required',
                    'server_encryption' => 'required',
                    'from_email' => 'required',
                    'from_name' => 'required',
                ]
            );
            if ($validator->fails()) {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }

            $smtpArray = [
                'SERVER_DRIVER' => $request->server_driver,
                'SERVER_HOST' => $request->server_host,
                'SERVER_PORT' => $request->server_port,
                'SERVER_USERNAME' => $request->server_username,
                'SERVER_PASSWORD' => $request->server_password,
                'SERVER_ENCRYPTION' => $request->server_encryption,
                'FROM_EMAIL' => $request->from_email,
                'FROM_NAME' => $request->from_name,
            ];
            foreach ($smtpArray as $key => $val) {
                \DB::insert(
                    'insert into settings (`value`, `name`, `type`,`parent_id`) values (?, ?, ?,?) ON DUPLICATE KEY UPDATE `value` = VALUES(`value`) ', [
                        $val,
                        $key,
                        'smtp',
                        parentId(),
                    ]
                );
            }

            return redirect()->back()->with('success', __('SMTP settings successfully saved.'));

        } else {
            return redirect()->back()->with('error', __('Invalid user.'));
        }
    }

    //    ---------------------- Payment --------------------------------------------------------

    public function payment()
    {
        $loginUser = \Auth::user();

        return view('settings.payment', compact('loginUser'));
    }

    public function paymentData(Request $request)
    {
        $validator = \Validator::make(
            $request->all(), [
                'currency' => 'required',
                'currency_symbol' => 'required',
            ]
        );
        if ($validator->fails()) {
            $messages = $validator->getMessageBag();
            return redirect()->back()->with('error', $messages->first());
        }

        $currencyArray = [
            'CURRENCY' => $request->currency,
            'CURRENCY_SYMBOL' => $request->currency_symbol,
        ];
        foreach ($currencyArray as $key => $val) {
            \DB::insert(
                'insert into settings (`value`, `name`, `type`,`parent_id`) values (?, ?, ?,?) ON DUPLICATE KEY UPDATE `value` = VALUES(`value`) ', [
                    $val,
                    $key,
                    'payment',
                    parentId(),
                ]
            );
        }

//        For Strip Settings
        if (isset($request->stripe_payment)) {
            $validator = \Validator::make(
                $request->all(), [
                    'stripe_key' => 'required',
                    'stripe_secret' => 'required',
                ]
            );
            if ($validator->fails()) {
                $messages = $validator->getMessageBag();
                return redirect()->back()->with('error', $messages->first());
            }

            $stripeArray = [
                'STRIPE_PAYMENT' => $request->stripe_payment ?? 'off',
                'STRIPE_KEY' => $request->stripe_key,
                'STRIPE_SECRET' => $request->stripe_secret,
            ];

            foreach ($stripeArray as $key => $val) {
                \DB::insert(
                    'insert into settings (`value`, `name`, `type`,`parent_id`) values (?, ?, ?,?) ON DUPLICATE KEY UPDATE `value` = VALUES(`value`) ', [
                        $val,
                        $key,
                        'payment',
                        parentId(),
                    ]
                );
            }
        }


        return redirect()->back()->with('success', __('Payment successfully saved.'));
    }

    //    ---------------------- Company  --------------------------------------------------------

    public function company()
    {
        $settings = settings();
        $timezones = config('timezones');

        return view('settings.company', compact('settings', 'timezones'));
    }

    public function companyData(Request $request)
    {
        $validator = \Validator::make(
            $request->all(), [
                'company_name' => 'required',
                'company_email' => 'required',
                'company_phone' => 'required',
                'company_address' => 'required',
                'company_city' => 'required',
                'company_state' => 'required',
                'company_country' => 'required',
                'company_zipcode' => 'required',
            ]
        );
        if ($validator->fails()) {
            $messages = $validator->getMessageBag();

            return redirect()->back()->with('error', $messages->first());
        }

        $settings = $request->all();
        unset($settings['_token']);

        foreach ($settings as $key => $val) {
            \DB::insert(
                'insert into settings (`value`, `name`,`parent_id`) values (?, ?, ?) ON DUPLICATE KEY UPDATE `value` = VALUES(`value`) ', [
                    $val,
                    $key,
                    parentId(),
                ]
            );
        }

        if (!empty($request->timezone)) {
            $arrEnv = [
                'TIMEZONE' => $request->timezone,
            ];

            Custom::setCommon($arrEnv);
        }

        return redirect()->back()->with('success', __('Company setting successfully saved.'));
    }

    //    ---------------------- Language --------------------------------------------------------

    public function lanquageChange($lang)
    {
        $user = \Auth::user();
        $user->lang = $lang;
        $user->save();

        return redirect()->back()->with('success', __('Language successfully changed.'));
    }

    public function themeSettings(Request $request)
    {
        $settings = $request->all();
        unset($settings['_token']);

        foreach ($settings as $key => $val) {
            \DB::insert(
                'insert into settings (`value`, `name`,`parent_id`) values (?, ?, ?) ON DUPLICATE KEY UPDATE `value` = VALUES(`value`) ', [
                    $val,
                    $key,
                    parentId(),
                ]
            );
        }

        return redirect()->back()->with('success', __('Theme settings save successfully.'));
    }

    //    ---------------------- SEO Settings --------------------------------------------------------

    public function siteSEO()
    {
        $settings = settings();
        return view('settings.site_seo', compact('settings'));
    }

    public function siteSEOData(Request $request)
    {

        $validator = \Validator::make(
            $request->all(), [
                'meta_seo_title' => 'required',
                'meta_seo_keyword' => 'required',
                'meta_seo_description' => 'required',
            ]
        );
        if ($validator->fails()) {
            $messages = $validator->getMessageBag();
            return redirect()->back()->with('error', $messages->first());
        }

        $settings = $request->all();
        unset($settings['_token']);
        if ($request->meta_seo_image) {
            $seoFilenameWithExt = $request->file('meta_seo_image')->getClientOriginalName();
            $seoFilename = pathinfo($seoFilenameWithExt, PATHINFO_FILENAME);
            $supportExtension = $request->file('meta_seo_image')->getClientOriginalExtension();
            $seoFileName = $seoFilename . '_' . time() . '.' . $supportExtension;


            $request->file('meta_seo_image')->storeAs('upload/seo/', $seoFileName);


            \DB::insert(
                'insert into settings (`value`, `name`, `type`,`parent_id`) values (?, ?, ?,?) ON DUPLICATE KEY UPDATE `value` = VALUES(`value`) ', [
                    $seoFileName,
                    'meta_seo_image',
                    'SEO',
                    parentId(),
                ]
            );


        }
        unset($settings['meta_seo_image']);
        foreach ($settings as $key => $val) {
            \DB::insert(
                'insert into settings (`value`, `name`, `type`,`parent_id`) values (?, ?, ?,?) ON DUPLICATE KEY UPDATE `value` = VALUES(`value`) ', [
                    $val,
                    $key,
                    'SEO',
                    parentId(),
                ]
            );
        }

        return redirect()->back()->with('success', __('Site SEO settings save successfully.'));
    }

    //    ---------------------- Google ReCaptcha Settings --------------------------------------------------------

    public function googleRecaptcha()
    {
        $settings = settings();
        return view('settings.recaptcha', compact('settings'));
    }

    public function googleRecaptchaData(Request $request)
    {

        $validator = \Validator::make(
            $request->all(), [
                'recaptcha_key' => 'required',
                'recaptcha_secret' => 'required',
            ]
        );
        if ($validator->fails()) {
            $messages = $validator->getMessageBag();
            return redirect()->back()->with('error', $messages->first());
        }

        $settings = $request->all();
        unset($settings['_token']);

        $stripeArray = [
            'google_recaptcha' => $request->google_recaptcha ?? 'off',
            'recaptcha_key' => $request->recaptcha_key,
            'recaptcha_secret' => $request->recaptcha_secret,
        ];

        foreach ($stripeArray as $key => $val) {
            \DB::insert(
                'insert into settings (`value`, `name`, `type`,`parent_id`) values (?, ?, ?,?) ON DUPLICATE KEY UPDATE `value` = VALUES(`value`) ', [
                    $val,
                    $key,
                    'recaptcha',
                    parentId(),
                ]
            );
        }

        return redirect()->back()->with('success', __('Site SEO settings save successfully.'));
    }
}
