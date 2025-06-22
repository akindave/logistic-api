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
        Schema::create('shipments', function (Blueprint $table) {
            $table->id();
            $table->uuid('tracking_number')->unique();
            $table->string('sender_name');
            $table->string('receiver_name');
            $table->string('origin_address');
            $table->string('destination_address');
            $table->string('origin_coords')->nullable();
            $table->string('destination_coords')->nullable();
            $table->enum('status',['Pending','In‑Transit','Delivered'])->default('Pending');
            $table->foreignId('created_by')->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shipments');
    }
};
