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
        Schema::table('manufacturers', function (Blueprint $table) {
            $table->integer('founded');
            $table->string('website', 255);
        });
        Schema::table('carmodels', function (Blueprint $table) {
            $table->integer('production_started');
            $table->decimal('min_price', 8, 2);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('manufacturers', function($table) {
            $table->dropColumn('founded');
            $table->dropColumn('website');
        });
        Schema::table('carmodels', function($table) {
            $table->dropColumn('production_started');
            $table->dropColumn('min_price');
        });
    }
};
