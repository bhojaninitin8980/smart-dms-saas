<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\NoticeBoardController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\SupportController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\ReminderController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
require __DIR__ . '/auth.php';

Route::get('/', [HomeController::class,'index'])->middleware(
    [

        'XSS',
    ]
);
Route::get('home', [HomeController::class,'index'])->name('home')->middleware(
    [

        'XSS',
    ]
);
Route::get('dashboard', [HomeController::class,'index'])->name('dashboard')->middleware(
    [

        'XSS',
    ]
);

//-------------------------------User-------------------------------------------

Route::resource('users', UserController::class)->middleware(
    [
        'auth',
        'XSS',
    ]
);


//-------------------------------Subscription-------------------------------------------


Route::resource('subscriptions', SubscriptionController::class)->middleware(
    [
        'auth',
        'XSS',
    ]
);

Route::group(
    [
        'middleware' => [
            'auth',
            'XSS',
        ],
    ], function (){

    Route::get('subscription/transaction', [SubscriptionController::class,'transaction'])->name('subscription.transaction');
    Route::post('subscription/{id}/stripe/payment', [SubscriptionController::class,'stripePayment'])->name('subscription.stripe.payment');

}
);

//-------------------------------Settings-------------------------------------------
Route::group(
    [
        'middleware' => [
            'auth',
            'XSS',
        ],
    ], function (){
    Route::get('settings/account', [SettingController::class,'account'])->name('setting.account');
    Route::post('settings/account', [SettingController::class,'accountData'])->name('setting.account');
    Route::delete('settings/account/delete', [SettingController::class,'accountDelete'])->name('setting.account.delete');

    Route::get('settings/password', [SettingController::class,'password'])->name('setting.password');
    Route::post('settings/password', [SettingController::class,'passwordData'])->name('setting.password');

    Route::get('settings/general', [SettingController::class,'general'])->name('setting.general');
    Route::post('settings/general', [SettingController::class,'generalData'])->name('setting.general');

    Route::get('settings/smtp', [SettingController::class,'smtp'])->name('setting.smtp');
    Route::post('settings/smtp', [SettingController::class,'smtpData'])->name('setting.smtp');

    Route::get('settings/payment', [SettingController::class,'payment'])->name('setting.payment');
    Route::post('settings/payment', [SettingController::class,'paymentData'])->name('setting.payment');

    Route::get('settings/company', [SettingController::class,'company'])->name('setting.company');
    Route::post('settings/company', [SettingController::class,'companyData'])->name('setting.company');

    Route::get('language/{lang}', [SettingController::class,'lanquageChange'])->name('language.change');
    Route::post('theme/settings', [SettingController::class,'themeSettings'])->name('theme.settings');


}
);


//-------------------------------Role & Permissions-------------------------------------------
Route::resource('permission', PermissionController::class)->middleware(
    [
        'auth',
        'XSS',
    ]
);

Route::resource('role', RoleController::class)->middleware(
    [
        'auth',
        'XSS',
    ]
);




//-------------------------------Note-------------------------------------------
Route::resource('note', NoticeBoardController::class)->middleware(
    [
        'auth',
        'XSS',
    ]
);

//-------------------------------Contact-------------------------------------------
Route::resource('contact', ContactController::class)->middleware(
    [
        'auth',
        'XSS',
    ]
);


//-------------------------------Support-------------------------------------------

Route::post('support/reply/{id}', [SupportController::class,'reply'])->name('support.reply')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::resource('support', SupportController::class)->middleware(
    [
        'auth',
        'XSS',
    ]
);

//-------------------------------Document-------------------------------------------

Route::group(
    [
        'middleware' => [
            'auth',
            'XSS',
        ],
    ], function () {
    Route::get('document/history', [DocumentController::class,'history'])->name('document.history');
    Route::resource('document', DocumentController::class);
    Route::get('my-document', [DocumentController::class,'myDocument'])->name('document.my-document');
    Route::get('document/{id}/comment', [DocumentController::class,'comment'])->name('document.comment');
    Route::post('document/{id}/comment', [DocumentController::class,'commentData'])->name('document.comment');
    Route::get('document/{id}/reminder', [DocumentController::class,'reminder'])->name('document.reminder');
    Route::get('document/{id}/version-history', [DocumentController::class,'versionHistory'])->name('document.version.history');
    Route::post('document/{id}/version-history', [DocumentController::class,'newVersion'])->name('document.new.version');
    Route::get('document/{id}/share', [DocumentController::class,'shareDocument'])->name('document.share');
    Route::post('document/{id}/share', [DocumentController::class,'shareDocumentData'])->name('document.share');
    Route::delete('document/{id}/share/destroy', [DocumentController::class,'shareDocumentDelete'])->name('document.share.destroy');
    Route::get('document/{id}/send-email', [DocumentController::class,'sendEmail'])->name('document.send.email');
    Route::post('document/{id}/send-email', [DocumentController::class,'sendEmailData'])->name('document.send.email');



});

//-------------------------------Reminder-------------------------------------------

Route::group(
    [
        'middleware' => [
            'auth',
            'XSS',
        ],
    ], function () {
    Route::resource('reminder', ReminderController::class);
    Route::get('my-reminder', [ReminderController::class,'myReminder'])->name('my-reminder');

});
//-------------------------------Category, Sub Category & Tag-------------------------------------------

Route::get('category/{id}/sub-category', [CategoryController::class,'getSubcategory'])->name('category.sub-category');
Route::resource('category', CategoryController::class)->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::resource('sub-category', SubCategoryController::class)->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::resource('tag', TagController::class)->middleware(
    [
        'auth',
        'XSS',
    ]
);
