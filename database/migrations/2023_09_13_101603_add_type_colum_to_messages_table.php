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
        Schema::table('messages', function (Blueprint $table) {
            $table->integer('sender_id')->after('id');
            $table->integer('reciver_id')->after('sender_id');
            $table->enum('sender_type',['admin','coach','user'])->after('reciver_id');
            $table->enum('reciver_type',['admin','coach','user'])->after('sender_type');
            $table->integer('reply')->after('reciver_type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('messages', function (Blueprint $table) {
            $table->dropColumn('sender_id');
            $table->dropColumn('reciver_id');
            $table->dropColumn('sender_type');
            $table->dropColumn('reciver_type');
            $table->dropColumn('reply');
        });
    }
};
