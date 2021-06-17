<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\Product;
class ProductTransformer extends TransformerAbstract
{
    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected $defaultIncludes = [
        //
    ];
    
    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = [
        //
    ];
    
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Product $product)
    {
        return [
           'identifier'=>(int)$product->id,
           'title'=>(string)$product->name,
           'details'=>(string)$product->description,
           'stock'=>(int)$product->quantity,
           'situation'=>(string)$product->status,
           'picture'=>url($product->image),
           'seller'=>(int)$product->seller_id,
           'product'=>(int)$product->product_id,
           'creationDate'=>$product->created_at,
           'lastUpdated'=>$product->updated_at,
           'deleteDate'=>isset($product->deleted_at)?(string)$product->deleted_at:null,
        ];
    }

    public static function originalAttribute($index)
    {
        $attributes=[
           'identifier'=>'id',
           'title'=>'name',
           'details'=>'description',
           'stock'=>'quantity',
           'situation'=>'status',
           'seller'=>'seller_id',
           'product'=>'product_id',
           'creationDate'=>'created_at',
           'lastUpdated'=>'updated_at',
           'deleteDate'=>'deleted_at',

        ];
        return isset($attributes[$index])?$attributes[$index]:null;
    }
}
