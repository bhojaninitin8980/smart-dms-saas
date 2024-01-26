<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Custom;
use App\Models\Document;
use App\Models\NoticeBoard;
use App\Models\Order;
use App\Models\Reminder;
use App\Models\SubCategory;
use App\Models\Subscription;
use App\Models\Support;
use App\Models\User;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index()
    {
        if (\Auth::check()) {
            if (\Auth::user()->type == 'super admin') {
                $data['totalOrganization'] = User::where('type', 'owner')->count();
                $data['totalSubscription'] = Subscription::count();
                $data['totalTransaction'] = Order::count();
                $data['totalIncome'] = Order::sum('price');
                $data['totalNote'] = NoticeBoard::where('parent_id', parentId())->count();
                $data['totalContact'] = Contact::where('parent_id', parentId())->count();
                $data['totalSupport'] = Support::where('created_id', parentId())->orWhere('assign_user', parentId())->count();
                $data['todaySupport'] = Support::whereDate('created_at', '=', date('Y-m-d'))->where('created_id', parentId())->orWhere('assign_user', parentId())->count();

                $data['organizationByMonth'] = $this->organizationByMonth();
                $data['paymentByMonth'] = $this->paymentByMonth();

                return view('dashboard.super_admin', compact('data'));
            } else {
                $data['totalUser'] = User::where('parent_id', parentId())->count();
                $data['totalDocument'] = Document::where('parent_id', parentId())->count();
                $data['todayDocument'] = Document::whereDate('created_at',Carbon::today())->where('parent_id', parentId())->count();
                $data['totalCategory'] = Category::where('parent_id', parentId())->count();
                $data['totalReminder'] = Reminder::where('parent_id', parentId())->count();
                $data['todayReminder'] = Reminder::whereDate('date',Carbon::today())->where('parent_id', parentId())->count();

                $data['totalContact'] = Contact::where('parent_id', \Auth::user()->id)->count();
                $data['totalSupport'] = Support::where('created_id', \Auth::user()->id)->orWhere('assign_user', \Auth::user()->id)->count();
                $data['todaySupport'] = Support::whereDate('created_at', '=', date('Y-m-d'))->where('created_id', \Auth::user()->id)->orWhere('assign_user', \Auth::user()->id)->count();

                $data['documentByCategory'] = $this->documentByCategory();
                $data['documentBySubCategory'] = $this->documentBySubCategory();
                $data['settings']=settings();


                return view('dashboard.index', compact('data'));
            }
        } else {
            if (!file_exists(storage_path() . "/installed")) {
                header('location:install');
                die;
            } else {
                $landingPage=getSettingsValByName('landing_page');

                if($landingPage=='on'){
                    return view('layouts.landing');
                }else{
                    return redirect()->route('login');
                }
            }

        }

    }

    public function organizationByMonth()
    {
        $start = strtotime(date('Y-01'));
        $end = strtotime(date('Y-12'));

        $currentdate = $start;

        $organization = [];
        while ($currentdate <= $end) {
            $organization['label'][] = date('M-Y', $currentdate);

            $month = date('m', $currentdate);
            $year = date('Y', $currentdate);
            $organization['data'][] = User::where('type', 'owner')->whereMonth('created_at', $month)->whereYear('created_at', $year)->count();
            $currentdate = strtotime('+1 month', $currentdate);
        }


        return $organization;

    }

    public function paymentByMonth()
    {
        $start = strtotime(date('Y-01'));
        $end = strtotime(date('Y-12'));

        $currentdate = $start;

        $payment = [];
        while ($currentdate <= $end) {
            $payment['label'][] = date('M-Y', $currentdate);

            $month = date('m', $currentdate);
            $year = date('Y', $currentdate);
            $payment['data'][] = Order::whereMonth('created_at', $month)->whereYear('created_at', $year)->sum('price');
            $currentdate = strtotime('+1 month', $currentdate);
        }

        return $payment;

    }

    public function documentByCategory()
    {
        $categories=Category::where('parent_id',parentId())->get();
        $documents = [];
        $cat = [];
        foreach ($categories as $category) {
            $documents[] = Document::where('parent_id',parentId())->where('category_id',$category->id)->count();
            $cat[]=$category->title;
        }
        $data['data']=$documents;
        $data['category']=$cat;
        return $data;
    }
    public function documentBySubCategory()
    {
        $categories=SubCategory::where('parent_id',parentId())->get();
        $documents = [];
        $cat = [];
        foreach ($categories as $category) {
            $documents[] = Document::where('parent_id',parentId())->where('category_id',$category->id)->count();
            $cat[]=$category->title;
        }
        $data['data']=$documents;
        $data['category']=$cat;
        return $data;
    }

}
