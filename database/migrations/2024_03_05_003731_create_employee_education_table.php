<?php

use App\Models\Course;
use App\Models\CourseCategory;
use App\Models\Education;
use App\Models\EducationLevel;
use App\Models\Employee;
use App\Models\School;
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
        Schema::create('employee_education', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Employee::class)->constrained('employees');
            $table->foreignIdFor(Education::class)->constrained('education');
            $table->foreignIdFor(EducationLevel::class)->constrained('education_levels');
            $table->foreignIdFor(School::class)->constrained('schools');
            $table->string('attended_from')->nullable();
            $table->string('attended_to')->nullable();
            $table->foreignIdFor(CourseCategory::class)->constrained('course_categories');
            $table->foreignIdFor(Course::class)->constrained('courses');
            $table->tinyInteger('is_company_sponsored')->default(0);
            $table->tinyInteger('is_graduated')->default(0);
            $table->string('gpa_grade')->nullable();
            $table->tinyInteger('is_active')->default(1);
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->string('deleted_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_education');
    }
};
