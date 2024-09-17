<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('user_file_progress', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // The user
            $table->foreignId('product_id')->constrained()->onDelete('cascade'); // The product
            $table->foreignId('file_id')->constrained()->onDelete('cascade'); // The specific file
            $table->integer('last_position')->default(0); // Last position in seconds (time in the audio file)
            $table->integer('page_number')->default(0);
            $table->timestamps(); // Created at and updated at timestamps
        });
    }

    public function down()
    {
        Schema::dropIfExists('user_file_progress');
    }
};

