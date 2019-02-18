<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Producto;

class HomeController extends Controller
{
    //
    public function __construct()
    {
     !(\Session::has("cart")) ?? \Session::put("cart", array());
    }

    function getIndex()
    {
      $productos = Producto::all();

      return view('index', array('productos' => $productos));
    }

    public function getShow()
    {
      $cart = \Session::get('cart');
      $total = $this->total();
      return view('cart', compact('cart','total'));
    }

    public function add(Producto $product)
    {
      $cart = \Session::get('cart');
      $product->quantity = 1;
      $cart[$product->id] = $product;
      \Session::put('cart', $cart);

      return redirect()->route('cart-show');
    }

    public function delete(Producto $product)
    {
      $cart = \Session::get('cart');
      unset($cart[$product->id]);
      \Session::put('cart', $cart);

      return redirect()->route('cart-show');
    }

    public function trash()
    {
      // code...
      \Session::forget('cart');
      return redirect()->route('cart-show');
    }

    public function update(Producto $product,Request $request)
    {
        $cart = \Session::get('cart');
        $cantidad = $request->input("p_".$product->id);
        $cart[$product->id]->quantity = $cantidad;
        \Session::put('cart', $cart);

        return redirect()->route('cart-show');
    }
    public function total()
    {
      $cart = \Session::get('cart');
      $total = 0;
      foreach ($cart as $item) {
        $total+= $item->price * $item->quantity;
      }

      return $total;
    }


    public function postValidar(Request $request)
    {
      request()->validate([
        'nombre' => 'required',
        'correo' => ['required', 'email'],
        'imagen' => 'required',
        'fecha'  => 'required'
      ], [
        'nombre.required'=>__('I need your name')
      ]);
      $msg = "Todo en orden";

      return view('validar', array( 'msg'=>$msg ));

    }

    public function postCambiar(Request $request)
    {
          $this->validate($request, [
		        'lan' => 'required'
    	    ]);
          App::setLocale($request->input("lan"));
          return redirect('validar')
          ->withCookie(cookie('lang', $request->input('lan'), 60 * 24 * 365));
    }

}
