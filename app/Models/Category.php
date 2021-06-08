<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Product;

class Category extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $dates=['deleted_at'];

    protected $fillable=[
        "name",
        "description",
    ];

    protected $hidden=[
        "pivot"
    ];

    //category products relationship
    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}
