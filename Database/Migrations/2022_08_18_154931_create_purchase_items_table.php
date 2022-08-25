<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('purchase_id')->nullable()->constrained()->cascadeOnDelete();
            $table->foreignId('product_id')->nullable();
            $table->integer('quantity')->nullable();
            $table->integer('box_quantity')->nullable();
            $table->integer('unit_rate')->nullable();
            $table->integer('rate')->nullable();
            $table->integer('old_mrp')->nullable();
            $table->integer('mrp')->nullable();
            $table->integer('total_amount')->nullable();
            $table->integer('discount')->nullable();
            $table->integer('single_vat')->nullable();
            $table->foreignId('batch_id')->nullable();
            $table->date('expire_date')->nullable();
            $table->tinyInteger('status')->nullable();
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
        Schema::dropIfExists('purchase_items');
    }
};
