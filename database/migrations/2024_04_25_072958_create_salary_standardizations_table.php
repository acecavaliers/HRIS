<?php

use App\Models\Country;
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
        Schema::create('salary_standardizations', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Country::class)->constrained('countries');
            $table->string('code')->nullable();
            $table->string('short_name')->nullable();
            $table->string('name')->nullable();
            $table->text('description')->nullable();
            $table->date('effectivity_date')->nullable();
            $table->date('end_date')->nullable();
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
        Schema::dropIfExists('salary_standardizations');
    }
};
