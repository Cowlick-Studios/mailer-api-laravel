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
        Schema::table('email_submissions', function (Blueprint $table) {
            $table->boolean('turnstile_enable')->default(false);
            $table->string('turnstile_secret')->default("");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('email_submissions', function (Blueprint $table) {
            $table->dropColumn('turnstile_enable');
            $table->dropColumn('turnstile_secret');
        });
    }
};
