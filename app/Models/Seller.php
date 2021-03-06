<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Scopes\SellerScope;
use App\Models\Product;
use App\Transformers\SellerTransformer;
class Seller extends User
{
    use HasFactory;
    public $transformer=SellerTransformer::class;
    public static function boot()
    {
        parent::boot();
        static::addGlobalScope(new SellerScope);
    }

    // products seller relationship
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
