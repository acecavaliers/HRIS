<?php

use App\Models\JobLevel;
use App\Models\JobTitleCategory;
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
        Schema::create('job_titles', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(JobLevel::class)->constrained('job_levels');
            $table->foreignIdFor(JobTitleCategory::class)->constrained('job_title_categories');
            $table->string('name')->nullable();
            $table->text('job_description')->nullable();
            $table->text('roles_and_responsibilities')->nullable();
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
        Schema::dropIfExists('job_titles');
    }
};
