<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\Buyer;
class BuyerTransformer extends TransformerAbstract
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
    public function transform(Buyer $buyer)
    {
        return [
           'identifier'=>(int)$buyer->id,
           'name'=>(string)$buyer->name,
           'email'=>(string)$buyer->email,
           'isVerified'=>(int)$buyer->verified,
           'creationDate'=>$buyer->created_at,
           'lastUpdated'=>$buyer->updated_at,
           'deleteDate'=>isset($buyer->deleted_at)?(string)$buyer->deleted_at:null,

        ];
    }

    public static function originalAttribute($index)
    {
        $attributes=[
           'identifier'=>'id',
           'name'=>'name',
           'email'=>'email',
           'isVerified'=>'verified',
           'creationDate'=>'created_at',
           'lastUpdated'=>'updated_at',
           'deleteDate'=>'deleted_at',

        ];
        return isset($attributes[$index])?$attributes[$index]:null;
    }
}
