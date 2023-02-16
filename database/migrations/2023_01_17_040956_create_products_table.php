<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->unsignedBigInteger('category_id');
            $table->string('product_name');
            $table->string('product_slug');
            $table->longText('description');
            $table->string('meta_title')->nullable();
            $table->mediumText('meta_keyword')->nullable();
            $table->integer('selling_price');
            $table->integer('qauntity');
            $table->tinyInteger('status')->default('0');
            $table->tinyInteger('trending')->default('0');
            $table->longText('meta_description')->nullable();
            
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->timestamps();
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
