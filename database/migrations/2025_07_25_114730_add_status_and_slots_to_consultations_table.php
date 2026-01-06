<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('consultations', function (Blueprint $table) {
            $table->enum('status', ['pending', 'confirmed', 'cancelled', 'rescheduled'])->default('pending')->after('notes');
            $table->unsignedBigInteger('original_slot_id')->nullable()->after('status');
            $table->unsignedBigInteger('current_slot_id')->nullable()->after('original_slot_id');
            $table->unsignedBigInteger('cancellation_reason_id')->nullable()->after('current_slot_id');
            $table->text('cancellation_notes')->nullable()->after('cancellation_reason_id');
        });
    }

    public function down(): void
    {
        Schema::table('consultations', function (Blueprint $table) {
            $table->dropColumn([
                'status',
                'original_slot_id',
                'current_slot_id',
                'cancellation_reason_id',
                'cancellation_notes',
            ]);
        });
    }
};
