<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'admin',
    'namespace' => 'Admin',
    'as' => 'admin.',
    'middleware' => ['web-cors'],
], function () {

    Route::get('/lang/{lang}', 'AuthController@SetLanguage');

    Route::get('login', 'AuthController@showLoginForm')->name('show.login')->middleware('guest:admin');
    Route::post('login', 'AuthController@login')->name('login');
    Route::get('logout', 'AuthController@logout')->name('logout');

    Route::post('getCities', 'CityController@getCities')->name('getCities');

    Route::group(['middleware' => ['admin', 'check-role', 'admin-lang']], function () {

        /*------------ start Of Dashboard----------*/
        Route::get('dashboard', [
            'uses' => 'HomeController@dashboard',
            'as' => 'dashboard',
            'icon' => '<i class="feather icon-home"></i>',
            'title' => 'الرئيسيه',
            'sub_route' => false,
            'type' => 'parent',
        ]);
        /*------------ end Of dashboard ----------*/

        /*------------ start Of intro site  ----------*/
        Route::get('intro-site', [
            'as' => 'intro_site',
            'icon' => '<i class="feather icon-map"></i>',
            'title' => 'الموقع التعريفي',
            'type' => 'parent',
            'sub_route' => true,
            'child' => [
                'intro_settings.index', 'introsliders.show', 'introsliders.index', 'introsliders.store', 'introsliders.update', 'introsliders.delete', 'introsliders.deleteAll', 'introsliders.create', 'introsliders.edit',
                'introservices.show', 'introservices.index', 'introservices.create', 'introservices.store', 'introservices.edit', 'introservices.update', 'introservices.delete', 'introservices.deleteAll',
                'introfqscategories.show', 'introfqscategories.index', 'introfqscategories.store', 'introfqscategories.create', 'introfqscategories.edit', 'introfqscategories.update', 'introfqscategories.delete', 'introfqscategories.deleteAll',
                'introfqs.show', 'introfqs.index', 'introfqs.store', 'introfqs.update', 'introfqs.delete', 'introfqs.deleteAll', 'introfqs.edit', 'introfqs.create',
                'introparteners.create', 'introparteners.show', 'introparteners.index', 'introparteners.store', 'introparteners.update', 'introparteners.delete', 'introparteners.deleteAll',
                'intromessages.index', 'intromessages.delete', 'intromessages.deleteAll', 'intromessages.show',
                'introsocials.show', 'introsocials.index', 'introsocials.store', 'introsocials.update', 'introsocials.delete', 'introsocials.deleteAll', 'introsocials.edit', 'introsocials.create',
                'introparteners.edit', 'introhowworks.show', 'introhowworks.index', 'introhowworks.store', 'introhowworks.update', 'introhowworks.delete', 'introhowworks.deleteAll', 'introhowworks.create', 'introhowworks.edit',
            ],
        ]);

        Route::get('intro-settings', [
            'uses' => 'IntroSetting@index',
            'as' => 'intro_settings.index',
            'title' => 'اعدادات الموقع التعريفي',
            'icon' => '<i class="feather icon-settings"></i>',

        ]);

        /*------------ start Of introsliders ----------*/
        Route::get('introsliders', [
            'uses' => 'IntroSliderController@index',
            'as' => 'introsliders.index',
            'title' => 'بنرات الاسلايدر',
            'icon' => '<i class="feather icon-image"></i>',
        ]);

        # introsliders update
        Route::get('introsliders/{id}/Show', [
            'uses' => 'IntroSliderController@show',
            'as' => 'introsliders.show',
            'title' => 'صفحه عرض بنر',
        ]);

        # socials store
        Route::get('introsliders/create', [
            'uses' => 'IntroSliderController@create',
            'as' => 'introsliders.create',
            'title' => ' صفحة اضافة بنر',
        ]);

        # introsliders store
        Route::post('introsliders/store', [
            'uses' => 'IntroSliderController@store',
            'as' => 'introsliders.store',
            'title' => ' اضافة بنر',
        ]);

        # socials update
        Route::get('introsliders/{id}/edit', [
            'uses' => 'IntroSliderController@edit',
            'as' => 'introsliders.edit',
            'title' => 'صفحه تحديث بنر',
        ]);

        # introsliders update
        Route::put('introsliders/{id}', [
            'uses' => 'IntroSliderController@update',
            'as' => 'introsliders.update',
            'title' => 'تحديث بنر',
        ]);

        # introsliders delete
        Route::delete('introsliders/{id}', [
            'uses' => 'IntroSliderController@destroy',
            'as' => 'introsliders.delete',
            'title' => 'حذف بنر',
        ]);

        #delete all introsliders
        Route::post('delete-all-introsliders', [
            'uses' => 'IntroSliderController@destroyAll',
            'as' => 'introsliders.deleteAll',
            'title' => 'حذف مجموعه من بنرات',
        ]);
        /*------------ end Of introsliders ----------*/

        /*------------ start Of introservices ----------*/
        Route::get('introservices', [
            'uses' => 'IntroServiceController@index',
            'as' => 'introservices.index',
            'title' => 'خدماتنا',
            'icon' => '<i class="la la-map"></i>',
        ]);
        # introservices update
        Route::get('introservices/{id}/Show', [
            'uses' => 'IntroServiceController@show',
            'as' => 'introservices.show',
            'title' => 'صفحه عرض خدمة  ',
        ]);
        # socials store
        Route::get('introservices/create', [
            'uses' => 'IntroServiceController@create',
            'as' => 'introservices.create',
            'title' => ' صفحة اضافة خدمة',
        ]);
        # introservices store
        Route::post('introservices/store', [
            'uses' => 'IntroServiceController@store',
            'as' => 'introservices.store',
            'title' => ' اضافة خدمه',
        ]);

        # socials update
        Route::get('introservices/{id}/edit', [
            'uses' => 'IntroServiceController@edit',
            'as' => 'introservices.edit',
            'title' => 'صفحه تحديث خدمة',
        ]);

        # introservices update
        Route::put('introservices/{id}', [
            'uses' => 'IntroServiceController@update',
            'as' => 'introservices.update',
            'title' => 'تحديث خدمه',
        ]);

        # introservices delete
        Route::delete('introservices/{id}', [
            'uses' => 'IntroServiceController@destroy',
            'as' => 'introservices.delete',
            'title' => 'حذف خدمه',
        ]);

        #delete all introservices
        Route::post('delete-all-introservices', [
            'uses' => 'IntroServiceController@destroyAll',
            'as' => 'introservices.deleteAll',
            'title' => 'حذف مجموعه من خدماتنا',
        ]);
        /*------------ end Of introservices ----------*/

        /*------------ start Of introfqscategories ----------*/
        Route::get('introfqscategories', [
            'uses' => 'IntroFqsCategoryController@index',
            'as' => 'introfqscategories.index',
            'title' => 'اقسام الاسئله الشائعة',
            'icon' => '<i class="la la-list"></i>',
        ]);
        # socials store
        Route::get('introfqscategories/create', [
            'uses' => 'IntroFqsCategoryController@create',
            'as' => 'introfqscategories.create',
            'title' => ' صفحة اضافة قسم',
        ]);
        # introfqscategories store
        Route::post('introfqscategories/store', [
            'uses' => 'IntroFqsCategoryController@store',
            'as' => 'introfqscategories.store',
            'title' => ' اضافة قسم',
        ]);
        # introfqscategories update
        Route::get('introfqscategories/{id}/edit', [
            'uses' => 'IntroFqsCategoryController@edit',
            'as' => 'introfqscategories.edit',
            'title' => 'صفحه تحديث قسم',
        ]);
        # introfqscategories update
        Route::put('introfqscategories/{id}', [
            'uses' => 'IntroFqsCategoryController@update',
            'as' => 'introfqscategories.update',
            'title' => 'تحديث قسم',
        ]);

        # introfqscategories update
        Route::get('introfqscategories/{id}/Show', [
            'uses' => 'IntroFqsCategoryController@show',
            'as' => 'introfqscategories.show',
            'title' => 'صفحه عرض قسم ',
        ]);

        # introfqscategories delete
        Route::delete('introfqscategories/{id}', [
            'uses' => 'IntroFqsCategoryController@destroy',
            'as' => 'introfqscategories.delete',
            'title' => 'حذف قسم',
        ]);

        #delete all introfqscategories
        Route::post('delete-all-introfqscategories', [
            'uses' => 'IntroFqsCategoryController@destroyAll',
            'as' => 'introfqscategories.deleteAll',
            'title' => 'حذف مجموعه من الاقسام ',
        ]);
        /*------------ end Of introfqscategories ----------*/

        /*------------ start Of introfqs ----------*/
        Route::get('introfqs', [
            'uses' => 'IntroFqsController@index',
            'as' => 'introfqs.index',
            'title' => 'الاسئله الشائعه',
            'icon' => '<i class="la la-bullhorn"></i>',
        ]);

        # socials store
        Route::get('introfqs/create', [
            'uses' => 'IntroFqsController@create',
            'as' => 'introfqs.create',
            'title' => ' صفحة اضافة سؤال',
        ]);

        # introfqs store
        Route::post('introfqs/store', [
            'uses' => 'IntroFqsController@store',
            'as' => 'introfqs.store',
            'title' => ' اضافة سؤال',
        ]);
        # introfqscategories update
        Route::get('introfqs/{id}/edit', [
            'uses' => 'IntroFqsController@edit',
            'as' => 'introfqs.edit',
            'title' => 'صفحه تحديث سؤال',
        ]);
        # introfqscategories update
        Route::get('introfqs/{id}/Show', [
            'uses' => 'IntroFqsController@show',
            'as' => 'introfqs.show',
            'title' => 'صفحه عرض السؤال',
        ]);

        # introfqs update
        Route::put('introfqs/{id}', [
            'uses' => 'IntroFqsController@update',
            'as' => 'introfqs.update',
            'title' => 'تحديث سؤال',
        ]);

        # introfqs delete
        Route::delete('introfqs/{id}', [
            'uses' => 'IntroFqsController@destroy',
            'as' => 'introfqs.delete',
            'title' => 'حذف سؤال',
        ]);

        #delete all introfqs
        Route::post('delete-all-introfqs', [
            'uses' => 'IntroFqsController@destroyAll',
            'as' => 'introfqs.deleteAll',
            'title' => 'حذف مجموعه من الاسئله الشائعه',
        ]);
        /*------------ end Of introfqs ----------*/

        /*------------ start Of introparteners ----------*/
        Route::get('introparteners', [
            'uses' => 'IntroPartenerController@index',
            'as' => 'introparteners.index',
            'title' => 'شركاء النجاح',
            'icon' => '<i class="la la-list"></i>',
        ]);

        # introparteners update
        Route::get('introparteners/{id}/Show', [
            'uses' => 'IntroPartenerController@show',
            'as' => 'introparteners.show',
            'title' => 'صفحه عرض شريك نجاح ',
        ]);

        # socials store
        Route::get('introparteners/create', [
            'uses' => 'IntroPartenerController@create',
            'as' => 'introparteners.create',
            'title' => ' صفحة اضافة شريك',
        ]);

        # introparteners store
        Route::post('introparteners/store', [
            'uses' => 'IntroPartenerController@store',
            'as' => 'introparteners.store',
            'title' => ' اضافة شريك',
        ]);

        # introparteners update
        Route::get('introparteners/{id}/edit', [
            'uses' => 'IntroPartenerController@edit',
            'as' => 'introparteners.edit',
            'title' => 'صفحه تحديث شريك',
        ]);

        # introparteners update
        Route::put('introparteners/{id}', [
            'uses' => 'IntroPartenerController@update',
            'as' => 'introparteners.update',
            'title' => 'تحديث شريك',
        ]);

        # introparteners delete
        Route::delete('introparteners/{id}', [
            'uses' => 'IntroPartenerController@destroy',
            'as' => 'introparteners.delete',
            'title' => 'حذف شريك',
        ]);

        #delete all introparteners
        Route::post('delete-all-introparteners', [
            'uses' => 'IntroPartenerController@destroyAll',
            'as' => 'introparteners.deleteAll',
            'title' => 'حذف مجموعه من شركاء النجاح',
        ]);
        /*------------ end Of introparteners ----------*/

        /*------------ start Of intromessages ----------*/
        Route::get('intromessages', [
            'uses' => 'IntroMessagesController@index',
            'as' => 'intromessages.index',
            'title' => 'رسائل العملاء',
            'icon' => '<i class="la la-envelope-square"></i>',
        ]);

        # socials update
        Route::get('intromessages/{id}', [
            'uses' => 'IntroMessagesController@show',
            'as' => 'intromessages.show',
            'title' => 'صفحه عرض الرسالة',
        ]);

        # intromessages delete
        Route::delete('intromessages/{id}', [
            'uses' => 'IntroMessagesController@destroy',
            'as' => 'intromessages.delete',
            'title' => 'حذف رسالة',
        ]);

        #delete all intromessages
        Route::post('delete-all-intromessages', [
            'uses' => 'IntroMessagesController@destroyAll',
            'as' => 'intromessages.deleteAll',
            'title' => 'حذف مجموعه من رسائل العملاء',
        ]);
        /*------------ end Of intromessages ----------*/

        /*------------ start Of introsocials ----------*/
        Route::get('introsocials', [
            'uses' => 'IntroSocialController@index',
            'as' => 'introsocials.index',
            'title' => 'وسائل التواصل',
            'icon' => '<i class="la la-facebook"></i>',
        ]);

        # introsocials update
        Route::get('introsocials/{id}/Show', [
            'uses' => 'IntroSocialController@show',
            'as' => 'introsocials.show',
            'title' => 'صفحه عرض وسيلة تواصل  ',
        ]);
        # introsocials store
        Route::get('introsocials/create', [
            'uses' => 'IntroSocialController@create',
            'as' => 'introsocials.create',
            'title' => ' صفحة اضافة وسيلة تواصل',
        ]);

        # introsocials store
        Route::post('introsocials/store', [
            'uses' => 'IntroSocialController@store',
            'as' => 'introsocials.store',
            'title' => ' اضافة وسيلة',
        ]);
        # introsocials update
        Route::get('introsocials/{id}/edit', [
            'uses' => 'IntroSocialController@edit',
            'as' => 'introsocials.edit',
            'title' => 'صفحه تحديث وسيلة تواصل',
        ]);

        # introsocials update
        Route::put('introsocials/{id}', [
            'uses' => 'IntroSocialController@update',
            'as' => 'introsocials.update',
            'title' => 'تحديث وسيلة',
        ]);

        # introsocials delete
        Route::delete('introsocials/{id}', [
            'uses' => 'IntroSocialController@destroy',
            'as' => 'introsocials.delete',
            'title' => 'حذف وسيلة',
        ]);

        #delete all introsocials
        Route::post('delete-all-introsocials', [
            'uses' => 'IntroSocialController@destroyAll',
            'as' => 'introsocials.deleteAll',
            'title' => 'حذف مجموعه من وسائل التواصل',
        ]);
        /*------------ end Of introsocials ----------*/

        /*------------ start Of introhowworks ----------*/
        Route::get('introhowworks', [
            'uses' => 'IntroHowWorkController@index',
            'as' => 'introhowworks.index',
            'title' => 'كيف نعمل',
            'icon' => '<i class="la la-calendar-check-o"></i>',
        ]);

        # introhowworks store
        Route::get('introhowworks/create', [
            'uses' => 'IntroHowWorkController@create',
            'as' => 'introhowworks.create',
            'title' => ' صفحة اضافة طريقة عمل',
        ]);
        # introfqscategories update
        Route::get('introhowworks/{id}/Show', [
            'uses' => 'IntroHowWorkController@show',
            'as' => 'introhowworks.show',
            'title' => 'صفحه عرض طريقة عمل ',
        ]);

        # introhowworks update
        Route::get('introhowworks/{id}/edit', [
            'uses' => 'IntroHowWorkController@edit',
            'as' => 'introhowworks.edit',
            'title' => 'صفحه تحديث  طريقة عمل',
        ]);

        # introhowworks store
        Route::post('introhowworks/store', [
            'uses' => 'IntroHowWorkController@store',
            'as' => 'introhowworks.store',
            'title' => ' اضافة خطوه',
        ]);

        # introhowworks update
        Route::put('introhowworks/{id}', [
            'uses' => 'IntroHowWorkController@update',
            'as' => 'introhowworks.update',
            'title' => 'تحديث خطوه',
        ]);

        # introhowworks delete
        Route::delete('introhowworks/{id}', [
            'uses' => 'IntroHowWorkController@destroy',
            'as' => 'introhowworks.delete',
            'title' => 'حذف خطوه',
        ]);

        #delete all introhowworks
        Route::post('delete-all-introhowworks', [
            'uses' => 'IntroHowWorkController@destroyAll',
            'as' => 'introhowworks.deleteAll',
            'title' => 'حذف مجموعه من كيف نعمل',
        ]);
        /*------------ end Of introhowworks ----------*/

        /*------------ end Of intro site ----------*/

        /*------------ start Of users Controller ----------*/

        Route::get('users', [
            'as' => 'users',
            'icon' => '<i class="feather icon-users"></i>',
            'title' => 'المستخدمين',
            'type' => 'parent',
            'sub_route' => true,
            'child' => ['clients.index', 'clients.active', 'clients.notActive', 'clients.notBlocked', 'clients.blocked', 'clients.show', 'clients.store', 'clients.update', 'clients.delete', 'clients.notify', 'clients.deleteAll', 'clients.create', 'clients.edit'],
        ]);

        /************ Clients ************/
        #index
        Route::get('clients', [
            'uses' => 'ClientController@index',
            'as' => 'clients.index',
            'title' => 'كل المستخدمين',
            'sub_route' => false,
            'icon' => '<i class="la la-user"></i>',

        ]);
        #index
        Route::get('clients/active', [
            'uses' => 'ClientController@active',
            'as' => 'clients.active',
            'title' => 'المستخدمين النشطين',
            'icon' => '<i class="la la-user"></i>',

        ]);
        #index
        Route::get('clients/not-active', [
            'uses' => 'ClientController@notActive',
            'as' => 'clients.notActive',
            'title' => 'المستخدمين الغير نشطين',
            'icon' => '<i class="la la-user"></i>',

        ]);
        #index
        Route::get('clients/block', [
            'uses' => 'ClientController@block',
            'as' => 'clients.blocked',
            'title' => 'المستخدمين المحظورين',
            'icon' => '<i class="la la-user"></i>',

        ]);
        #index
        Route::get('clients/not-block', [
            'uses' => 'ClientController@notBlock',
            'as' => 'clients.notBlocked',
            'title' => 'المستخدمين الغير المحظورين',
            'icon' => '<i class="la la-user"></i>',

        ]);

        # clients store
        Route::get('clients/create', [
            'uses' => 'ClientController@create',
            'as' => 'clients.create', 'clients.edit',
            'title' => ' صفحة اضافة عميل',
        ]);

        # clients update
        Route::get('clients/{id}/edit', [
            'uses' => 'ClientController@edit',
            'as' => 'clients.edit',
            'title' => 'صفحه تحديث عميل',
        ]);
        #store
        Route::post('clients/store', [
            'uses' => 'ClientController@store',
            'as' => 'clients.store',
            'title' => 'اضافة عميل',
        ]);

        #update
        Route::put('clients/{id}', [
            'uses' => 'ClientController@update',
            'as' => 'clients.update',
            'title' => 'تعديل عميل',
        ]);

        Route::get('clients/{id}/show', [
            'uses' => 'ClientController@show',
            'as' => 'clients.show',
            'title' => 'عرض عميل',
        ]);

        #delete
        Route::delete('clients/{id}', [
            'uses' => 'ClientController@destroy',
            'as' => 'clients.delete',
            'title' => 'حذف عميل',
        ]);

        #delete
        Route::post('delete-all-clients', [
            'uses' => 'ClientController@destroyAll',
            'as' => 'clients.deleteAll',
            'title' => 'حذف مجموعه من العملاء',
        ]);

        #notify
        Route::post('admins/clients/notify', [
            'uses' => 'ClientController@notify',
            'as' => 'clients.notify',
            'title' => 'ارسال اشعار للعملاء',
        ]);
        /************ #Clients ************/
        /*------------ end Of users Controller ----------*/

        /************ Admins ************/
        #index
        Route::get('admins', [
            'uses' => 'AdminController@index',
            'as' => 'admins.index',
            'title' => 'المشرفين',
            'icon' => '<i class="feather icon-users"></i>',
            'type' => 'parent',
            'child' => [
                'admins.index', 'admins.store', 'admins.update', 'admins.edit', 'admins.delete', 'admins.deleteAll', 'admins.create', 'admins.edit', 'admins.notifications', 'admins.notifications.delete', 'admins.show',
            ],
        ]);


        # admins store
        Route::get('show-notifications', [
            'uses' => 'AdminController@notifications',
            'as' => 'admins.notifications',
            'title' => 'صفحة الاشعارات',
        ]);

        # admins store
        Route::post('delete-notifications', [
            'uses' => 'AdminController@deleteNotifications',
            'as' => 'admins.notifications.delete',
            'title' => 'حذف الاشعارات',
        ]);

        # admins store
        Route::get('admins/create', [
            'uses' => 'AdminController@create',
            'as' => 'admins.create',
            'title' => ' صفحة اضافة مشرف',
        ]);

        #store
        Route::post('admins/store', [
            'uses' => 'AdminController@store',
            'as' => 'admins.store',
            'title' => 'اضافة مشرف',
        ]);

        # admins update
        Route::get('admins/{id}/edit', [
            'uses' => 'AdminController@edit',
            'as' => 'admins.edit',
            'title' => 'صفحه تحديث مشرف',
        ]);
        #update
        Route::put('admins/{id}', [
            'uses' => 'AdminController@update',
            'as' => 'admins.update',
            'title' => 'تعديل مشرف',
        ]);

        Route::get('admins/{id}/show', [
            'uses' => 'AdminController@show',
            'as' => 'admins.show',
            'title' => 'عرض مشرف',
        ]);

        #delete
        Route::delete('admins/{id}', [
            'uses' => 'AdminController@destroy',
            'as' => 'admins.delete',
            'title' => 'حذف مشرف',
        ]);

        #delete
        Route::post('delete-all-admins', [
            'uses' => 'AdminController@destroyAll',
            'as' => 'admins.deleteAll',
            'title' => 'حذف مجموعه من المشرفين',
        ]);

        /************ #Orders ************/

        Route::get('orders', [
            'as' => 'orders',
            'icon' => '<i class="feather icon-users"></i>',
            'title' => 'الطلبات',
            'type' => 'parent',
            'sub_route' => true,
            'child' => ['orders.current', 'orders.inprogress', 'orders.finished', 'orders.show', 'orders.complete', 'orders.canceled','change.order.status','orders.convert.to.cancellation'],
        ]);


        Route::get('orders-current', [
            'uses' => 'OrderController@orderCurrent',
            'as' => 'orders.current',
            'icon' => '<i class="la la-user"></i>',

            'title' => 'صفحه الطلبات الحاليه',
        ]);

        Route::get('orders-inprogress', [
            'uses' => 'OrderController@orderInProgress',
            'as' => 'orders.inprogress',
            'icon' => '<i class="la la-user"></i>',

            'title' => 'صفحه الطلبات قيد التنفيذ',
        ]);

        Route::get('orders-finished', [
            'uses' => 'OrderController@orderFinished',
            'as' => 'orders.finished',
            'icon' => '<i class="la la-user"></i>',

            'title' => 'صفحه الطلبات المكتمله',
        ]);

        Route::get('orders-complete', [
            'uses' => 'OrderController@orderComplete',
            'as' => 'orders.complete',
            'icon' => '<i class="la la-user"></i>',

            'title' => 'صفحه الطلبات المكتمله من قبل العميل',
        ]);


        Route::get('orders-canceled', [
            'uses' => 'OrderController@ordersCanceled',
            'as' => 'orders.canceled',
            'icon' => '<i class="la la-user"></i>',

            'title' => 'صفحه الطلبات الملغاه',
        ]);



        Route::get('orders/{id}/show', [
            'uses' => 'OrderController@ordersShow',
            'as' => 'orders.show',

            'title' => 'عرض تفاصيل الطلب',
        ]);


        Route::get('change-order-status/{id}/{status}', [
            'uses' => 'OrderController@changeOrderStatus',
            'as' => 'change.order.status',
            'title' => 'تحويل حاله الطلب',
        ]);


        Route::get('convert-order-cancellation', [
            'uses' => 'OrderController@orderCancellation',
            'as' => 'orders.convert.to.cancellation',
            'title' => 'الغاء الطلب',
        ]);

        /************ #End Orders ************/


        /*------------ start Of notifications ----------*/
        Route::get('notifications', [
            'uses' => 'NotificationController@index',
            'as' => 'notifications.index',
            'title' => 'الاشعارات',
            'icon' => '<i class="ficon feather icon-bell"></i>',
            'type' => 'parent',
            'sub_route' => false,
            'child' => ['notifications.send'],
        ]);

        # coupons store
        Route::post('send-notifications', [
            'uses' => 'NotificationController@sendNotifications',
            'as' => 'notifications.send',
            'title' => ' ارسال اشعار او بريد للعميل',
        ]);
        /*------------ end Of notifications ----------*/
//
//    /*------------ start Of countries ----------*/
//    Route::get('countries', [
//      'uses'      => 'CountryController@index',
//      'as'        => 'countries.index',
//      'title'     => 'البلاد',
//      'icon'      => '<i class="feather icon-flag"></i>',
//      'type'      => 'parent',
//      'sub_route' => false,
//      'child'     => ['countries.show', 'countries.create', 'countries.store', 'countries.edit', 'countries.update', 'countries.delete', 'countries.deleteAll'],
//    ]);
//
//    Route::get('countries/{id}/show', [
//      'uses'  => 'CountryController@show',
//      'as'    => 'countries.show',
//      'title' => 'عرض بلد',
//    ]);
//
//    # countries store
//    Route::get('countries/create', [
//      'uses'  => 'CountryController@create',
//      'as'    => 'countries.create',
//      'title' => ' صفحة اضافة بلد',
//    ]);
//
//    # countries store
//    Route::post('countries/store', [
//      'uses'  => 'CountryController@store',
//      'as'    => 'countries.store',
//      'title' => ' اضافة بلد',
//    ]);
//
//    # countries update
//    Route::get('countries/{id}/edit', [
//      'uses'  => 'CountryController@edit',
//      'as'    => 'countries.edit',
//      'title' => 'صفحه تحديث بلد',
//    ]);
//
//    # countries update
//    Route::put('countries/{id}', [
//      'uses'  => 'CountryController@update',
//      'as'    => 'countries.update',
//      'title' => 'تحديث بلد',
//    ]);
//
//    # countries delete
//    Route::delete('countries/{id}', [
//      'uses'  => 'CountryController@destroy',
//      'as'    => 'countries.delete',
//      'title' => 'حذف بلد',
//    ]);
//    #delete all countries
//    Route::post('delete-all-countries', [
//      'uses'  => 'CountryController@destroyAll',
//      'as'    => 'countries.deleteAll',
//      'title' => 'حذف مجموعه من البلاد',
//    ]);
//  /*------------ end Of countries ----------*/
//
//  /*------------ start Of cities ----------*/
//    Route::get('cities', [
//      'uses'      => 'CityController@index',
//      'as'        => 'cities.index',
//      'title'     => 'المدن',
//      'icon'      => '<i class="feather icon-globe"></i>',
//      'type'      => 'parent',
//      'sub_route' => false,
//      'child'     => ['cities.create', 'cities.store', 'cities.edit','cities.show', 'cities.update', 'cities.delete', 'cities.deleteAll'],
//    ]);
//
//    # cities store
//    Route::get('cities/create', [
//      'uses'  => 'CityController@create',
//      'as'    => 'cities.create',
//      'title' => ' صفحة اضافة مدينة',
//    ]);
//
//    # cities store
//    Route::post('cities/store', [
//      'uses'  => 'CityController@store',
//      'as'    => 'cities.store',
//      'title' => ' اضافة مدينة',
//    ]);
//
//    # cities update
//    Route::get('cities/{id}/edit', [
//      'uses'  => 'CityController@edit',
//      'as'    => 'cities.edit',
//      'title' => 'صفحه تحديث مدينة',
//    ]);
//
//    # cities update
//    Route::put('cities/{id}', [
//      'uses'  => 'CityController@update',
//      'as'    => 'cities.update',
//      'title' => 'تحديث مدينة',
//    ]);
//
//    Route::get('cities/{id}/show', [
//      'uses'  => 'CityController@show',
//      'as'    => 'cities.show',
//      'title' => 'عرض مدينة',
//    ]);
//
//    # cities delete
//    Route::delete('cities/{id}', [
//      'uses'  => 'CityController@destroy',
//      'as'    => 'cities.delete',
//      'title' => 'حذف مدينة',
//    ]);
//    #delete all cities
//    Route::post('delete-all-cities', [
//      'uses'  => 'CityController@destroyAll',
//      'as'    => 'cities.deleteAll',
//      'title' => 'حذف مجموعه من المدن',
//    ]);
//  /*------------ end Of cities ----------*/


        /*------------ start Of paper size ----------*/
        Route::get('paper-size', [
            'uses' => 'PaperSizeController@index',
            'as' => 'paper.size.index',
            'title' => 'حجم الورق',
            'icon' => '<i class="feather icon-list"></i>',
            'type' => 'parent',
            'sub_route' => false,
            'child' => ['paper.size.create', 'paper.size.store', 'paper.size.edit', 'paper.size.update', 'paper.size.delete', 'paper.size.deleteAll'],
        ]);


        # paper-size store
        Route::get('paper-size/create/{id?}', [
            'uses' => 'PaperSizeController@create',
            'as' => 'paper.size.create',
            'title' => ' صفحة اضافة حجم الورق',
        ]);

        # paper-size store
        Route::post('paper-size/store', [
            'uses' => 'PaperSizeController@store',
            'as' => 'paper.size.store',
            'title' => ' اضافة حجم الورق',
        ]);

        # paper-size update
        Route::get('paper-size/{id}/edit', [
            'uses' => 'PaperSizeController@edit',
            'as' => 'paper.size.edit',
            'title' => 'صفحه تحديث حجم الورق',
        ]);

        # paper-size update
        Route::put('paper-size/{id}', [
            'uses' => 'PaperSizeController@update',
            'as' => 'paper.size.update',
            'title' => 'تحديث حجم الورق',
        ]);


        # delete paper-size
        Route::delete('paper-size/{id}', [
            'uses' => 'PaperSizeController@destroy',
            'as' => 'paper.size.delete',
            'title' => 'حذف حجم الورق',
        ]);
        #delete all paper-size
        Route::post('delete-all-paper-size', [
            'uses' => 'PaperSizeController@destroyAll',
            'as' => 'paper.size.deleteAll',
            'title' => 'حذف مجموعه من حجم الورق',
        ]);
        /*------------ end Of paper size ----------*/


        /*------------ start Of cover ----------*/
        Route::get('cover', [
            'uses' => 'CoverController@index',
            'as' => 'cover.index',
            'title' => 'الغلاف',
            'icon' => '<i class="feather icon-list"></i>',
            'type' => 'parent',
            'sub_route' => false,
            'child' => ['cover.create', 'cover.show', 'cover.store', 'cover.edit', 'cover.update', 'cover.delete', 'cover.deleteAll'],
        ]);


        Route::get('cover/{id}/show', [
            'uses' => 'CoverController@show',
            'as' => 'cover.show',
            'title' => 'عرض غلاف',
        ]);


        # paper-size store
        Route::get('cover/create/{id?}', [
            'uses' => 'CoverController@create',
            'as' => 'cover.create',
            'title' => ' صفحة اضافة غلاف',
        ]);

        # paper-size store
        Route::post('cover/store', [
            'uses' => 'CoverController@store',
            'as' => 'cover.store',
            'title' => ' اضافة غلاف',
        ]);

        # paper-size update
        Route::get('cover/{id}/edit', [
            'uses' => 'CoverController@edit',
            'as' => 'cover.edit',
            'title' => 'صفحه تحديث الغلاف',
        ]);

        # paper-size update
        Route::put('cover/{id}', [
            'uses' => 'CoverController@update',
            'as' => 'cover.update',
            'title' => 'تحديث الغلاف',
        ]);


        # delete paper-size
        Route::delete('cover/{id}', [
            'uses' => 'CoverController@destroy',
            'as' => 'cover.delete',
            'title' => 'حذف غلاف',
        ]);
        #delete all paper-size
        Route::post('delete-all-cover', [
            'uses' => 'CoverController@destroyAll',
            'as' => 'cover.deleteAll',
            'title' => 'حذف مجموعه الاغلفه',
        ]);
        /*------------ end Of paper size ----------*/


//        /*------------ start Of Frame ----------*/
//        Route::get('frame', [
//            'uses' => 'FrameController@index',
//            'as' => 'frames.index',
//            'title' => __('dashboard.The Frame'),
//            'icon' => '<i class="feather icon-list"></i>',
//            'type' => 'parent',
//            'sub_route' => false,
//            'child' => ['frames.create', 'frames.show', 'frames.store', 'frames.edit', 'frames.update', 'frames.delete', 'frames.deleteAll'],
//        ]);
//
//
//        Route::get('frame/{id}/show', [
//            'uses' => 'FrameController@show',
//            'as' => 'frames.show',
//            'title' => 'عرض اطار',
//        ]);
//        # frame store
//        Route::get('frame/create/{id?}', [
//            'uses' => 'FrameController@create',
//            'as' => 'frames.create',
//            'title' => ' صفحة اضافة اطار',
//        ]);
//
//        # frame store
//        Route::post('frame/store', [
//            'uses' => 'FrameController@store',
//            'as' => 'frames.store',
//            'title' => ' اضافة اطار',
//        ]);
//
//        # frame update
//        Route::get('frame/{id}/edit', [
//            'uses' => 'FrameController@edit',
//            'as' => 'frames.edit',
//            'title' => 'صفحه تحديث اطار',
//        ]);
//
//        # frame update
//        Route::put('frame/{id}', [
//            'uses' => 'FrameController@update',
//            'as' => 'frames.update',
//            'title' => 'تحديث اطار',
//        ]);
//
//
//        # delete frame
//        Route::delete('frame/{id}', [
//            'uses' => 'FrameController@destroy',
//            'as' => 'frames.delete',
//            'title' => 'حذف اطار ',
//        ]);
//        #delete all frame
//        Route::post('delete-all-frame', [
//            'uses' => 'FrameController@destroyAll',
//            'as' => 'frames.deleteAll',
//            'title' => 'حذف مجموعه الاطارات',
//        ]);
//        /*------------ end Of Frame ----------*/


        /*------------ start Of Printing ----------*/
        Route::get('print-type', [
            'uses' => 'PrintController@index',
            'as' => 'print.type.index',
            'title' => 'انواع الطباعه',
            'icon' => '<i class="feather icon-list"></i>',
            'type' => 'parent',
            'sub_route' => false,
            'child' => ['print.type.create', 'print.type.show', 'print.type.store', 'print.type.edit', 'print.type.update', 'print.type.delete', 'print.type.deleteAll'],
        ]);


        Route::get('print-type/{id}/show', [
            'uses' => 'PrintController@show',
            'as' => 'print.type.show',
            'title' => 'عرض نوع طباعه',
        ]);
        # frame store
        Route::get('print-type/create/{id?}', [
            'uses' => 'PrintController@create',
            'as' => 'print.type.create',
            'title' => ' صفحة اضافة نوع طباعه',
        ]);

        # frame store
        Route::post('print-type/store', [
            'uses' => 'PrintController@store',
            'as' => 'print.type.store',
            'title' => ' اضافة نوع طباعه',
        ]);

        # frame update
        Route::get('print-type/{id}/edit', [
            'uses' => 'PrintController@edit',
            'as' => 'print.type.edit',
            'title' => 'صفحه تحديث نوع طباعه',
        ]);

        # frame update
        Route::put('print-type/{id}', [
            'uses' => 'PrintController@update',
            'as' => 'print.type.update',
            'title' => 'تحديث نوع طباعه',
        ]);


        # delete frame
        Route::delete('print-type/{id}', [
            'uses' => 'PrintController@destroy',
            'as' => 'print.type.delete',
            'title' => 'حذف نوع طباعه ',
        ]);
        #delete all frame
        Route::post('delete-all-print-type', [
            'uses' => 'PrintController@destroyAll',
            'as' => 'print.type.deleteAll',
            'title' => 'حذف مجموعه انواع الطباعه',
        ]);
        /*------------ end Of Printing ----------*/


//        /*------------ Start Education Level ----------*/
        Route::get('education-level', [
            'uses' => 'EducationLevelController@index',
            'as' => 'education.level.index',
            'title' => 'المرحله الدراسيه',
            'icon' => '<i class="feather icon-list"></i>',
            'type' => 'parent',
            'sub_route' => false,
            'child' => [
//                'education.level.create',
                'education.level.show',
//                'education.level.store',
                'education.level.edit',
                'education.level.update',
//                'education.level.delete', 'education.level.deleteAll'
            ],
        ]);


        Route::get('education-level/{id}/show', [
            'uses' => 'EducationLevelController@show',
            'as' => 'education.level.show',
            'title' => 'عرض المرحله الدراسيه',
        ]);
        # Education Level store
//        Route::get('education-level/create/{id?}', [
//            'uses' => 'EducationLevelController@create',
//            'as' => 'education.level.create',
//            'title' => ' صفحة اضافة المرحله الدراسيه',
//        ]);
//
//        # Education Level store
//        Route::post('education-level/store', [
//            'uses' => 'EducationLevelController@store',
//            'as' => 'education.level.store',
//            'title' => ' اضافة المرحله الدراسيه',
//        ]);

        # Education Level update
        Route::get('education-level/{id}/edit', [
            'uses' => 'EducationLevelController@edit',
            'as' => 'education.level.edit',
            'title' => 'صفحه تحديث المرحله الدراسيه',
        ]);

        # Education Level update
        Route::put('education-level/{id}', [
            'uses' => 'EducationLevelController@update',
            'as' => 'education.level.update',
            'title' => 'تحديث المرحله الدراسيه',
        ]);


        # delete Education Level
//        Route::delete('education-level/{id}', [
//            'uses' => 'EducationLevelController@destroy',
//            'as' => 'education.level.delete',
//            'title' => 'حذف المرحله الدراسيه ',
//        ]);
//        #delete all Education Level
//        Route::post('delete-all-education-level', [
//            'uses' => 'EducationLevelController@destroyAll',
//            'as' => 'education.level.deleteAll',
//            'title' => 'حذف مجموعه مراحل دراسيه',
//        ]);
        /*------------ end Of Education Level ----------*/


//        /*------------ start Of categories ----------*/
//        Route::get('categories-show/{id?}', [
//            'uses' => 'CategoryController@index',
//            'as' => 'categories.index',
//            'title' => 'الاقسام',
//            'icon' => '<i class="feather icon-list"></i>',
//            'type' => 'parent',
//            'sub_route' => false,
//            'child' => ['categories.create', 'categories.store', 'categories.edit', 'categories.update', 'categories.delete', 'categories.deleteAll', 'categories.show'],
//        ]);
//
//        # categories store
//        Route::get('categories/create/{id?}', [
//            'uses' => 'CategoryController@create',
//            'as' => 'categories.create',
//            'title' => ' صفحة اضافة قسم',
//        ]);
//
//        # categories store
//        Route::post('categories/store', [
//            'uses' => 'CategoryController@store',
//            'as' => 'categories.store',
//            'title' => ' اضافة قسم',
//        ]);
//
//        # categories update
//        Route::get('categories/{id}/edit', [
//            'uses' => 'CategoryController@edit',
//            'as' => 'categories.edit',
//            'title' => 'صفحه تحديث قسم',
//        ]);
//
//        # categories update
//        Route::put('categories/{id}', [
//            'uses' => 'CategoryController@update',
//            'as' => 'categories.update',
//            'title' => 'تحديث قسم',
//        ]);
//
//        Route::get('categories/{id}/show', [
//            'uses' => 'CategoryController@show',
//            'as' => 'categories.show',
//            'title' => 'عرض قسم',
//        ]);
//
//        # categories delete
//        Route::delete('categories/{id}', [
//            'uses' => 'CategoryController@destroy',
//            'as' => 'categories.delete',
//            'title' => 'حذف قسم',
//        ]);
//        #delete all categories
//        Route::post('delete-all-categories', [
//            'uses' => 'CategoryController@destroyAll',
//            'as' => 'categories.deleteAll',
//            'title' => 'حذف مجموعه من الاقسام',
//        ]);
//        /*------------ end Of categories ----------*/

//  /*------------ start Of coupons ----------*/
//    Route::get('coupons', [
//      'uses'      => 'CouponController@index',
//      'as'        => 'coupons.index',
//      'title'     => 'كوبونات الخصم',
//      'icon'      => '<i class="fa fa-gift"></i>',
//      'type'      => 'parent',
//      'sub_route' => false,
//      'child'     => ['coupons.show', 'coupons.create', 'coupons.store', 'coupons.edit', 'coupons.update', 'coupons.delete', 'coupons.deleteAll', 'coupons.renew'],
//    ]);
//
//    Route::get('coupons/{id}/show', [
//      'uses'  => 'CouponController@show',
//      'as'    => 'coupons.show',
//      'title' => 'عرض  كوبون خصم',
//    ]);
//
//    # coupons store
//    Route::get('coupons/create', [
//      'uses'  => 'CouponController@create',
//      'as'    => 'coupons.create',
//      'title' => ' صفحة اضافة كوبون خصم',
//    ]);
//
//    # coupons store
//    Route::post('coupons/store', [
//      'uses'  => 'CouponController@store',
//      'as'    => 'coupons.store',
//      'title' => ' اضافة كوبون خصم',
//    ]);
//
//    # coupons update
//    Route::get('coupons/{id}/edit', [
//      'uses'  => 'CouponController@edit',
//      'as'    => 'coupons.edit',
//      'title' => 'صفحه تحديث كوبون خصم',
//    ]);
//
//    # coupons update
//    Route::put('coupons/{id}', [
//      'uses'  => 'CouponController@update',
//      'as'    => 'coupons.update',
//      'title' => 'تحديث كوبون خصم',
//    ]);
//
//    # renew coupon
//    Route::post('coupons/renew', [
//      'uses'  => 'CouponController@renew',
//      'as'    => 'coupons.renew',
//      'title' => 'تحديث حالة كوبون خصم',
//    ]);
//
//    # coupons delete
//    Route::delete('coupons/{id}', [
//      'uses'  => 'CouponController@destroy',
//      'as'    => 'coupons.delete',
//      'title' => 'حذف كوبون خصم',
//    ]);
//    #delete all coupons
//    Route::post('delete-all-coupons', [
//      'uses'  => 'CouponController@destroyAll',
//      'as'    => 'coupons.deleteAll',
//      'title' => 'حذف مجموعه من كوبونات الخصم',
//    ]);
//  /*------------ end Of coupons ----------*/

        /*------------ start Of intros ----------*/
        Route::get('intros', [
            'uses' => 'IntroController@index',
            'as' => 'intros.index',
            'title' => 'الصفحات التعريفية',
            'icon' => '<i class="feather icon-loader"></i>',
            'type' => 'parent',
            'sub_route' => false,
            'child' => ['intros.show', 'intros.create', 'intros.store', 'intros.edit', 'intros.update', 'intros.delete', 'intros.deleteAll'],
        ]);

        # intros update
        Route::get('intros/{id}/Show', [
            'uses' => 'IntroController@show',
            'as' => 'intros.show',
            'title' => 'صفحه عرض صفحة تعريفية ',
        ]);

        # intros store
        Route::get('intros/create', [
            'uses' => 'IntroController@create',
            'as' => 'intros.create',
            'title' => ' صفحة اضافة صفحة تعريفية',
        ]);

        # intros store
        Route::post('intros/store', [
            'uses' => 'IntroController@store',
            'as' => 'intros.store',
            'title' => ' اضافة صفحة تعريفية',
        ]);

        # intros update
        Route::get('intros/{id}/edit', [
            'uses' => 'IntroController@edit',
            'as' => 'intros.edit',
            'title' => 'صفحه تحديث صفحة تعريفية',
        ]);

        # intros update
        Route::put('intros/{id}', [
            'uses' => 'IntroController@update',
            'as' => 'intros.update',
            'title' => 'تحديث صفحة تعريفية',
        ]);

        # intros delete
        Route::delete('intros/{id}', [
            'uses' => 'IntroController@destroy',
            'as' => 'intros.delete',
            'title' => 'حذف صفحة تعريفية',
        ]);
        #delete all intros
        Route::post('delete-all-intros', [
            'uses' => 'IntroController@destroyAll',
            'as' => 'intros.deleteAll',
            'title' => 'حذف مجموعه من الصفحات التعريفية',
        ]);
        /*------------ end Of intros ----------*/

        /*------------ start Of images ----------*/
        Route::get('images', [
            'uses' => 'ImageController@index',
            'as' => 'images.index',
            'title' => 'البنرات الاعلانية',
            'icon' => '<i class="feather icon-image"></i>',
            'type' => 'parent',
            'sub_route' => false,
            'child' => ['images.show', 'images.create', 'images.store', 'images.edit', 'images.update', 'images.delete', 'images.deleteAll'],
        ]);
        Route::get('images/{id}/show', [
            'uses' => 'ImageController@show',
            'as' => 'images.show',
            'title' => 'عرض   بانر اعلاني',
        ]);
        # images store
        Route::get('images/create', [
            'uses' => 'ImageController@create',
            'as' => 'images.create',
            'title' => ' صفحة اضافة بانر اعلاني',
        ]);

        # images store
        Route::post('images/store', [
            'uses' => 'ImageController@store',
            'as' => 'images.store',
            'title' => ' اضافة بانر اعلاني',
        ]);

        # images update
        Route::get('images/{id}/edit', [
            'uses' => 'ImageController@edit',
            'as' => 'images.edit',
            'title' => 'صفحه تحديث بانر اعلاني',
        ]);

        # images update
        Route::put('images/{id}', [
            'uses' => 'ImageController@update',
            'as' => 'images.update',
            'title' => 'تحديث بانر اعلاني',
        ]);

        # images delete
        Route::delete('images/{id}', [
            'uses' => 'ImageController@destroy',
            'as' => 'images.delete',
            'title' => 'حذف بانر اعلاني',
        ]);
        #delete all images
        Route::post('delete-all-images', [
            'uses' => 'ImageController@destroyAll',
            'as' => 'images.deleteAll',
            'title' => 'حذف مجموعه من البنرات الاعلانية',
        ]);
        /*------------ end Of images ----------*/

        /*------------ start Of socials ----------*/
        Route::get('socials', [
            'uses' => 'SocialController@index',
            'as' => 'socials.index',
            'title' => 'وسائل التواصل',
            'icon' => '<i class="feather icon-message-circle"></i>',
            'type' => 'parent',
            'sub_route' => false,
            'child' => ['socials.show', 'socials.create', 'socials.store', 'socials.show', 'socials.update', 'socials.edit', 'socials.delete', 'socials.deleteAll'],
        ]);
        # socials update
        Route::get('socials/{id}/Show', [
            'uses' => 'SocialController@show',
            'as' => 'socials.show',
            'title' => 'صفحه عرض وسيلة تواصل  ',
        ]);
        # socials store
        Route::get('socials/create', [
            'uses' => 'SocialController@create',
            'as' => 'socials.create',
            'title' => ' صفحة اضافة تواصل',
        ]);

        # socials store
        Route::post('socials', [
            'uses' => 'SocialController@store',
            'as' => 'socials.store',
            'title' => ' اضافة تواصل',
        ]);

        # socials update
        Route::get('socials/{id}', [
            'uses' => 'SocialController@show',
            'as' => 'socials.show',
            'title' => 'صفحه عرض تواصل',
        ]);
        # socials update
        Route::get('socials/{id}/edit', [
            'uses' => 'SocialController@edit',
            'as' => 'socials.edit',
            'title' => 'صفحه تحديث تواصل',
        ]);
        # socials update
        Route::put('socials/{id}', [
            'uses' => 'SocialController@update',
            'as' => 'socials.update',
            'title' => 'تحديث تواصل',
        ]);

        # socials delete
        Route::delete('socials/{id}', [
            'uses' => 'SocialController@destroy',
            'as' => 'socials.delete',
            'title' => 'حذف تواصل',
        ]);

        #delete all socials
        Route::post('delete-all-socials', [
            'uses' => 'SocialController@destroyAll',
            'as' => 'socials.deleteAll',
            'title' => 'حذف مجموعه من وسائل التواصل',
        ]);
        /*------------ end Of socials ----------*/

        /*------------ start Of complaints ----------*/
        Route::get('all-complaints', [
            'as' => 'all_complaints',
            'uses' => 'ComplaintController@index',
            'icon' => '<i class="feather icon-mail"></i>',
            'title' => 'الشكاوي والمقترحات',
            'type' => 'parent',
            'sub_route' => false,
            'child' => [
                'complaints.delete', 'complaints.deleteAll', 'complaints.show', 'complaint.replay',
            ],
        ]);

        # complaint replay
        Route::post('complaints-replay/{id}', [
            'uses' => 'ComplaintController@replay',
            'as' => 'complaint.replay',
            'title' => 'رد علي شكوي او مقترح',
        ]);
        # socials update
        Route::get('complaints/{id}', [
            'uses' => 'ComplaintController@show',
            'as' => 'complaints.show',
            'title' => 'صفحه عرض شكوي',
        ]);
        # complaints delete
        Route::delete('complaints/{id}', [
            'uses' => 'ComplaintController@destroy',
            'as' => 'complaints.delete',
            'title' => 'حذف شكوي',
        ]);

        #delete all complaints
        Route::post('delete-all-complaints', [
            'uses' => 'ComplaintController@destroyAll',
            'as' => 'complaints.deleteAll',
            'title' => 'حذف مجموعه من الشكاوي',
        ]);
        /*------------ end Of complaints ----------*/


        /*------------ start Of messages ----------*/
        Route::get('all-messages', [
            'as' => 'all.messages',
            'uses' => 'MessageController@index',
            'icon' => '<i class="feather icon-mail"></i>',
            'title' => 'الرسائل',
            'type' => 'parent',
            'sub_route' => false,
            'child' => [
                'messages.delete', 'messages.deleteAll', 'message.show',
            ],
        ]);


        # messages update
        Route::get('messages/{id}', [
            'uses' => 'MessageController@show',
            'as' => 'message.show',
            'title' => 'صفحه عرض رساله',
        ]);
        # messages delete
        Route::delete('messages/{id}', [
            'uses' => 'MessageController@destroy',
            'as' => 'messages.delete',
            'title' => 'حذف رساله',
        ]);

        #delete all messages
        Route::post('messages-complaints', [
            'uses' => 'MessageController@destroyAll',
            'as' => 'messages.deleteAll',
            'title' => 'حذف مجموعه من الرسائل',
        ]);
        /*------------ end Of complaints ----------*/


        /*------------ start Of fqs ----------*/
        Route::get('fqs', [
            'uses' => 'FqsController@index',
            'as' => 'fqs.index',
            'title' => 'الاسئلة الشائعة',
            'icon' => '<i class="feather icon-alert-circle"></i>',
            'type' => 'parent',
            'sub_route' => false,
            'child' => ['fqs.show', 'fqs.create', 'fqs.store', 'fqs.edit', 'fqs.update', 'fqs.delete', 'fqs.deleteAll'],
        ]);

        Route::get('fqs/{id}/show', [
            'uses' => 'FqsController@show',
            'as' => 'fqs.show',
            'title' => 'عرض  سؤال',
        ]);

        # fqs store
        Route::get('fqs/create', [
            'uses' => 'FqsController@create',
            'as' => 'fqs.create',
            'title' => ' صفحة اضافة سؤال',
        ]);

        # fqs store
        Route::post('fqs/store', [
            'uses' => 'FqsController@store',
            'as' => 'fqs.store',
            'title' => ' اضافة سؤال',
        ]);

        # fqs update
        Route::get('fqs/{id}/edit', [
            'uses' => 'FqsController@edit',
            'as' => 'fqs.edit',
            'title' => 'صفحه تحديث سؤال',
        ]);

        # fqs update
        Route::put('fqs/{id}', [
            'uses' => 'FqsController@update',
            'as' => 'fqs.update',
            'title' => 'تحديث سؤال',
        ]);

        # fqs delete
        Route::delete('fqs/{id}', [
            'uses' => 'FqsController@destroy',
            'as' => 'fqs.delete',
            'title' => 'حذف سؤال',
        ]);
        #delete all fqs
        Route::post('delete-all-fqs', [
            'uses' => 'FqsController@destroyAll',
            'as' => 'fqs.deleteAll',
            'title' => 'حذف مجموعه من الاسئلة الشائعة',
        ]);
        /*------------ end Of fqs ----------*/

//  /*------------ start Of seos ----------*/
//    Route::get('seos', [
//      'uses'  => 'SeoController@index',
//      'as'    => 'seos.index',
//      'title' => 'سيو',
//      'icon'  => '<i class="feather icon-list"></i>',
//      'type'  => 'parent',
//      'child' => [
//        'seos.show','seos.create','seos.edit',  'seos.index', 'seos.store', 'seos.update', 'seos.delete', 'seos.deleteAll',
//      ],
//    ]);
//    # seos update
//    Route::get('seos/{id}/Show', [
//      'uses'  => 'SeoController@show',
//      'as'    => 'seos.show',
//      'title' => 'صفحه عرض سيو  ',
//    ]);
//
//    # seos store
//    Route::get('seos/create', [
//      'uses'  => 'SeoController@create',
//      'as'    => 'seos.create',
//      'title' => ' صفحة اضافة سيو',
//    ]);
//
//    # seos update
//    Route::get('seos/{id}/edit', [
//      'uses'  => 'SeoController@edit',
//      'as'    => 'seos.edit',
//      'title' => 'صفحه تحديث سيو',
//    ]);
//
//    #store
//    Route::post('seos/store', [
//      'uses'  => 'SeoController@store',
//      'as'    => 'seos.store',
//      'title' => ' اضافة سيو',
//    ]);
//
//    #update
//    Route::put('seos/{id}', [
//      'uses'  => 'SeoController@update',
//      'as'    => 'seos.update',
//      'title' => 'تحديث سيو',
//    ]);
//
//    #deletّe
//    Route::delete('seos/{id}', [
//      'uses'  => 'SeoController@destroy',
//      'as'    => 'seos.delete',
//      'title' => 'حذف سيو',
//    ]);
//    #delete
//    Route::post('delete-all-seos', [
//      'uses'  => 'SeoController@destroyAll',
//      'as'    => 'seos.deleteAll',
//      'title' => 'حذف مجموعه من السيو',
//    ]);
        /*------------ end Of seos ----------*/

        /*------------ start Of sms ----------*/
        Route::get('sms', [
            'uses' => 'SMSController@index',
            'as' => 'sms.index',
            'title' => 'باقات الرسائل',
            'icon' => '<i class="feather icon-smartphone"></i>',
            'type' => 'parent',
            'sub_route' => false,
            'child' => ['sms.update', 'sms.change'],
        ]);
        # sms change
        Route::post('sms-change', [
            'uses' => 'SMSController@change',
            'as' => 'sms.change',
            'title' => 'تحديث نوع باقه الرسائل',
        ]);
        # sms update
        Route::put('sms/{id}', [
            'uses' => 'SMSController@update',
            'as' => 'sms.update',
            'title' => 'تحديث باقه رسائل',
        ]);

        /*------------ end Of sms ----------*/

        /*------------ start Of statistics ----------*/
        Route::get('statistics', [
            'uses' => 'StatisticsController@index',
            'as' => 'statistics.index',
            'title' => 'الاحصائيات',
            'icon' => '<i class="feather icon-activity"></i>',
            'type' => 'parent',
            'child' => [
                'statistics.index',
            ],
        ]);
        /*------------ end Of statistics ----------*/

        /*------------ start Of reports----------*/
        Route::get('reports', [
            'uses' => 'ReportController@index',
            'as' => 'reports',
            'icon' => '<i class="feather icon-edit-2"></i>',
            'title' => 'التقارير',
            'type' => 'parent',
            'sub_route' => false,
            'child' => ['reports.delete', 'reports.deleteAll', 'reports.show'],
        ]);

        # reports show
        Route::get('reports/{id}', [
            'uses' => 'ReportController@show',
            'as' => 'reports.show',
            'title' => 'عرض تقرير',
        ]);
        # reports delete
        Route::delete('reports/{id}', [
            'uses' => 'ReportController@destroy',
            'as' => 'reports.delete',
            'title' => 'حذف تقرير',
        ]);

        #delete all reports
        Route::post('delete-all-reports', [
            'uses' => 'ReportController@destroyAll',
            'as' => 'reports.deleteAll',
            'title' => 'حذف مجموعه من التقارير',
        ]);
        /*------------ end Of reports ----------*/

        /*------------ start Of Roles----------*/
        Route::get('roles', [
            'uses' => 'RoleController@index',
            'as' => 'roles.index',
            'title' => 'قائمة الصلاحيات',
            'icon' => '<i class="feather icon-eye"></i>',
            'type' => 'parent',
            'child' => [
                'roles.index', 'roles.create', 'roles.store', 'roles.edit', 'roles.update', 'roles.delete',
            ],
        ]);

        #add role page
        Route::get('roles/create', [
            'uses' => 'RoleController@create',
            'as' => 'roles.create',
            'title' => 'اضافة صلاحيه',

        ]);

        #store role
        Route::post('roles/store', [
            'uses' => 'RoleController@store',
            'as' => 'roles.store',
            'title' => 'تمكين اضافة صلاحيه',
        ]);

        #edit role page
        Route::get('roles/{id}/edit', [
            'uses' => 'RoleController@edit',
            'as' => 'roles.edit',
            'title' => 'تعديل صلاحيه',
        ]);

        #update role
        Route::put('roles/{id}', [
            'uses' => 'RoleController@update',
            'as' => 'roles.update',
            'title' => 'تمكين تعديل صلاحيه',
        ]);

        #delete role
        Route::delete('roles/{id}', [
            'uses' => 'RoleController@destroy',
            'as' => 'roles.delete',
            'title' => 'حذف صلاحيه',
        ]);
        /*------------ end Of Roles----------*/

        /*------------ start Of Settings----------*/
        Route::get('settings', [
            'uses' => 'SettingController@index',
            'as' => 'settings.index',
            'title' => 'الاعدادات',
            'icon' => '<i class="feather icon-settings"></i>',
            'type' => 'parent',
            'child' => [
                'settings.index', 'settings.update', 'settings.message.all', 'settings.message.one', 'settings.send_email',
            ],
        ]);

        #update
        Route::put('settings', [
            'uses' => 'SettingController@update',
            'as' => 'settings.update',
            'title' => 'تحديث الاعدادات',
        ]);

        #message all
        Route::post('settings/{type}/message-all', [
            'uses' => 'SettingController@messageAll',
            'as' => 'settings.message.all',
            'title' => 'مراسلة الجميع',
        ])->where('type', 'email|sms|notification');

        #message one
        Route::post('settings/{type}/message-one', [
            'uses' => 'SettingController@messageOne',
            'as' => 'settings.message.one',
            'title' => 'مراسلة مستخدم',
        ])->where('type', 'email|sms|notification');

        #send email
        Route::post('settings/send-email', [
            'uses' => 'SettingController@sendEmail',
            'as' => 'settings.send_email',
            'title' => 'ارسال ايميل',
        ]);
        /*------------ end Of Settings ----------*/


        #new_routes_here

    });

});

Route::get('view-cover/{id}', 'Admin\CoverController@viewCover');