<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('honeypots', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('type', ['login', 'api', 'form'])->default('login');
            $table->string('url_slug')->unique();
            $table->boolean('is_active')->default(true);
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('honeypots');
    }
};