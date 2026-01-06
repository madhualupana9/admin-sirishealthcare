<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('doctors', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('education');
            $table->foreignId('specialty_id')->constrained()->onDelete('cascade');
            $table->foreignId('hospital_id')->constrained('hostels')->onDelete('cascade');
            $table->string('experience')->nullable();
            $table->string('languages')->nullable();
            $table->string('country')->nullable();
            $table->text('about_expert')->nullable();
            $table->text('education_training')->nullable();
            $table->text('professional_work')->nullable();
            $table->string('photo')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('doctors');
    }
};
