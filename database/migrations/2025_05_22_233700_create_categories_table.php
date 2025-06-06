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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();

            $table->integer('parent_id');
            $table->string('name');
            // $table->string('slug');
            $table->string('image');
            $table->float('discount');
            $table->text('description');
            $table->string('url');
            $table->string('meta_title');
            $table->text('meta_description');
            $table->string('meta_keyword');
            $table->tinyInteger('status');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
