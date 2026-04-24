<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement('ALTER TABLE fixtures DROP CONSTRAINT IF EXISTS fixtures_leg_check');
    }

    public function down(): void
    {
        //
    }
};