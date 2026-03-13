<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sub_branch_hospitals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hospital_id')->constrained('hostels')->onDelete('cascade');
            $table->string('name');
            $table->string('image')->nullable();
            $table->string('city');
            $table->string('state');
            $table->text('description')->nullable();
            $table->string('contact_number')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sub_branch_hospitals');
    }
};
