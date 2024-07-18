<?php

use App\Models\ApplicationSource;
use App\Models\PersonnelRequisition;
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
        Schema::create('applicants', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(PersonnelRequisition::class)->nullable()->constrained('personnel_requisitions');
            $table->foreignIdFor(ApplicationSource::class)->nullable()->constrained('application_sources');
            $table->string('applicant_code')->nullable();
            $table->string('last_name')->nullable();
            $table->string('first_name')->nullable();
            $table->string('middle_name')->nullable();
            $table->tinyInteger('has_no_middlename')->default(0);
            $table->string('suffix')->nullable();
            $table->string('email_address')->nullable();
            $table->string('contact_number')->nullable();
            $table->string('address_street')->nullable();
            $table->string('address_bldgorsubd')->nullable();
            $table->string('address_province')->nullable();
            $table->string('address_towncity')->nullable();
            $table->string('address_zipcode')->nullable();
            $table->string('address_region')->nullable();
            $table->string('address_country')->nullable();
            $table->string('address_barangay')->nullable();
            $table->string('cover_letter')->nullable();
            $table->string('curriculum_vitae')->nullable();
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
        Schema::dropIfExists('applicants');
    }
};
