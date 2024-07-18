<?php

use App\Models\EmployeeEmploymentDetail;
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
        Schema::table('employee_work_assignments', function (Blueprint $table) {
            $table->foreignIdFor(EmployeeEmploymentDetail::class)->nullable()->constrained('employee_employment_details');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('employee_work_assignments', function (Blueprint $table) {
            $table->dropForeign(['employee_employment_detail_id']);
            $table->dropColumn('employee_employment_detail_id');
        });
    }
};
