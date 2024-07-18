<?php

use App\Models\Specialization;
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
        Schema::create('sub_specializations', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Specialization::class)->constrained('specializations');
            $table->string('code')->nullable();
            $table->string('short_name')->nullable();
            $table->string('name')->nullable();
            $table->text('description')->nullable();
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
        Schema::dropIfExists('sub_specializations');
    }
};
