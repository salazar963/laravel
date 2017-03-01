<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*

Route::get('prueba', function(){
	return "Hola probando"; 
}); // Sin parametros

Route::get('nombre/{nombre}', function($nombre){
	return "Mi nombre es " . $nombre ;
}); // Con parametros


Route::get('nombre/{nombre?}', function($nombre = 'Luis'){
	return "Mi nombre es " . $nombre ;
}); // Con parametro opcionales

Route::get('controlador', 'PruebaController@index');



Route::resource('controlador', 'PruebaController');

Route::resource('libro', 'LibroController');

*/

Route::get('libros', "LibroController@index");
Route::get('libros/{id}', "LibroController@show");
Route::post('libros', "LibroController@store");
Route::put('libros/{id}', "LibroController@update");
Route::delete('libros/{id}', "LibroController@destroy");

Route::get('/', function () {
    return view('welcome');
});
