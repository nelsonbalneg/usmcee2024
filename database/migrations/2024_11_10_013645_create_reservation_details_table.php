<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reservation_details', function (Blueprint $table) {
            $table->id(); // Auto-incrementing ID for primary key
            $table->string('app_no')->unique(); // Application number (unique)
            $table->string('lrn'); // Learner Reference Number
            $table->string('firstname'); // First Name
            $table->string('lastname'); // Last Name
            $table->date('birthdate'); // Birthdate
            $table->string('exam_session'); // Exam session (e.g., 2024-Q1)
            $table->string('room_id'); // Room ID
            $table->timestamps(); // created_at and updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservation_details');
    }
};
