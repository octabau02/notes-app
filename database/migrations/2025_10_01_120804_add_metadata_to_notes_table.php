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
        Schema::table('notes', function (Blueprint $table) {
            $table->enum('type', ['normal', 'important', 'reminder'])->default('normal');
            $table->date('reminder_date')->nullable();
            $table->json('exported_data')->nullable();
            $table->string('saved_in')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('notes', function (Blueprint $table) {
            $table->dropColumn(['type', 'important', 'reminder_date', 'exported_data']);
        });
    }
};
