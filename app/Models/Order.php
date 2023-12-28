<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

     /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'shipping_option',
        'shipping_method',
        'status',
        'amount',
        'currency_id',
        'tax_amount',
        'shipping_amount',
        'description',
        'coupon_code',
        'discount_amount',
        'sub_total',
        'is_confirmed',
        'discount_description',
        'is_finished',
        'payment_id',
    ];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id')->withDefault();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products()
    {
        return $this->hasMany(OrderProduct::class, 'order_id')->with(['product']);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function shipment()
    {
        return $this->hasOne(Shipment::class, 'order_id');
    }

    public function getAllOrder()
    {
        return Order::all();
    }

    public function getOrderId($id)
    {
        return Order::where('id', $id)->first();
    }

    public function updateOrder($id, $request)
    {
        $order = Order::find($id);
        
        $order->user_id =  $request['user_id'];
        $order->shipping_option =  $request['shipping_option'];
        $order->shipping_method =  $request['shipping_method'];
        $order->status =  $request['status'];
        $order->amount =  $request['amount'];
        $order->shipping_amount =  $request['shipping_amount'];
        $order->currency_id = $request['currency_id'];
        $order->description =  $request['description'];
        $order->coupon_code =  $request['coupon_code'];
        $order->discount_amount =  $request['discount_amount'];
        $order->is_confirmed =  $request['is_confirmed'];
        $order->discount_description =  $request['discount_description'];
        $order->is_finished =  $request['is_finished'];
        $order->payment_id =  $request['payment_id'];

        return $order->save();
    }

    public function insert($data)
    {
        return Order::create($data);
    }

    public function deleteOrder($id)
    {
        return Order::where('id', $id)->delete();
    }

}
