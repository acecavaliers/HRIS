<?php

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
        Schema::create('day_shifts', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(WorkShift::class)->constrained('work_shifts');
            $table->tinyInteger('work_monday')->default(0);
            $table->tinyInteger('work_tuesday')->default(0);
            $table->tinyInteger('work_wednesday')->default(0);
            $table->tinyInteger('work_thursday')->default(0);
            $table->tinyInteger('work_friday')->default(0);
            $table->tinyInteger('work_saturday')->default(0);
            $table->tinyInteger('work_sunday')->default(0);
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
        Schema::dropIfExists('day_shifts');
    }
};
