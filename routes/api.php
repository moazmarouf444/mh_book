<?php

use Illuminate\Support\Facades\Route;
Route::group([
  'prefix'     => 'v1',
  'namespace'  => 'Api\V1',
  'middleware' => ['api-cors', 'api-lang'],
], function () {

  /***************************** SettingController start *****************************/
  Route::get('settings', 'SettingController@settings');
  Route::get('intro', 'SettingController@intro');
  Route::get('about', 'SettingController@about');
  Route::get('terms', 'SettingController@terms');
  Route::get('privacy', 'SettingController@privacy');
  Route::get('intros', 'SettingController@intros');
  Route::get('fqss', 'SettingController@fqss');
  Route::get('socials', 'SettingController@socials');
  Route::get('images', 'SettingController@images');
  Route::get('covers', 'SettingController@covers');
  Route::get('frames', 'SettingController@frames');
  Route::get('education-levels', 'SettingController@educationLeveles');
  Route::get('all-order-options', 'SettingController@orderShow');

  /***************************** SettingController End *****************************/

  /***************************** AuthController Start *****************************/
  Route::post('sign-up', 'AuthController@register');
  Route::patch('activate', 'AuthController@activate');
  Route::get('resend-code', 'AuthController@resendCode');
  
  Route::post('sign-in', 'AuthController@login');
  Route::delete('sign-out', 'AuthController@logout');
  
  Route::post('forget-password', 'AuthController@forgetCheckCode');
  Route::post('reset-password', 'AuthController@resetPassword');

  Route::group(['middleware' => ['auth:sanctum', 'is-active']], function () {
    Route::get('profile', 'AuthController@getProfile');
    Route::put('update-profile', 'AuthController@updateProfile');
    Route::patch('update-passward', 'AuthController@updatePassword');
    Route::patch('change-lang', 'AuthController@changeLang');
    Route::patch('switch-notify', 'AuthController@switchNotificationStatus');

    Route::get('notifications', 'AuthController@getNotifications');
    Route::get('count-notifications', 'AuthController@countUnreadNotifications');
    Route::delete('delete-notification/{notification_id}', 'AuthController@deleteNotification');
    Route::delete('delete-notifications', 'AuthController@deleteNotifications');
    
    Route::post('new-complaint', 'AuthController@storeComplaint');
    Route::post('new-message', 'AuthController@storeMessages');
    Route::post('store-order', 'OrderController@storeOrder');
    Route::get('order-details/{order?}', 'OrderController@orderDetails');
    Route::patch('order-confirm/{order}', 'OrderController@orderConfirm');
    Route::patch('order-cancel/{order}', 'OrderController@orderCancel');
    Route::get('my-orders', 'OrderController@myOrders');
    Route::get('new-orders', 'OrderController@myCurrentOrders');
    Route::get('inprogress-orders', 'OrderController@myInProgressOrders');
    Route::get('finish-orders', 'OrderController@myFinishedOrders');
  });
  /***************************** AuthController end *****************************/
});
