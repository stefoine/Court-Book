<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $t) {
            $t->id();
            $t->foreignId('user_id')->constrained()->cascadeOnDelete();
            $t->foreignId('court_id')->constrained()->cascadeOnDelete();
            $t->string('sport_type');
            $t->string('purpose');
            $t->date('booking_date');
            $t->time('start_time');
            $t->time('end_time');
            $t->text('notes')->nullable();
            $t->enum('status', ['pending','approved','rejected','cancelled','completed'])->default('pending');
            $t->string('payment_proof')->nullable();
            $t->text('admin_remark')->nullable();
            $t->decimal('total_price', 10, 2)->default(0);
            $t->timestamps();

            $t->index(['court_id', 'booking_date']);
        });
    }

    public function down(): void { Schema::dropIfExists('bookings'); }
};
