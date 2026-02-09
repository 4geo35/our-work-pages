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
        Schema::create('our_works', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('image_id');

            $table->string('title');
            $table->string('slug')->unique();
            $table->string("short")->nullable();
            $table->text('description')->nullable();

            $table->date("date_from")->nullable();
            $table->date("date_to")->nullable();

            $table->unsignedBigInteger("priority")->default(0);
            $table->dateTime("published_at")->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('our_works');
    }
};
