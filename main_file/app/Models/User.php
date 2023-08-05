<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasRoles;
    use Notifiable;



    protected $fillable = [
        'name',
        'email',
        'password',
        'type',
        'profile',
        'lang',
        'subscription',
        'subscription_expire_date',
        'parent_id',
        'is_active',
    ];


    protected $hidden = [
        'password',
        'remember_token',
    ];


    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function parentId()
    {

        if($this->type == 'admin' || $this->type == 'super admin')
        {
            return $this->id;
        }
        else
        {
            return $this->parent_id;
        }
    }

    public function dateFormat($date)
    {
        $settings = Custom::settings();

        return date($settings['company_date_format'], strtotime($date));
    }

    public function timeFormat($time)
    {
        $settings = Custom::settings();

        return date($settings['company_time_format'], strtotime($time));
    }

    public function priceFormat($price)
    {
        $settings = Custom::settings();

        return $settings['company_currency_symbol'] . $price;
    }

    public function assignSubscription($id)
    {
        $subscription = Subscription::find($id);
        if($subscription)
        {
            $this->subscription = $subscription->id;
            if($subscription->duration == 'month')
            {
                $this->subscription_expire_date = Carbon::now()->addMonths(1)->isoFormat('YYYY-MM-DD');
            }
            elseif($subscription->duration == 'year')
            {
                $this->subscription_expire_date = Carbon::now()->addYears(1)->isoFormat('YYYY-MM-DD');
            }
            else
            {
                $this->subscription_expire_date = null;
            }
            $this->save();

            $users = User::where('parent_id', '=', \Auth::user()->parentId())->where('type', '!=', 'super admin')->where('type', '!=', 'admin')->get();



            if($subscription->total_user == 0)
            {
                foreach($users as $user)
                {
                    $user->is_active = 1;
                    $user->save();
                }
            }
            else
            {
                $userCount = 0;
                foreach($users as $user)
                {
                    $userCount++;
                    if($userCount <= $subscription->total_user)
                    {
                        $user->is_active = 1;
                        $user->save();
                    }
                    else
                    {
                        $user->is_active = 0;
                        $user->save();
                    }
                }
            }

        }
        else
        {
            return [
                'is_success' => false,
                'error' => 'Subscription is deleted.',
            ];
        }
    }

    public function totalUser()
    {
        return User::where('type', '!=', 'super admin')->where('type', '!=', 'admin')->where('parent_id', '=', $this->parentId())->count();
    }
    public function totalDocument()
    {
        return Document::where('parent_id', '=', $this->parentId())->count();
    }
    public function totalContact()
    {
        return Contact::where('parent_id', '=', $this->parentId())->count();
    }

    public function roleWiseUserCount($role)
    {
        return User::where('type', $role)->where('parent_id',\Auth::user()->parentId())->count();
    }
    public static function GetDeviceType($user_agent)
    {
        $mobile_regex = '/(?:phone|windows\s+phone|ipod|blackberry|(?:android|bb\d+|meego|silk|googlebot) .+? mobile|palm|windows\s+ce|opera mini|avantgo|mobilesafari|docomo)/i';
        $tablet_regex = '/(?:ipad|playbook|(?:android|bb\d+|meego|silk)(?! .+? mobile))/i';
        if(preg_match_all($mobile_regex, $user_agent))
        {
            return 'mobile';
        }
        else
        {
            if(preg_match_all($tablet_regex, $user_agent)) {
                return 'tablet';
            } else {
                return 'desktop';
            }

        }
    }


}
