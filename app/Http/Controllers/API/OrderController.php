<?php

namespace App\Http\Controllers\API;

use App\Models\Order;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    protected $order;
    public function __construct(Order $order)
    {
        $this->order = $order;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $getOrder = $this->order->getAllOrder();
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
        $data = [
            'user_id' => $request['user_id'],
            'shipping_option' => $request['shipping_option'],
            'shipping_method' => $request['shipping_method'],
            'status' => $request['status'],
            'amount' => $request['amount'],
            'shipping_amount' => $request['shipping_amount'],
            'currency_id' => $request['currency_id'],
            'description' => $request['description'],
            'coupon_code' => $request['coupon_code'],
            'discount_amount' => $request['discount_amount'],
            'is_confirmed' => $request['is_confirmed'],
            'discount_description' => $request['discount_description'],
            'is_finished' => $request['is_finished'],
            'payment_id' => $request['payment_id'],
        ];

        $order = $this->order->insertOrder($data);

        return response()->json([
            'status' => 'ok',
            'message' => 'Order product created successfuly',
            'order' => $order
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
