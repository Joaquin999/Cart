<?php
use Illuminate\Http\Request;
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
/*
Route::get('/', function () {
    return view('welcome');
});
*/
Route::get('/',
array('as'=>'home','uses'=> 'HomeController@getIndex'));

Route::bind('producto', function($id){
  return App\Producto::where('id', $id)->first();
});


//Carrito
Route::get('cart/add/{producto}',
array('as'=>'cart-add','uses'=> 'HomeController@add'));

Route::get('/cart/show',
array('as'=>'cart-show','uses'=> 'HomeController@getShow'));

Route::get('/cart/delete/{producto}',
array('as'=>'cart-delete','uses'=>'HomeController@delete'));

Route::get('cart/trash',
 ['as'=>'cart-trash', 'uses'=>'HomeController@trash']);

Route::post('cart/update/{producto}',
['as'=>'cart-update', 'uses'=>'HomeController@update']);

//Validación
Route::get('validar', function(Request $request){
  $valor = $request->cookie('lang');
  App::setLocale($valor);
  return view ('validar');
});


Route::post('validar', 'HomeController@postValidar');

App::setLocale("en");

Route::post('cambiar', function(Request $request){
  request()->validate([
    'lan' => 'required'
  ]);
  $lenguaje = $request->input("lan");
  App::setLocale("en");
  return redirect('validar')
  ->withCookie(cookie('lang', $request->input('lan'), 60 * 24 * 365));
});
