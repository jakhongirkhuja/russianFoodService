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
        Schema::create('recipes', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->index();
            $table->uuid('chef_id')->index();
            $table->text('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('meta_keywords')->nullable();
            $table->text('title');
            $table->text('image');
            $table->mediumText('body');
            $table->integer('cooking_time')->default(10);
            $table->text('title_slug');
            $table->uuid('recipe_categories_uuid')->index();
            $table->uuid('recipe_meal_types_uuid')->index();
            $table->uuid('recipe_product_types_uuid')->index();
            $table->uuid('recipe_diet_types_uuid')->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recipes');
    }
};
