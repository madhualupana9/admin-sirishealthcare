<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('consultations', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('email')->nullable();
            $table->integer('age')->nullable();
            $table->string('contact_info')->nullable();
            $table->text('problem_description')->nullable();
            $table->string('specialty')->nullable();
            $table->dateTime('appointment_time')->nullable();

            // Payment details
            $table->string('payment_method')->nullable();
            $table->string('razorpay_payment_id')->nullable();
            $table->string('razorpay_order_id')->nullable();
            $table->string('razorpay_signature')->nullable();
            $table->decimal('amount', 10, 2)->nullable();
            $table->string('currency')->default('INR');
            $table->enum('payment_status', ['pending', 'success', 'failed', 'refunded'])->default('pending');

            $table->string('invoice_id')->nullable();
            $table->enum('refund_status', ['not_requested', 'requested', 'processed'])->default('not_requested');
            // Add consultation status
            $table->enum('consultation_status', ['pending', 'consulted'])->default('pending');
            $table->text('notes')->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('consultations');
    }
};
