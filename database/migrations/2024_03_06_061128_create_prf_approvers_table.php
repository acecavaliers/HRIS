<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Employee;
use App\Models\PersonnelRequisition;
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('prf_approvers', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(PersonnelRequisition::class)->nullable()->constrained('personnel_requisitions');
            $table->foreignIdFor(Employee::class)->nullable()->constrained('employees');
            $table->tinyinteger('is_approved')->default(0);
            $table->tinyinteger('is_rejected')->default(0);
            $table->text('rejected_reason')->nullable();
            $table->tinyinteger('is_onhold')->default(0);
            $table->text('onhold_reason')->nullable();
            $table->text('remarks')->nullable();
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
        Schema::dropIfExists('prf_approvers');
    }
};
