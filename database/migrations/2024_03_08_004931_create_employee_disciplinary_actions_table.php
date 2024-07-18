<?php

use App\Models\Employee;
use App\Models\OffensesClassification;
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
        Schema::create('employee_disciplinary_actions', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Employee::class)->constrained('employees');
            $table->foreignIdFor(OffensesClassification::class)->constrained('offenses_classifications');
            $table->date('date_acted')->nullable();
            $table->date('date_start')->nullable();
            $table->date('date_end')->nullable();
            $table->tinyInteger('is_active')->default(1);
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->string('deleted_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_disciplinary_actions');
    }
};
