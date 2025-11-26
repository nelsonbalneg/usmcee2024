<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Get the constraint name
        $constraint = DB::table('sys.check_constraints as cc')
            ->join('sys.columns as c', 'cc.parent_object_id', '=', 'c.object_id')
            ->join('sys.tables as t', 't.object_id', '=', 'c.object_id')
            ->where('t.name', 'ched_applicant_profiles')
            ->where('c.name', 'student_category')
            ->value('cc.name');

        // 2. Drop the constraint (SQL Server requirement)
        if ($constraint) {
            DB::statement("ALTER TABLE ched_applicant_profiles DROP CONSTRAINT {$constraint}");
        }

        // 3. Modify the column type + set nullable
        DB::statement("
            ALTER TABLE ched_applicant_profiles
            ALTER COLUMN student_category NVARCHAR(255) NULL;
        ");

        // 4. Re-create CHECK constraint for allowed values
        DB::statement("
            ALTER TABLE ched_applicant_profiles
            ADD CONSTRAINT chk_student_category CHECK (student_category IN ('0', '1'));
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Reverse: Drop constraint, make not-null, recreate original constraint

        $constraint = DB::table('sys.check_constraints as cc')
            ->join('sys.columns as c', 'cc.parent_object_id', '=', 'c.object_id')
            ->join('sys.tables as t', 't.object_id', '=', 'c.object_id')
            ->where('t.name', 'ched_applicant_profiles')
            ->where('c.name', 'student_category')
            ->value('cc.name');

        if ($constraint) {
            DB::statement("ALTER TABLE ched_applicant_profiles DROP CONSTRAINT {$constraint}");
        }

        DB::statement("
            ALTER TABLE ched_applicant_profiles
            ALTER COLUMN student_category NVARCHAR(255) NOT NULL;
        ");

        DB::statement("
            ALTER TABLE ched_applicant_profiles
            ADD CONSTRAINT chk_student_category CHECK (student_category IN ('0', '1'));
        ");
    }
};
