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
        Schema::create('request_time_offs', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Employee::class)->constrained('employees');
            $table->date('date_from');
            $table->date('date_to');
            $table->decimal('number_of_days', 3, 1);
            $table->string('reason');
            $table->tinyInteger('status')->default(0);
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
        Schema::dropIfExists('request_time_offs');
    }
};
