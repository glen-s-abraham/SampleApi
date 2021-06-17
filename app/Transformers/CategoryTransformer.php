<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\Category;
class CategoryTransformer extends TransformerAbstract
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
    public function transform(Category $category)
    {
        return [
            'identifier'=>(int)$category->id,
            'title'=>(string)$category->name,
            'details'=>(string)$category->description,
            'creationDate'=>$category->created_at,
            'lastUpdated'=>$category->updated_at,
            'deleteDate'=>isset($category->deleted_at)?(string)$category->deleted_at:null,
        ];
    }

    public static function originalAttribute($index)
    {
        $attributes=[
           'identifier'=>'id',
           'title'=>'name',
           'details'=>'description',
           'creationDate'=>'created_at',
           'lastUpdated'=>'updated_at',
           'deleteDate'=>'deleted_at',

        ];
        return isset($attributes[$index])?$attributes[$index]:null;
    }
}
