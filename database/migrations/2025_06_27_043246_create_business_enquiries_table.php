<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('business_enquiries', function (Blueprint $table) {
            $table->id();
            $table->string('enquirer_name', 100);
            $table->string('enquirer_email', 150);
            $table->string('enquirer_mobile', 15);
            $table->text('enquirer_message')->nullable();
            $table->boolean('enquirer_check')->default(false);
            $table->enum('enquirer_status', ['pending', 'enquired'])->default('pending');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('business_enquiries');
    }
};
