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
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('brand_id');
            $table->unsignedInteger('category_id');
            $table->unsignedInteger('sub_category_id')->nullable();
            $table->string('title', 100)->unique();
            $table->string('slug', 150)->unique();
            $table->string('desc');
            $table->longText('long_desc');
            $table->string('product_code');
            $table->string('product_model', 100);
            $table->string('product_color', 100)->nullable();
            $table->string('product_size', 100)->nullable();
            $table->string('image')->default('product_default.png');
            $table->dateTime('image_start')->nullable();
            $table->dateTime('image_end')->nullable();
            $table->string('gallery')->nullable();
            $table->string('product_video_url')->nullable();
            $table->integer('quantity')->default(1);
            $table->enum('warranty', ['yes', 'no'])->default('no');
            $table->string('warranty_duration', 50)->nullable();
            $table->text('warranty_condition')->nullable();
            $table->decimal('original_price', 10, 3);
            $table->decimal('sales_price', 10, 3);
            $table->decimal('special_price', 10, 3)->nullable();
            $table->dateTime('special_start')->nullable();
            $table->dateTime('special_end')->nullable();
            $table->decimal('offer_price', 10, 3)->nullable();
            $table->dateTime('offer_start')->nullable();
            $table->dateTime('offer_end')->nullable();
            $table->enum('is_featured', ['yes', 'no'])->default('no');
            $table->enum('is_new', ['yes', 'no'])->default('no');
            $table->enum('available', ['in stock', 'out of stock', 'stock limit'])->default('in stock');
            $table->enum('status', ['active', 'inactive'])->default('active');
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
