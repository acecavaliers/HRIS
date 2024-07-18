<?php

use App\Models\ApplicationSource;
use App\Models\Employee;
use App\Models\EmployeeStatus;
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
        Schema::create('employee_employment_details', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Employee::class)->constrained('employees');
            $table->string('employment_contract_no')->nullable();
            $table->string('employment_number')->nullable();
            $table->date('confirmation_due_date')->nullable();
            $table->date('confirmed_date')->nullable();
            $table->date('date_of_joining')->nullable();
            $table->date('effective_date')->nullable();
            $table->date('end_date')->nullable();
            $table->foreignIdFor(EmployeeStatus::class)->constrained('employee_statuses');
            $table->foreignIdFor(ApplicationSource::class)->constrained('application_sources');
            $table->string('job_title')->nullable();
            $table->decimal('salary')->nullable();
            $table->string('contract')->nullable();
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
        Schema::dropIfExists('employee_employment_details');
    }
};
