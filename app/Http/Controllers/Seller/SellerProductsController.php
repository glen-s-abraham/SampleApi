<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\ApiController;
use App\Models\Seller;
use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Support\Facades\Storage;

class SellerProductsController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Seller $seller)
    {
        $products=$seller->products;
        return $this->showAll($products);
    }

    
    public function store(Request $request,User $seller)
    {
        $rules=[
            'name'=>'required',
            'description'=>'required',
            'quantity'=>'required|integer|min:1',
            'image'=>'required|image'    
        ];

        $this->validate($request,$rules);
        $data=$request->all();
        $data['status']=Product::UNAVAILABLE_PRODUCT;
        $data['seller_id']=$seller->id;
        if($request->hasFile('image'))
        {
            $image=$request->image->store('images');
            $data['image']=$image;
        }
        $data['image']='app/1.jpg';
        $product=Product::create($data);
        return $this->showOne($product);

        
    }

    
    public function update(Request $request, Seller $seller,Product $product)
    {
        $rules=[
            'quantity'=>'integer|min:1',
            'status'=>'in'.Product::UNAVAILABLE_PRODUCT.','.Product::AVAILABLE_PRODUCT,
            'image'=>'image'    
        ];
        $this->validate($request,$rules);
        $this->checkSeller($seller,$product);
        $product->fill($request->only(['name','description','quantity']));
        if ($request->has('status'))
        {
            $product->status->$request->status; 
            if($product->isAvailable() && $product->categories()->count()==0)
            {
                return $this->errorResponse("An active product must have atleast one category",409);
            } 
        }
        if($request->hasFile('image'))
        {
            Storage::delete($product->image);
            $image=$request->image->store('images');
            $product->image=$image;
        }
        if($product->isClean())
        {
            return $this->errorResponse("You need to specify a differnet values to update",422);
        }
        $product->save();
        return $this->showOne($product);
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Seller  $seller
     * @return \Illuminate\Http\Response
     */
    public function destroy(Seller $seller,Product $product)
    {
        $this->checkSeller($seller,$product);
        Storage::delete($product->image);
        $product->delete();
        return $this->showOne($product);

    }

    private function checkSeller(Seller $seller,Product $product)
    {
        if($seller->id!=$product->seller_id)
        {
            throw new HttpException(422,'The specific seller is not the actual seller of the product');
        }
    }
}
