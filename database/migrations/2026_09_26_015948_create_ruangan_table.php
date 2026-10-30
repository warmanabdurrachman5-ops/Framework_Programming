<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('ruangan', function (Blueprint $table): void {
            $table->id();
            $table->string('code_ruangan', 20);
            $table->string('nama', 100);
            $table->string('gedung', 100);
            $table->unsignedSmallInteger('kapasitas');
            $table->boolean('is_leb')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ruangan');
    }
};
