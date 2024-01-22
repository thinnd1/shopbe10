<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class ShopExpenses extends Model
{
    use HasFactory;

    protected $fillable = [
        'shop_id',
        'expenses_id'
    ];

    public function addShopExpenses($data)
    {
        return ShopExpenses::create($data);
    }

    public function getShop()
    {
        return DB::table('shop_expenses')
        ->join('shops', 'shop_expenses.shop_id', '=', 'shops.id')
        ->join('expenses', 'shop_expenses.expenses_id', '=', 'expenses.id')
        ->select('shop_expenses.created_at', 'shops.name as shop_name', 'expenses.package as expenses_pakage')
        ->get();            
    }

    public function getShopId($shopId)
    {
        return DB::table('shop_expenses')
        ->join('shops', 'shop_expenses.shop_id', '=', 'shops.id')
        ->join('expenses', 'shop_expenses.expenses_id', '=', 'expenses.id')
        ->select('expenses.package as expenses_pakage')
        ->where('shops.id', $shopId)
        ->first();
    }

    public function totalSystem()
    {
        return DB::table('shop_expenses')
        ->join('expenses', 'shop_expenses.expenses_id', '=', 'expenses.id')
        ->sum("price");
    }
}
