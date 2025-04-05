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
        Schema::table('quotes', function (Blueprint $table) {
            $table->unsignedBigInteger('carpet_id')->nullable();
            $table->text('custom_carpet_description')->nullable();
            $table->unsignedBigInteger('address_id')->nullable();
            
            $table->foreign('carpet_id')->references('id')->on('carpets')->onDelete('set null');
            $table->foreign('address_id')->references('id')->on('addresses')->onDelete('set null');
            
            // Make measurement_id nullable since it's optional
            $table->unsignedBigInteger('measurement_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('quotes', function (Blueprint $table) {
            $table->dropForeign(['carpet_id']);
            $table->dropForeign(['address_id']);
            $table->dropColumn(['carpet_id', 'custom_carpet_description', 'address_id']);
            $table->unsignedBigInteger('measurement_id')->nullable(false)->change();
        });
    }
};