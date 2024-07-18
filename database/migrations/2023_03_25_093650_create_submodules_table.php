<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Module;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('submodules', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Module::class)->constrained('modules');
            $table->string('name')->nullable();
            $table->text('description')->nullable();
            $table->string('icon')->nullable();
            $table->string('href')->nullable();
            $table->string('url_name')->nullable();
            $table->string('model_name')->nullable();
            $table->tinyInteger('is_current')->default(0);
            $table->tinyInteger('has_tabs')->default(0);
            $table->integer('order')->default(0);
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
        Schema::dropIfExists('submodules');
    }
};
