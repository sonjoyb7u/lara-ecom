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
            $table->unsignedInteger('sub_category_id');
            $table->string('title', 100)->unique();
            $table->string('slug', 150)->unique();
            $table->string('desc');
            $table->longText('long_desc');
            $table->string('product_code');
            $table->string('product_model', 100);
            $table->string('product_color', 100)->nullable();
            $table->string('product_size', 100)->nullable();
            $table->string('image')->default('product_default.png');
            $table->date('image_start')->nullable();
            $table->date('image_end')->nullable();
            $table->string('gallery')->nullable();
            $table->string('product_video_url')->nullable();
            $table->integer('quantity')->default(1);
            $table->enum('warranty', ['yes', 'no'])->default('no');
            $table->string('warranty_duration', 50)->nullable();
            $table->text('warranty_condition')->nullable();
            $table->decimal('original_price', 10, 3);
            $table->decimal('sales_price', 10, 3);
            $table->enum('is_special_price', ['yes', 'no'])->default('no');
            $table->decimal('special_price', 10, 3)->nullable();
            $table->date('special_start')->nullable();
            $table->date('special_end')->nullable();
            $table->enum('is_offer_price', ['yes', 'no'])->default('no');
            $table->decimal('offer_price', 10, 3)->nullable();
            $table->date('offer_start')->nullable();
            $table->date('offer_end')->nullable();
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
