<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\DataType;
use App\Models\FormType;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('data_type_form_type', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(DataType::class)->nullable()->constrained('data_types');
            $table->foreignIdFor(FormType::class)->nullable()->constrained('form_types');
            $table->tinyInteger('is_default')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_type_form_type');
    }
};
