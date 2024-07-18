<?php

use App\Models\DisciplinaryAction;
use App\Models\OffenseCategory;
use App\Models\OffenseSeverity;
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
        Schema::create('code_of_disciplines', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(OffenseCategory::class)->constrained('offense_categories');
            $table->foreignIdFor(OffenseSeverity::class)->constrained('offense_severities');
            $table->foreignIdFor(DisciplinaryAction::class)->constrained('disciplinary_actions');
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
        Schema::dropIfExists('code_of_disciplines');
    }
};
