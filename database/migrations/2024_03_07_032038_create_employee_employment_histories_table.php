<?php

use App\Models\Employee;
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
        Schema::create('employee_employment_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Employee::class)->constrained('employees');
            $table->string('company_name')->nullable();
            $table->text('company_address')->nullable();
            $table->string('company_contactno')->nullable();
            $table->string('from_date')->nullable();
            $table->string('to_date')->nullable();
            $table->string('job_title')->nullable();
            $table->decimal('salary_on_leaving')->nullable();
            $table->string('designation_on_joining')->nullable();
            $table->string('designation_on_leaving')->nullable();
            $table->string('industry_type')->nullable();
            $table->text('roles_and_responsibilities')->nullable();
            $table->text('key_experiences')->nullable();
            $table->text('reason_for_leaving')->nullable();
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
        Schema::dropIfExists('employee_employment_histories');
    }
};
