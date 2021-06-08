<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\ApiController;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryTransactionsController extends ApiController
{
    public function index(Category $category)
    {
        $transactions=$category->products()->whereHas('transactions')
        ->with('transactions')->get()->pluck('transactions')->unique();
        
        return $this->showAll($transactions);
    }
}
