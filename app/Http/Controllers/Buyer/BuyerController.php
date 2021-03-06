<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use App\Models\Buyer;

class BuyerController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $buyers=Buyer::has('transactions')->get();
        return $this->showAll($buyers);
    }

  
    public function show(Buyer $buyer)
    {
       
        return $this->showOne($buyer);
    }


}
