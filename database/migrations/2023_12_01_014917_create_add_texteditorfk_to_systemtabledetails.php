<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\TextEditor;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('system_table_details', function (Blueprint $table) {
           $table->foreignIdFor(TextEditor::class)->nullable()->constrained('text_editors');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('system_table_details', function (Blueprint $table) {
           $table->dropForeign(['text_editor_id']);
           $table->dropColumn('text_editor_id');
        });
    }
};
