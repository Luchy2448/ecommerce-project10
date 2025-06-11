<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use NunoMaduro\Collision\Adapters\Phpunit\State;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
          
            $table->integer('category_id'); 
            $table->integer('brand_id'); 
     
            $table->string('name');
            $table->string('code')->unique();
            $table->string('color')->nullable();
            $table->string('family_color')->nullable();
            $table->string('group_code')->nullable();
            $table->float('price');
            $table->float('discount')->nullable();
            $table->string('discount_type')->nullable();
            $table->float('final_price')->nullable();
            $table->string('video')->nullable();
            $table->string('image')->nullable();
            $table->text('description')->nullable();
            $table->text('wash_care')->nullable();
            $table->text('keywords')->nullable();
            $table->string('fabric')->nullable();
            $table->string('pattern')->nullable();
            $table->string('sleeve')->nullable();
            $table->string('fit')->nullable();
            $table->string('occasion')->nullable();          
            $table->string('size')->nullable();
            $table->float('weight')->nullable();
            $table->integer('stock')->nullable();
             
            $table->string('meta_title')->nullable();
            $table->string('meta_description')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->tinyInteger('status')->default(1); // 1 for active, 0 for inactive
            $table->enum('is_featured', ['No', 'Yes'])->nullable();
         
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
