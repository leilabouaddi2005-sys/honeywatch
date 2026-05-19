<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('intrusion_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('honeypot_id')->constrained()->cascadeOnDelete();
            $table->string('ip_address', 45);
            $table->text('user_agent')->nullable();
            $table->json('payload')->nullable();
            $table->string('country')->nullable();
            $table->string('city')->nullable();
            $table->unsignedTinyInteger('risk_score')->default(0);
            $table->timestamp('timestamp')->useCurrent();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('intrusion_logs');
    }
};