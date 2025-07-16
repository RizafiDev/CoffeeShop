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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('customer_name');
            $table->string('table_name');
            $table->enum('service_type', ['takeaway', 'dine_in']);
            $table->enum('payment_method', ['cash', 'qris', 'debit']);
            $table->integer('unique_code')->unique();
            $table->decimal('total_price', 10, 2);
            $table->decimal('transfer_total', 10, 2)->nullable();
            $table->string('payment_proof_url')->nullable();
            $table->enum('status', ['wait_verif', 'processed', 'completed', 'cancel']);
            $table->foreignId('user_id')->constrained('users')->nullOnDelete();
            $table->dateTime('verified_at');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
