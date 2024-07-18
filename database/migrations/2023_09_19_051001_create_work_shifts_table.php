<?php

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
        Schema::create('work_shifts', function (Blueprint $table) {
            $table->id();
            $table->string('shift_name')->nullable();
            $table->time('time_from')->nullable();
            $table->time('time_to')->nullable();
            $table->tinyInteger('enable_shift_margin')->default(0);
            $table->time('hrs_before_shift_starts')->nullable();
            $table->time('hrs_after_shift_ends')->nullable();
            $table->tinyInteger('enable_oncall')->default(0);
            $table->decimal('oncall_rate_per_day')->nullable();
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
        Schema::dropIfExists('work_shifts');
    }
};
