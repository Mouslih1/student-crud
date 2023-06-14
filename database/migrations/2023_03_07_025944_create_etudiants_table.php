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
        Schema::create('etudiants', function (Blueprint $table) {
            $table->id();
            $table->mediumText('image');
            $table->string('nom');
            $table->string('prenom');
            $table->foreignId('classes_id')->constrained('classes');
            $table->timestamps();
        });
        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('etudiants',function(Blueprint $table){
            $table->dropConstrainedForeignId('classes_id');
        });
        Schema::dropIfExists('etudiants');
    }
};
