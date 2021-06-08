<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use App\Models\Product;
class ProductController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products=Product::all();
        return $this->showAll($products,200);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $products)
    {
        return $this->showOne($product,200);
    }

}
