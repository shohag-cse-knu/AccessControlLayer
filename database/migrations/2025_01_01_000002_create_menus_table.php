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
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->string('key');
            $table->integer('parent_id');
            $table->string('url');
            $table->string('icon')->nullable();
            $table->tinyInteger('order')->default(0);
            $table->tinyInteger('active')->default(1);
            $table->tinyInteger('link_rights')->default(0);
            $table->timestamps();
            $table->softDeletes();
            $table->integer('created_by')->default(0)->unsigned();
            $table->integer('updated_by')->default(0)->unsigned();
            $table->integer('deleted_by')->default(0)->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menus');
    }
};
