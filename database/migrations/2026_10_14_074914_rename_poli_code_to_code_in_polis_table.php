<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('polis', function (Blueprint $table) {
            $table->renameColumn('poli_code', 'code');
        });
    }

    public function down(): void
    {
        Schema::table('polis', function (Blueprint $table) {
            $table->renameColumn('code', 'poli_code');
        });
    }
};
