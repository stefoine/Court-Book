<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('courts', function (Blueprint $t) {
            $t->id();
            $t->string('name');
            $t->string('type');
            $t->unsignedInteger('capacity')->default(10);
            $t->decimal('hourly_rate', 8, 2)->default(0);
            $t->text('description')->nullable();
            $t->string('image')->nullable();
            $t->boolean('is_available')->default(true);
            $t->timestamps();
        });
    }

    public function down(): void { Schema::dropIfExists('courts'); }
};
