<?php


Route::get('/', function () {
    return view('UserManagement');
});

Route::get('/user', 'UserRestController@listAllUsers');
Route::post('/user', 'UserRestController@createUser');
Route::get('/user/getMunicipis', 'UserRestController@getAllMunicipis');
Route::get('/user/{id}', 'UserRestController@getUser');
Route::put('/user/{id}', 'UserRestController@updateUser');
Route::delete('/user/{id}', 'UserRestController@deleteUser');

