<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

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
        'product_id',
        'shop_id',
        'shipping_method',
        'price',
        'status',
        'amount',
        'description',
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

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function getAllOrder($shopId)
    {
        return Order::orderByDesc('id')->where('shop_id', $shopId)->get();
    }

    public function getOrderId($id)
    {
        return Order::where('id', $id)->first();
    }

    public function getOrderByUserId($userId)
    {
        return Order::where('user_id', $userId)->first();
    }

    public function updateOrder($id, $request)
    {
        $order = Order::find($id);
        
        $order->user_id =  $request['user_id'];
        $order->status =  $request['status'];
        $order->amount =  $request['amount'];
        $order->shipping_amount =  $request['shipping_amount'];
        $order->currency_id = $request['currency_id'];
        $order->is_confirmed =  $request['is_confirmed'];
        $order->is_finished =  $request['is_finished'];

        return $order->save();
    }

    public function insertOrder($data)
    {
        return Order::create($data);
    }

    public function deleteOrder($id)
    {
        return Order::where('id', $id)->delete();
    }

    public function getTotalPrice()
    {
        return DB::table('orders')->sum('price');
    }

    public function getTotalPriceShop($shopId)
    {
        return DB::table('orders')->where('shop_id', $shopId)->sum('price');
    }
}
