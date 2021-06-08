<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\ApiController;
use App\Models\Seller;
use Illuminate\Http\Request;

class SellerBuyersController extends ApiController
{
 public function index(Seller $seller)
    {
        $buyers=$seller->products()->whereHas('transactions')->with('transactions.buyers')
        ->get()
        ->pluck('transactions')
        ->collapse()
        ->pluck('buyers')
        ->unique('id')
        ->values();

     return $this->showAll($buyers);
    }
}
