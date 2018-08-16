<?php

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

Route::view('/', 'welcome');

Route::name('admin.')->prefix('admin')->middleware('auth')->group(function () {  
    Route::get('/', 'AdminController@index');
    Route::get('dashboard', 'AdminController@index')->name('dashboard');
    Route::get('home', 'AdminController@index')->name('home');
    Route::get('index', 'AdminController@index')->name('index');
});

Route::name('admin.')->prefix('admin')->middleware('is_admin')->group(function () {  
    Route::resource('usuarios', 'AdminUsersController');
    Route::resource('caixas', 'AdminCaixasController');
    Route::resource('campos', 'AdminCamposController');
    Route::resource('tipos', 'AdminTiposController');
    Route::resource('configuracoes', 'AdminConfiguracoesController');

    Route::name('relatorios.')->prefix('relatorios')->group(function () {
        Route::get('administrativo','AdminRelatoriosController@reportAdmin')->name('adm');
        Route::get('financeiro','AdminRelatoriosController@reportFinancial')->name('fin');
        Route::post('emitir','AdminRelatoriosController@send')->name('emitir');
    });
});

Auth::routes();