<?php



Route::get('/', function () {
    return view('layouts/principal');
});


//rutas alimentos
Route::get('/alimentos', 'FoodController@index');
Route::post('/alimentos/guardar', 'FoodController@store');
Route::put('/alimentos/actualizar', 'FoodController@update');
Route::post('/alimentos/{id}', 'FoodController@destroy');