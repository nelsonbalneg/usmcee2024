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
        Schema::create('ched_applicant_profiles', function (Blueprint $table) {
            $table->id();
            $table->string('app_no')->unique();
            $table->integer('user_id')->unique();

            // PERSONAL INFORMATION
            // 1.Student Category
            $table->enum('student_category', ['0', '1']);
            $table->string('student_category_new_type')->nullable();
            $table->string('student_category_old_type')->nullable();

            //2. Deped LRN
            $table->string('lrn')->nullable();

            //3. Name
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name');
            $table->string('suffix')->nullable();

            $table->string('email');
            $table->string('phone')->nullable();
            $table->text('photo')->nullable();

            //4. Home Address
            $table->string('house_hould_no');
            $table->string('region');
            $table->string('province');
            $table->string('city');
            $table->string('brgy');
            $table->text('street');
            $table->string('zipcode');

            //5. Sex and birthdate and birthplace
            $table->string('sex');
            $table->date('birthdate');
            $table->string('birthplace');
            $table->string('civil_status')->nullable();
            // $table->string('civil_status_others')->nullable();

            //6 Citizenship and religion
            $table->string('religion');
            $table->string('citizenship');

            //7. First Generation student
            $table->enum('first_generation_student', ['0', '1']);

            //8. Other Information
            $table->enum('is_4ps_beneficiary', ['0', '1']);
            $table->string('is_4ps_beneficiary_id')->nullable();

            $table->enum('is_solo_parent', ['0', '1']);
            $table->string('is_solo_parent_id')->nullable();

            $table->enum('is_raised_by_solo_parent', ['0', '1']);
            $table->enum('is_pwd', ['0', '1']);
            $table->string('is_pwd_desc')->nullable();
            $table->string('is_pwd_id')->nullable();

            $table->enum('is_gida', ['0', '1']);
            $table->string('is_gida_desc')->nullable();

            $table->enum('is_ip', ['0', '1']);
            $table->string('is_ip_type')->nullable();

            $table->enum('is_belong_to_farmer', ['0', '1']);
            $table->enum('is_rebel_returnee', ['0', '1']);


            //9. Family Background
            // father complete name
            $table->string('father_name');
            $table->string('father_age');
            $table->string('father_citizenship');

            //father highest educational attainment and occupation
            $table->string('father_highest_educational_attainment');
            $table->string('father_employment_status');
            $table->string('father_occupation');


            //mother highest educational attainment and occupation
            $table->string('mother_name');
            $table->string('mother_age');
            $table->string('mother_citizenship');

            $table->string('mother_highest_educational_attainment');
            $table->string('mother_employment_status');
            $table->string('mother_occupation');

            $table->string('family_size');
            $table->string('monthly_income');

            //10. educational background
            $table->string('type_of_school');
            $table->string('school_name');
            $table->string('last_school_year_attended');

            $table->string('shs_track')->nullable();
            $table->string('shs_school')->nullable();
            $table->string('shs_school_year')->nullable();

            $table->enum('is_adm', ['0', '1']);
            $table->string('adm_school')->nullable();
            $table->string('adm_school_year')->nullable();

            $table->enum('is_als', ['0', '1']);
            $table->string('als_school')->nullable();
            $table->string('als_school_year')->nullable();

            $table->string('i_agree')->nullable();

            $table->enum('status', ['0', '1'])->default('0');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ched_applicant_profiles');
    }
};
