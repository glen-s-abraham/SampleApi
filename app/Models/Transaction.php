<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Buyer;
use App\Models\Product;
use App\Transformers\TransactionTransformer;

class Transaction extends Model
{
    use HasFactory;
    public $transformer=TransactionTransformer::class;
    protected $fillable=[
        "quantity",
        "buyer_id",
        "product_id",
    ];

    //transaction buyer relationship
    public function buyers()
    {
        return $this->belongsTo(Buyer::class);
    }

    //transaction products relationship
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
