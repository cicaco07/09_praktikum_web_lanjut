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
        Schema::table('mahasiswa', function(Blueprint $table){
            $table->string('tanggal_lahir', 100)->after('nama');
            $table->string('email', 100)->after('tanggal_lahir');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mahasiswa', function(Blueprint $table){
            $table->dropColumn('tanggal_lahir', 100);
            $table->dropColumn('email', 100);
        });
        
    }
};
