<?php

use App\Models\Employee;
use App\Models\Relationship;
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
        Schema::create('employee_dependents', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Employee::class)->constrained('employees');
            $table->string('dependent_last_name')->nullable();
            $table->string('dependent_first_name')->nullable();
            $table->string('dependent_middle_name')->nullable();
            $table->string('dependent_suffix')->nullable();
            $table->tinyInteger('dependent_no_middle_name')->default(0);
            $table->foreignIdFor(Relationship::class)->constrained('relationships');
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
        Schema::dropIfExists('employee_dependents');
    }
};
