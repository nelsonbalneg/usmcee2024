<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('stundent_profiles', function (Blueprint $table) {
            $table->id();
            $table->integer('student_type');
            $table->integer('freshmen_type');
            $table->string('student_no', 15)->nullable();
            $table->integer('user_id')->unique();
            $table->integer('campus_id')->nullable();
            $table->integer('prog_id')->nullable();
            $table->integer('major_disc_id')->nullable();
            $table->integer('year_level_id')->nullable();
            $table->string('app_no', 50)->unique();
            $table->string('last_name', 50);
            $table->string('middle_name', 50)->nullable();
            $table->string('first_name', 50);
            $table->string('middle_initial', 5)->nullable();
            $table->string('ext_name', 10)->nullable();
            $table->date('date_of_birth');
            $table->string('place_of_birth', 200);
            $table->integer('civil_status_id');
            $table->integer('religion_id');
            $table->string('gender');
            $table->integer('nationality_id');
            $table->string('mobile_no', 20);
            $table->string('email', 50)->unique();
            $table->integer('health_id')->nullable();
            $table->float('height');
            $table->float('weight');
            $table->string('blood_type', 3);

            $table->boolean('pwd_member')->nullable();
            $table->string('pwd_member_id', 50)->nullable();
            $table->string('pwd_category', 50)->nullable();
            $table->boolean('solo_parent')->nullable();
            $table->string('solo_parent_id', 50)->nullable();

            // PI Social and tribal affiliations
            $table->string('ses', 100)->nullable();
            $table->integer('tribe_id')->nullable();
            $table->string('tribe', 50)->nullable();
            $table->boolean('ip_member')->nullable();
            $table->string('ip_member_tribe', 50)->nullable();

            // Parent Details
            $table->string('father', 50)->nullable();
            $table->string('father_occupation', 50)->nullable();
            $table->string('father_company', 100)->nullable();
            $table->string('father_company_address', 200)->nullable();
            $table->string('father_tel_no', 20)->nullable();
            $table->string('father_email', 50)->nullable();
            $table->string('mother', 50)->nullable();
            $table->string('mother_occupation', 50)->nullable();
            $table->string('mother_company', 100)->nullable();
            $table->string('mother_company_address', 200)->nullable();
            $table->string('mother_tel_no', 20)->nullable();
            $table->string('mother_email', 50)->nullable();

            // Parent details - additional fields
            $table->dateTime('father_birth_date')->nullable();
            $table->dateTime('mother_birth_date')->nullable();
            $table->string('father_educ_attain', 100)->nullable();
            $table->string('mother_educ_attain', 100)->nullable();
            $table->integer('father_income_from')->nullable();
            $table->integer('father_income_to')->nullable();
            $table->integer('mother_income_from')->nullable();
            $table->integer('mother_income_to')->nullable();

            // Guardian Info
            $table->string('guardian', 100)->nullable();
            $table->string('guardian_relationship', 100)->nullable();
            $table->string('guardian_address', 100)->nullable();
            $table->string('guardian_street', 100)->nullable();
            $table->string('guardian_barangay', 100)->nullable();
            $table->string('guardian_towncity', 100)->nullable();
            $table->string('guardian_province', 100)->nullable();
            $table->string('guardian_region', 100)->nullable();
            $table->integer('guardian_zipcode')->nullable();
            $table->string('guardian_occupation', 100)->nullable();
            $table->string('guardian_company', 100)->nullable();
            $table->string('guardian_telno', 100)->nullable();
            $table->string('guardian_email', 100)->nullable();

            // Residence & Permanent Address
            $table->string('res_address', 255)->nullable();
            $table->string('res_street', 100)->nullable();
            $table->string('res_barangay', 100)->nullable();
            $table->string('res_towncity', 100)->nullable();
            $table->integer('res_zipcode')->nullable();
            $table->string('res_province', 100)->nullable();
            $table->string('res_region', 100)->nullable();
            $table->string('perm_address', 100)->nullable();
            $table->string('perm_street', 100)->nullable();
            $table->string('perm_barangay', 100)->nullable();
            $table->string('perm_towncity', 100)->nullable();
            $table->integer('perm_zipcode')->nullable();
            $table->string('perm_province', 60)->nullable();
            $table->string('perm_region', 60)->nullable();

            // Emergency Contact
            $table->string('emergency_contact', 100)->nullable();
            $table->string('emergency_address', 100)->nullable();
            $table->string('emergency_mobileno', 60)->nullable();
            $table->string('emergency_telno', 60)->nullable();

            // Educational Background
            $table->string('elem_school', 100)->nullable();
            $table->string('elem_address', 100)->nullable();
            $table->string('elem_incldates', 60)->nullable();
            $table->string('hs_school', 100)->nullable();
            $table->string('hs_address', 100)->nullable();
            $table->string('hs_incldates', 60)->nullable();
            $table->string('vocational', 100)->nullable();
            $table->string('vocational_address', 100)->nullable();
            $table->string('vocational_degree', 100)->nullable();
            $table->string('vocational_incldates', 60)->nullable();
            $table->string('shs_school', 100)->nullable();
            $table->string('shs_address', 100)->nullable();
            $table->string('shs_incldates', 60)->nullable();

            $table->string('college_school', 100)->nullable();
            $table->string('college_address', 100)->nullable();
            $table->string('college_degree', 100)->nullable();
            $table->string('college_incldates', 60)->nullable();
            $table->binary('student_picture')->nullable();
            $table->boolean('inactive')->default(1);
            $table->integer('status_id')->nullable();
            $table->string('admitted_from_gs_to_hs', 15)->nullable();
            $table->string('status_remarks', 100)->nullable();



            // Family background
            $table->integer('no_of_brothers')->nullable();
            $table->integer('no_of_sisters')->nullable();
            $table->boolean('is_illegitimate_child')->nullable();
            $table->boolean('is_illegitimate')->nullable();

            // Academic awards and recognitions
            $table->string('elem_award_honor', 100)->nullable();
            $table->string('hs_award_honor', 100)->nullable();
            $table->string('shs_award_honor', 100)->nullable();


            // Special categories
            $table->boolean('applicant_profile_status')->nullable();

            // Optional wizard tracking
            $table->string('prereg_status')->nullable();
            $table->integer('policyId')->nullable();
            $table->integer('current_step')->default(1);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('stundent_profiles', function (Blueprint $table) {
            //
        });
    }
};
