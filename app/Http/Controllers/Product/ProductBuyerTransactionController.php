<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\ApiController;
use App\Models\Product;
use App\Models\User;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductBuyerTransactionController extends ApiController
{
   
     
    public function store(Request $request,Product $product,User $buyer)
    {
        $rules=[
            'quantity'=>'required|integer',
        ];

        $this->validate($request,$rules);

        if($buyer->id==$product->seller->id)
        {
            return $this->errorResponse('The buyer must be different from the seller',409);
        }

        if(!$buyer->isVerified())
        {
            return $this->errorResponse("The Buyer Must be a verified user",409);
        }

        if(!$product->seller->isVerified())
        {
            return $this->errorResponse("The Seller Must be a verified user",409);
        }

        if(!$product->isAvailable())
        {
            return $this->errorResponse("The Product is unavailable",409);
        }

        if($product->quantity < $request->quantity)
        {
            return $this->errorResponse("The product does not have enough units",409);
        }

        return DB::transaction(function() use($request,$product,$buyer){
            $product->quntity-=$request->quntity;
            $product->save();

            $transaction=Transaction::create([
                "quantity"=>$request->quntity,
                "buyer_id"=>$buyer->id,
                "product_id"=>$product->id,
                ]);
            return $this->showOne($transaction,201);

        });


    }

    
}
