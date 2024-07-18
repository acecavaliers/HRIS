<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Region;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('provinces', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Region::class)->constrained('regions');
            $table->text('flag')->nullable();
            $table->text('seal')->nullable();
            $table->string('short_name')->nullable();
            $table->string('name')->nullable();
            $table->string('description')->nullable();
            $table->integer('no_of_cities')->default(0);
            $table->integer('no_of_municipalities')->default(0);
            $table->integer('no_of_barangays')->default(0);
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
        Schema::dropIfExists('provinces');
    }
};
