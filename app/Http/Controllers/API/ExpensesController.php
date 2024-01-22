<?php

namespace App\Http\Controllers\Api;

use App\Models\Expenses;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ExpensesController extends Controller
{
    protected $expenses;
    public function __construct(Expenses $expenses)
    {
        $this->expenses = $expenses;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $getExpenses = $this->expenses->getAllExpenses();
        return response()->json($getExpenses);
    }

}