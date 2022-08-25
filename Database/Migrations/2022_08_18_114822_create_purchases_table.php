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
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->foreignId('manufacturer_id')->nullable();
            $table->string('invoice_no')->nullable();
            $table->integer('grand_total_amount')->nullable();
            $table->integer('paid_amount')->nullable();
            $table->integer('due_amount')->nullable();
            $table->integer('total_discount')->nullable();
            $table->integer('total_vat')->nullable();
            $table->date('date')->nullable();
            $table->text('details')->nullable();
            $table->tinyInteger('status')->nullable();
            $table->string('payment_type')->nullable();
            $table->foreignId('bank_id')->nullable();
            $table->foreignId('purchased_by')->constrained('users');
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
        Schema::dropIfExists('purchases');
    }
};
