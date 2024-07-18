<?php

use App\Models\DayShift;
use App\Models\Employee;
use App\Models\WorkShift;
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
        Schema::create('employee_workshifts', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Employee::class)->constrained('employees');
            $table->foreignIdFor(WorkShift::class)->constrained('work_shifts');
            // $table->foreignIdFor(DayShift::class)->constrained('day_shifts');
            // $table->string('code')->nullable();
            $table->date('period_from')->nullable();
            $table->date('period_to')->nullable();
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
        Schema::dropIfExists('employee_workshifts');
    }
};
