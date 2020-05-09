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
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('brand_id');
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('sub_category_id');
            $table->string('title', 50)->unique();
            $table->string('slug', 150)->unique();
            $table->longText('desc');
            $table->integer('code');
            $table->enum('available', ['in stock', 'not in stock'])->default('in stock');
            $table->string('image')->default('product_default.png');
            $table->integer('quantity')->default(1);
            $table->decimal('original_price', 8, 3)->nullable();
            $table->decimal('sales_price', 8, 3);
            $table->decimal('offer_price', 8, 3)->nullable();
            $table->integer('total_price')->nullable();
            $table->tinyInteger('is_new')->default(1);
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
            $table->foreign('brand_id')->references('id')->on('brands')->cascadeOnDelete();
            $table->foreign('category_id')->references('id')->on('categories')->cascadeOnDelete();
            $table->foreign('sub_category_id')->references('id')->on('sub_categories')->cascadeOnDelete();
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
