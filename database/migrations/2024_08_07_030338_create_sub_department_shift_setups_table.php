<?php

use App\Models\ShiftSetup;
use App\Models\SubDepartment;
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
        Schema::create('sub_department_shift_setups', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(SubDepartment::class)->constrained('sub_departments');
            $table->foreignIdFor(ShiftSetup::class)->constrained('shift_setups');
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
        Schema::dropIfExists('sub_department_shift_setups');
    }
};
