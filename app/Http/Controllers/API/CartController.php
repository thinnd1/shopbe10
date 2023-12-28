<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;

class CartController extends Controller
{
    protected $cart;

    public function __construct(Cart $cart)
    {
        $this->cart = $cart;
    }
    public function index()
    {
      $cart = $this->cart->getCart();
      return response()->json($product);
    }

    public function store(Request $request)
    {
        $data = [
            'user_id' => $request['user_id'],
            'product_id' => $request['product_id'],
            'price_unit' => $request['price_unit'],
            'quantity' => $request['quantity'],
        ];

        $shopInsert = $this->shop->insertShop($data);
        return response()->json([
            'status'=>'ok',
            'massage'=> 'Shop created successfuly',
            'product'=> $shopInsert
       ]);
    }

    public function update(Request $request)
    {
        $cartUpdate = $this->shop->updateShop($request['id'], $request);
        
        return response()->json([
            'status'=>'ok',
            'massage'=> 'Cart updated successfuly',
            'product'=> $cartUpdate
       ]);
    }
    
}
