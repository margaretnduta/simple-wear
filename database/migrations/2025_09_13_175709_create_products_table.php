<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('gender', ['men', 'women']); // which section it belongs to
            $table->text('description')->nullable();
            $table->decimal('price', 10, 2)->default(0);
            $table->string('image_path')->nullable(); // stored in /storage/app/public/products
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
