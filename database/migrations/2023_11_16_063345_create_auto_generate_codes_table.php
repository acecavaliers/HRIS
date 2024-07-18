<?php

use App\Models\SystemTableDetail;
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
        Schema::create('auto_generate_codes', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(SystemTableDetail::class)->constrained('system_table_details');
            $table->string('prefix');
            $table->integer('no_of_digits');
            $table->integer('no_start_from');
            $table->integer('no_end_from');
            $table->integer('current_no');
            $table->integer('next_no');
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
        Schema::dropIfExists('auto_generate_codes');
    }
};
