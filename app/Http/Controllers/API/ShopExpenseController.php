<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ShopExpenses;

class ShopExpenseController extends Controller
{
    protected $shopExpense;

    public function __construct(ShopExpenses $shopExpense)
    {
        $this->shopExpense = $shopExpense;
    }
    
    public function store(Request $request)
    {
        $data = [
            'shop_id' => $request['shop_id'],
            'expenses_id' => $request['expenses_id'],
        ];

        $shopExpensesInsert = $this->shopExpense->addShopExpenses($data);
        return response()->json([
            'status' => 'ok',
            'massage' => 'Shop Expenses created successfuly',
            'ShopExpenses' => $shopExpensesInsert
       ]);
    }

    public function index()
    {
        $shopExpenses = $this->shopExpense->getShop();
        return response()->json($shopExpenses);
    }
}
