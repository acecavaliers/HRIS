<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Module;
use App\Models\Submodule;
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('nav_tabs', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Module::class)->constrained('modules');
            $table->foreignIdFor(Submodule::class)->nullable()->constrained('submodules');
            $table->string('tab_name');
            $table->string('component_name');
            $table->string('href');
            $table->tinyInteger('is_current')->default(0);
            $table->tinyInteger('is_default')->default(0);
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
        Schema::dropIfExists('nav_tabs');
    }
};
