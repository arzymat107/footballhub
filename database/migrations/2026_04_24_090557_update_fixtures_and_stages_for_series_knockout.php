<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("ALTER TABLE fixtures ALTER COLUMN leg DROP DEFAULT");
        DB::statement("ALTER TABLE fixtures ALTER COLUMN leg TYPE smallint USING CASE leg WHEN 'first' THEN 1 WHEN 'second' THEN 2 ELSE 1 END");
        DB::statement("ALTER TABLE fixtures ALTER COLUMN leg SET DEFAULT 1");
        DB::statement("ALTER TABLE fixtures ALTER COLUMN leg SET NOT NULL");

        Schema::table('stages', function (Blueprint $table) {
            $table->unsignedTinyInteger('wins_required')->nullable()->after('home_away');
        });
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE fixtures ALTER COLUMN leg TYPE varchar(10) USING CASE leg WHEN 1 THEN 'first' WHEN 2 THEN 'second' ELSE 'single' END");
        DB::statement("ALTER TABLE fixtures ALTER COLUMN leg SET DEFAULT 'single'");

        Schema::table('stages', function (Blueprint $table) {
            $table->dropColumn('wins_required');
        });
    }
};