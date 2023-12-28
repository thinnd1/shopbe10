<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'order_id',
        'qty',
        'price',
        'tax_amount',
        'options',
        'product_id',
        'product_name',
        'weight',
        'restock_quantity',
    ];

    /**
     * @return BelongsTo
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class)->withDefault();
    }

    public function getAllOrderDetail()
    {
        return OrderDetail::all();
    }

    public function getOrderDetailId($id)
    {
        return OrderDetail::where('id', $id)->first();
    }

    public function insert($data)
    {
        return OrderDetail::create($data);
    }

    public function update($id, $data)
    {
        $orderDetail = OrderDetail::find($id);
        
        $orderDetail->name = $data['name'];
        $orderDetail->website = $data['website'];
        $orderDetail->description = $data['description'];
        $orderDetail->status = $data['status'];
        $orderDetail->country = $data['country'];
        $orderDetail->image = $data['image'];

        return $orderDetail->save();
    }

    public function delete($id)
    {
        return OrderDetail::where('id', $id)->delete();
    }
}
