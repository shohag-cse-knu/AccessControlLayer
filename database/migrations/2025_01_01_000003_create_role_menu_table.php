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
        Schema::create('role_menu', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->foreignId('role_id')->constrained('roles')->onDelete('cascade'); // Foreign key for role
            $table->foreignId('menu_id')->constrained('menus')->onDelete('cascade'); // Foreign key for menu
            //$table->timestamps(); // Timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('role_menu');
    }
};
