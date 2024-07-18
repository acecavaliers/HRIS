<?php

use App\Models\SubDepartmentUnit;
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
        Schema::create('sub_department_unit_shifts', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(SubDepartmentUnit::class)->constrained('sub_department_units');
            $table->foreignIdFor(WorkShift::class)->constrained('work_shifts');
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
        Schema::dropIfExists('sub_department_unit_shifts');
    }
};
