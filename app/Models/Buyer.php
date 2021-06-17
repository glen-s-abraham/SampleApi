<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Transaction;
use App\Scopes\BuyerScope;
use App\Transformers\BuyerTransformer;
class Buyer extends User
{
    use HasFactory;
    use SoftDeletes;
    public $transformer=BuyerTransformer::class;
    protected $dates=['deleted_at'];

    public static function boot()
    {
        parent::boot();
        static::addGlobalScope(new BuyerScope);

    }

    //buyer transaction relationship
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    
}
