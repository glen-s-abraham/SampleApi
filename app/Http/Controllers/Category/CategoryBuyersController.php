<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\ApiController;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryBuyersController extends ApiController
{
    public function index(Category $category)
    {
       $buyers=$category->products()
       ->whereHas('transactions')
       ->with('transactions.buyers')
       ->get()
       ->pluck('transactions')
       ->collapse()
       ->pluck('buyers')
       ->unique('id')
       ->values();
        
        return $this->showAll($buyers);
    }
}
