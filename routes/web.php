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
    Route::resource('campos', 'AdminCamposController');
    Route::resource('tipos', 'AdminTiposController');

    Route::get('caixas/extrato', 'AdminCaixasController@extrato');
    Route::post('caixas/fechar/{id}', 'AdminCaixasController@fechar');
    Route::resource('caixas', 'AdminCaixasController');

    Route::post('movimentacao/entrada', 'AdminMovimentacaoController@entrada');
    Route::post('movimentacao/saida', 'AdminMovimentacaoController@saida');

    Route::name('relatorios.')->prefix('relatorios')->group(function () {
        Route::get('administrativo','AdminRelatoriosController@reportAdmin')->name('adm');
        Route::get('financeiro','AdminRelatoriosController@reportFinancial')->name('fin');
        Route::post('emitir','AdminRelatoriosController@send')->name('emitir');
    });

    Route::name('configuracoes.')->prefix('configuracoes')->group(function () {
        Route::get('','AdminConfiguracoesController@index')->name('editar');
        Route::post('','AdminConfiguracoesController@save')->name('salvar');
    });
});

Route::get('/logout', 'Auth\LoginController@logout')->name('logout');
Auth::routes();