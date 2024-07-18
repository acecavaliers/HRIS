<?php

use App\Models\CodeOfDiscipline;
use App\Models\OffenseDetail;
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
        Schema::create('offenses_classifications', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(OffenseDetail::class)->constrained('offense_details');
            $table->foreignIdFor(CodeOfDiscipline::class)->constrained('code_of_disciplines');
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
        Schema::dropIfExists('offenses_classifications');
    }
};
