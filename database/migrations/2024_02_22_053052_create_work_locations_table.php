<?php

use App\Models\Barangay;
use App\Models\City;
use App\Models\Country;
use App\Models\Province;
use App\Models\Region;
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
        Schema::create('work_locations', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->text('description')->nullable();
            $table->text('address')->nullable();
            $table->string('contact_no')->nullable();
            $table->string('email_address')->nullable();
            $table->foreignIdFor(Country::class)->constrained('countries');
            $table->foreignIdFor(Region::class)->constrained('regions');
            $table->foreignIdFor(Province::class)->constrained('provinces');
            $table->foreignIdFor(City::class)->constrained('cities');
            $table->foreignIdFor(Barangay::class)->constrained('barangays');
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
        Schema::dropIfExists('work_locations');
    }
};
