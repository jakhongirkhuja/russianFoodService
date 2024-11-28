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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            
            $table->text('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('meta_keywords')->nullable();

            $table->string('title')->index();
            $table->string('title_slug')->unique();
            $table->text('content')->index();
            $table->text('body')->index();
            $table->decimal('weight', 8, 2);
            $table->string('packing');
            $table->string('type')->index();
            $table->json('images')->nullable();
            $table->unsignedBigInteger('manufacturer_id')->index();
            $table->unsignedBigInteger('country_import_id')->index();
            $table->unsignedBigInteger('country_made_in_id')->index();
            $table->unsignedBigInteger('category_id')->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
