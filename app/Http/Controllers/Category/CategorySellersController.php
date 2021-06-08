<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\ApiController;
use App\Models\Category;
use Illuminate\Http\Request;

class CategorySellersController extends ApiController
{
    public function index(Category $category)
    {
        $sellers=$category->products()->with('seller')->get()->pluck('seller')->unique();
        
        return $this->showAll($sellers);
    }
}
