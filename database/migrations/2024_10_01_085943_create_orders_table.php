<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id(); // Auto-incrementing ID for the order
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Foreign key to users table
            $table->decimal('total', 10, 2); // Total amount for the order
            $table->string('status')->default('pending'); // Order status, e.g., pending, completed, etc.
            $table->timestamps(); // Laravel's default created_at and updated_at columns
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}

