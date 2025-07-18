<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('borrowings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Relacionamento com User
            $table->foreignId('book_id')->constrained()->onDelete('cascade'); // Relacionamento com Book
            $table->timestamp('borrowed_at')->nullable(); // Data de Empréstimo
            $table->timestamp('returned_at')->nullable(); // Data de Devolução
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('borrowings');
    }
};