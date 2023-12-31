<?php

namespace App\Http\Controllers\Api;

use App\Models\Shop;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    protected $shop;
    public function __construct(Shop $shop)
    {
        $this->shop = $shop;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $getShop = $this->shop->getAllShop();
        return response()->json($getShop);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = [
            'name' => $request['name'],
            'phone' => $request['phone'],
            'email' => $request['email'],
            'address' => $request['address'],
            'country' => $request['country'],
            'state' => $request['state'],
            'city' => $request['city'],
            'is_primary' => $request['is_primary'],
            'is_shipping_location' => $request['is_shipping_location'],
        ];

        $shopInsert = $this->shop->insertShop($data);
        return response()->json([
            'status'=>'ok',
            'massage'=> 'Shop created successfuly',
            'product'=> $shopInsert
       ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $getShop = $this->shop->getShopId($id);
        return response()->json($getShop);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $shopUpdate = $this->shop->updateShop($request['id'], $request);
        
        return response()->json([
            'status'=>'ok',
            'massage'=> 'Shop updated successfuly',
            'product'=> $shopUpdate
       ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->shop->deleteBrand($id);
        return response()->json([
            'status' => 'ok',
            'message' => 'product deleted successfuly'
      ]);
    }
}
