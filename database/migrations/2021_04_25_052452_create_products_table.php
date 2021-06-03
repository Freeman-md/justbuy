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
            $table->unsignedBigInteger('brand_id');
            $table->string('name')->unique();
            $table->string('slug')->nullable();
            $table->text('description');
            $table->decimal('price')->unsigned();
            $table->integer('discount')->unsigned()->default(0.0);
            $table->timestamps();

            $table->index('brand_id');

            $table->softDeletes();
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
        Schema::table('products', function(Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
}
