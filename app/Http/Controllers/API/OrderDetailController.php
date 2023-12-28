<?php

namespace App\Http\Controllers\API;

use App\Models\OrderDetail;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderDetailController extends Controller
{
    protected $orderDetail;
    public function __construct(OrderDetail $orderDetail)
    {
        $this->orderDetail = $orderDetail;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $getAllOrderDetail = $this->orderDetail->getAllOrderDetail();
        return response()->json($getAllOrderDetail);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $data = [
            'name' => $request['name'],
            'shipping_option' => $request['website'],
            'shipping_method' => $request['description'],
            'status' => $request['status'],
            'amount' => $request['country'],
            'shipping_amount' => $request['image'],
        ];

        $orderDetail = $this->orderDetail->insert($data);
        
        return response()->json([
            'status' => 'ok',
            'message' => 'Order updated successfuly',
            'order' => $orderDetail
        ],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OrderDetail  $orderDetail
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $getAllOrderDetail = $this->orderDetail->getOrderDetailId($id);
        return response()->json($getAllOrderDetail);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\OrderDetail  $orderDetail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $orderDetail = $this->orderDetail->update($request['id'], $request);
        return response()->json([
            'status' => 'ok',
            'message' => 'Order updated successfuly',
            'order' => $orderDetail
        ],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OrderDetail  $orderDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->orderDetail->delete($id);
        return response()->json([
            'status' => 'ok',
            'message' => 'Order detail delete successfuly',
        ],200);
    }
}
