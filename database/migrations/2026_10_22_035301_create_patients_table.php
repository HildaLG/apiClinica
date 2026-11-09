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
        Schema::create('patients', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
            $table->id();
            $table->unsignedBigInteger('doctor_id'); //aca guardara el id del doctor
            $table->string('name', 100);
            $table->string('email', 150)->unique();
            $table->string('phone', 20);
            $table->date('birthdate');
            $table->enum('gender', ['M', 'F', 'O']);
            $table->string('address', 255)->nullable(); //opcional, puede quedar vacia
            $table->foreign('doctor_id') //declaro que doctor id es llave foranea
                ->references('id')
                ->on('doctors')
                ->onUpdate('cascade')
                ->onDelete('restrict');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
