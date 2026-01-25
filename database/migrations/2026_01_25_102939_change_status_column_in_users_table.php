<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        // 1) ENUM → STRING (temporary)
        Schema::table('users', function (Blueprint $table) {
            $table->string('status')->default('inactive')->change();
        });

        // 2) TEXT → NUMBERS
        DB::table('users')->where('status', 'active')->update(['status' => 1]);
        DB::table('users')->where('status', 'inactive')->update(['status' => 0]);

        // 3) STRING → TINYINT
        Schema::table('users', function (Blueprint $table) {
            $table->tinyInteger('status')->default(0)->change();
        });
    }

    public function down(): void
    {
        // 1) TINYINT → STRING
        Schema::table('users', function (Blueprint $table) {
            $table->string('status')->default('inactive')->change();
        });

        // 2) NUMBERS → TEXT
        DB::table('users')->where('status', 1)->update(['status' => 'active']);
        DB::table('users')->where('status', 0)->update(['status' => 'inactive']);

        // 3) STRING → ENUM
        Schema::table('users', function (Blueprint $table) {
            $table->enum('status', ['active', 'inactive'])->default('active')->change();
        });
    }
};
