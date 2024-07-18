<?php

use App\Models\Department;
use App\Models\Division;
use App\Models\Employee;
use App\Models\EmploymentType;
use App\Models\JobTitle;
use App\Models\SubDepartment;
use App\Models\SubDepartmentUnit;
use App\Models\WorkLocation;
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
        Schema::create('employee_work_assignments', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Employee::class)->constrained('employees');
            $table->foreignIdFor(JobTitle::class)->constrained('job_titles');
            $table->foreignIdFor(WorkLocation::class)->constrained('work_locations');
            $table->foreignIdFor(EmploymentType::class)->constrained('employment_types');
            $table->foreignIdFor(Division::class)->constrained('divisions');
            $table->foreignIdFor(Department::class)->constrained('departments');
            $table->foreignIdFor(SubDepartment::class)->constrained('sub_departments');
            $table->foreignIdFor(SubDepartmentUnit::class)->constrained('sub_department_units');
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->decimal('salary_value')->nullable();
            $table->mediumText('remarks')->nullable();
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
        Schema::dropIfExists('employee_work_assignments');
    }
};
