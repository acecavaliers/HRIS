<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Province;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cities', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Province::class)->constrained('provinces');
            $table->text('flag')->nullable();
            $table->text('seal')->nullable();
            $table->string('short_name')->nullable();
            $table->string('name')->nullable();
            $table->string('description')->nullable();
            $table->string('zip_code')->nullable();
            $table->string('district')->nullable();
            $table->integer('no_of_barangays')->default(0);
            $table->tinyInteger('is_capital')->default(0);
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
        Schema::dropIfExists('cities');
    }
};
