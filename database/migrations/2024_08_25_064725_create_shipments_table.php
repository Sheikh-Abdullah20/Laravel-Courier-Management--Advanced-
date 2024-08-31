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
            $table->string('agent_name');
            $table->date('shipping_date');
            $table->string('sender_name');
            $table->string('sender_email');
            $table->string('receiver_email');
            $table->string('sender_phone');
            $table->string('receiver_name');
            $table->string('receiver_phone');
            $table->string('pickup_address');
            $table->string('delivery_address');
            $table->string('return_address');
            $table->string('return_city');
            $table->string('from_city');
            $table->string('to_city');
            $table->string('from_area');
            $table->string('to_area');
            $table->string('payment_method');
            $table->string('order_number');
            $table->string('tracking_number');
            $table->string('status')->default('Pending');

            $table->string('package_type');
            $table->string('description')->nullable();
            $table->bigInteger('quantity');
            $table->string('weight');
            $table->bigInteger('amount');
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
