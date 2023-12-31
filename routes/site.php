<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['web', 'HtmlMinifier']], function () {

  Route::get('/', 'IntroController@index')->name('intro');
  Route::post('/send-message', 'IntroController@sendMessage');
  Route::get('/lang/{lang}', 'IntroController@SetLanguage');
  // guest routes
  Route::group(['middleware' => ['guest']], function () {

  });
  // guest routes

  // auth  routes
  Route::group(['middleware' => ['auth']], function () {

  });
  // auth  routes

});
