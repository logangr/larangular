<?php


Route::get('/', function () {
    return view('UserManagement');
});

Route::get('/api/users/{id?}', 'UserRestController@index');
Route::post('/api/users', 'UserRestController@store');
Route::post('/api/users/{id}', 'UserRestController@update');
Route::delete('/api/users/{id}', 'UserRestController@destroy');