<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Product;
class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description',1000);
            $table->integer('quantity')->unsigned;
            $table->string('status')->default(Product::UNAVAILABLE_PRODUCT);
            $table->unsignedBigInteger('seller_id');
            $table->string('image');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('seller_id')->references("id")->on("users");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
