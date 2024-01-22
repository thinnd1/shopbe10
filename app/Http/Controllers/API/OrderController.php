<?php

namespace App\Http\Controllers\API;

use App\Models\Order;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    protected $order;
    protected $cart;

    public function __construct(Order $order, Cart $cart)
    {
        $this->order = $order;
        $this->cart = $cart;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($shopId)
    {
        $getOrder = $this->order->getAllOrder($shopId);
        return response()->json($getOrder);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cart = $this->cart->getCart();
        foreach($cart as $item) {
            $data = [
                'user_id' => $request['user_id'],
                'product_id' => $item->product_id,
                'shop_id' => $item->shop_id,
                'amount' => $item->soluong, // số lượng
                'price' => ($item->gia * $item->soluong), // gia
                'description' => '',
                'is_finished' => 1, // 1 : chưa, 2: đã giao xong
            ];
            $order = $this->order->insertOrder($data);
            DB::table('cart')->delete($item->cart_id);
        }

        return response()->json([
            'status' => 'ok',
            'message' => 'Order successfuly',
        ],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $getOrderId = $this->order->getOrderId($id);

        return response()->json($getOrderId);
    }

    public function showOrderUserId($id)
    {
        $getOrderId = $this->order->getOrderByUserId($id);
        return response()->json($getOrderId);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $order = $this->order->updateOrder($request['id'], $request);
        return response()->json([
            'status' => 'ok',
            'message' => 'Order updated successfuly',
            'order' => $order
        ],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->order->deleteOrder($id);
        return response()->json([
            'status' => 'ok',
            'message' => 'Order delete successfuly',
        ],200);
    }
}
