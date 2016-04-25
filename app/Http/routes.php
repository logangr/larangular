<?php


Route::get('/', function () {
    return view('UserManagement');
});

Route::get('/user', 'UserRestController@listAllUsers');
Route::get('/user/{id}', 'UserRestController@getUser');
Route::get('/user/getMunicipis', 'UserRestController@getAllMunicipis');
