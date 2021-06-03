<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('invoice_id')->nullable();
            $table->json('details')->nullable();
            $table->decimal('amount')->unsigned();
            $table->decimal('tax')->unsigned();
            $table->decimal('total_amount')->unsigned();
            $table->enum('status', ['Confirmed', 'Delivered', 'Transit', 'Cancelled'])->default('Transit');
            $table->text('invoice')->nullable();
            $table->timestamps();

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
        Schema::dropIfExists('orders');
        Schema::table('orders', function(Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
}
