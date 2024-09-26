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
        Schema::create('auth_modules', function (Blueprint $table) {
            $table->id();
            $table->string('amName',50);
            $table->string('amSlug',75)->nullable();
            $table->string('amIcon',75)->nullable();
            $table->integer('amParentMenuId');
            $table->integer('amStatus')->default(0);
            $table->integer('amShowMenu')->default(0);
            $table->integer('amOrder')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('auth_modules');
    }
};
