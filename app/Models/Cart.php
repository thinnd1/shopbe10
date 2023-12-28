<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
        return Cart::all();
    }
    
    public function insertCart($data)
    {
        return Cart::create($data);            
    }
}
