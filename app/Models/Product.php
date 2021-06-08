<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Category;
use App\Models\Seller;
use App\Models\Transaction;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $dates=['deleted_at'];

    protected $hidden=[
        "pivot"
    ];

    const AVAILABLE_PRODUCT="available";
    const UNAVAILABLE_PRODUCT="unavailable";

    protected $fillabel=[
        "name",
        "description",
        "quantity",
        "status",
        "image",
        "seller_id",

    ];

    //is product available
    public function isAvailable()
    {
        return $this->status==Prodct::AVAILABLE_PRODUCT;
    }

    //products category relationship
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    // products seller relationship
    public function seller()
    {
        return $this->belongsTo(Seller::class);
    }
    
    // products seller relationship
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

}
