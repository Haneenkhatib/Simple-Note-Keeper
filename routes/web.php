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
Route::group(['middleware'=>'auth'],function (){

    Route::get('/contact','ContactController@create');
    Route::post('/contact','ContactController@store')->name('contact.store');
Route::resource('/notes','NoteController');
Route::post('notes/update', 'NoteController@update')->name('notes.update');

Route::get('notes/destroy/{id}', 'NoteController@destroy');

Route::get('import-export', 'ExcelController@importExport');
Route::post('import', 'ExcelController@import');
    Route::get('pdf', 'NoteController@pdf')->name('pdf');
    Route::get('/export_excel/excel', 'ExcelController@export')->name('export_excel.excel');
});

Route::get('/auth/redirect/{provider}', 'SocialController@redirect');
Route::get('/callback/{provider}', 'SocialController@callback');




Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

Route::get('/test', 'NoteController@test')->name('test');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
