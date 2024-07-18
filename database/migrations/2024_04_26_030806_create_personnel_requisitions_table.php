<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\JobTitle;
use App\Models\Division;
use App\Models\Department;
use App\Models\SubDepartment;
use App\Models\SubDepartmentUnit;
use App\Models\EmployeeType;
use App\Models\PrfReasonForReq;
use App\Models\PrfStatus;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('personnel_requisitions', function (Blueprint $table) {
            $table->id();
            $table->string('prf_code')->nullable();
            $table->foreignIdFor(JobTitle::class)->nullable()->constrained('job_titles');
            $table->foreignIdFor(Division::class)->nullable()->constrained('divisions');
            $table->foreignIdFor(Department::class)->nullable()->constrained('departments');
            $table->foreignIdFor(SubDepartment::class)->nullable()->constrained('sub_departments');
            $table->foreignIdFor(SubDepartmentUnit::class)->nullable()->constrained('sub_department_units');
            $table->foreignIdFor(EmployeeType::class)->nullable()->constrained('employee_types');
            $table->date('date_filed')->nullable();
            $table->string('reports_to')->nullable();
            $table->integer('number_needed')->default(0);
            $table->date('date_needed')->nullable();
            $table->tinyInteger('is_immediately')->default(0);
            $table->tinyInteger('is_budgeted')->default(0);
            $table->foreignIdFor(PrfReasonForReq::class)->nullable()->constrained('prf_reason_for_reqs');
            $table->string('preferred_gender')->nullable();
            $table->mediumText('education')->nullable();
            $table->mediumText('experiences_required')->nullable();
            $table->mediumText('skillstraining_required')->nullable();
            $table->mediumText('licenses_or_certificates')->nullable();
            $table->mediumText('other_qualifications_needed')->nullable();
            $table->string('requested_by')->nullable();
            $table->dateTime('requested_datetime')->nullable();
            $table->string('endorsed_by')->nullable();
            $table->dateTime('endorsed_datetime')->nullable();
            $table->string('received_by')->nullable();
            $table->dateTime('received_datetime')->nullable();
            $table->string('validated_by')->nullable();
            $table->dateTime('validated_datetime')->nullable();
            $table->tinyInteger('is_final_approved')->default(0);
            $table->dateTime('approved_datetime')->nullable();
            $table->foreignIdFor(PrfStatus::class)->nullable()->constrained('prf_statuses');
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
        Schema::dropIfExists('personnel_requisitions');
    }
};
