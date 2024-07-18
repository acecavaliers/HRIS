<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\FormType;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('system_table_details', function (Blueprint $table) {
            $table->foreignIdFor(FormType::class)->nullable()->constrained('form_types');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('system_table_details', function (Blueprint $table) {
            Schema::dropIfExists('form_type_id');
        });
    }
};
