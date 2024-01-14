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
        Schema::table('insureds', function (Blueprint $table) {
            $table->double("stamp_duty")->nullable();
            $table->double("levy")->nullable();
            $table->double("total_premium")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('insureds', function (Blueprint $table) {
            $table->dropColumn('stamp_duty');
            $table->dropColumn('levy');
            $table->dropColumn('total_premium');
        });
    }
};
