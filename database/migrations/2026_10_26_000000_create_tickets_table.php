<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('customer_name');
            $table->string('subject');
            $table->text('message');

            // Filled by AI
            $table->string('category')->nullable();
            $table->string('priority')->nullable();
            $table->string('summary')->nullable();
            $table->text('suggested_reply')->nullable();
            $table->string('ai_status')->default('pending'); // pending | done | failed

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
