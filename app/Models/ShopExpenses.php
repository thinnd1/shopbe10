<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShopExpenses extends Model
{
    use HasFactory;

    protected $fillable = [
        'shop_id',
        'expenses_id'
    ];

    public function addShopExpenses($data)
    {
        ShopExpenses::create($data);
    }
}
