<?php

use App\Models\DepartmentShift;
use App\Models\DivisionShift;
use App\Models\EmployeeWorkshift;
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
        Schema::create('employee_workshifts_details', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(EmployeeWorkshift::class)->constrained('employee_workshifts');
            $table->date('schedule_date')->nullable();
            $table->string('schedule_day')->nullable();
            $table->string('shift_start')->nullable();
            $table->string('shift_end')->nullable();
            $table->tinyInteger('oc')->default(0);
            $table->bigInteger('division_shift_id')->nullable();
            $table->bigInteger('department_shift_id')->nullable();
            $table->bigInteger('sub_department_shift_id')->nullable();
            $table->bigInteger('sub_department_unit_id')->nullable();
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
        Schema::dropIfExists('employee_workshifts_details');
    }
};
