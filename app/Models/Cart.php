<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use DB;

class Cart extends Model
{
    use HasFactory;
    protected $table = "cart";

    protected $fillable = [
        'product_id',
        'price_unit',
        'quantity',
        'user_id', // Add user_id here
    ];

    // user cart relation
    public function User_Cart(): BelongsTo{
        return $this->belongsTo(User::class, 'foreign_key');
    }

    public function getCart()
    {
        return DB::table('cart')
            ->select('products.price_unit as gia', 'products.id', 'products.image','products.name', 'cart.price_unit as kichthuoc','cart.quantity as soluong')
            ->join('products','cart.product_id', '=', 'products.id')
            ->orderBy('cart.id', 'desc')
            ->get();
    }
    
    public function insertCart($data)
    {
        return Cart::create($data);            
    }
}
