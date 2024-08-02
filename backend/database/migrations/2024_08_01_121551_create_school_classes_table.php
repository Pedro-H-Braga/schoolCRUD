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
        Schema::create('school_class', function (Blueprint $table) {
            $table->id();
            $table->string('name', 150);
            $table->integer('year');
            $table->enum('school_term', ['matutino', 'vespertino', 'noturno']);
            $table->boolean('enable')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('school_class');
    }
};
