<?php

use App\Models\Specialization;
use App\Models\SubSpecialization;
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
        Schema::create('doctors', function (Blueprint $table) {
            $table->id();
            $table->string('prefix_name')->nullable();
            $table->string('first_name')->nullable();
            $table->string('middle_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('suffix')->nullable();
            $table->string('professional_suffix')->nullable();
            $table->tinyInteger('no_middle_name')->default(0);
            $table->string('gender')->nullable();
            $table->string('civil_status')->nullable();
            $table->string('birth_date')->nullable();
            $table->string('nationality')->nullable();
            $table->string('religion')->nullable();
            $table->string('contactinfo_landlineno')->nullable();
            $table->string('contactinfo_mobileno')->nullable();
            $table->string('street')->nullable();
            $table->string('bldgsubd')->nullable();
            $table->string('region')->nullable();
            $table->string('province')->nullable();
            $table->string('city')->nullable();
            $table->string('barangay')->nullable();
            $table->string('zipcode')->nullable();
            $table->string('country')->nullable();
            $table->string('email_address')->nullable();
            $table->string('blood_type')->nullable();
            $table->foreignIdFor(Specialization::class)->constrained('specializations');
            $table->foreignIdFor(SubSpecialization::class)->constrained('sub_specializations');
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
        Schema::dropIfExists('doctors');
    }
};
