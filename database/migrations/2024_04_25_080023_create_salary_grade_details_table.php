<?php

use App\Models\SalaryGrade;
use App\Models\SalaryStandardization;
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
        Schema::create('salary_grade_details', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(SalaryStandardization::class)->constrained('salary_standardizations');
            $table->foreignIdFor(SalaryGrade::class)->constrained('salary_grades');
            $table->string('code')->nullable();
            $table->string('short_name')->nullable();
            $table->string('name')->nullable();
            $table->text('description')->nullable();
            $table->decimal('amount_value')->nullable();
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
        Schema::dropIfExists('salary_grade_details');
    }
};
