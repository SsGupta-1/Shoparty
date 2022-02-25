<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomizedOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customized_orders', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->unsignedBigInteger('product_id')->nullable();
            $table->foreign('product_id')->references('id')->on('products')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->unsignedBigInteger('product_detail_id')->nullable();
            $table->foreign('product_detail_id')->references('id')->on('product_details')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->string('add_image')->nullable();
            $table->string('background_image')->nullable();

            $table->unsignedBigInteger('font_name_id')->nullable();
            $table->foreign('font_name_id')->references('id')->on('font_names')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->unsignedBigInteger('font_color_id')->nullable();
            $table->foreign('font_color_id')->references('id')->on('colors')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->string('font_height')->nullable();
            $table->tinyInteger('status')->comment('1=Active, 0=Inactive, 2=Deleted')->default(1);

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
        Schema::dropIfExists('customized_orders');
    }
}
