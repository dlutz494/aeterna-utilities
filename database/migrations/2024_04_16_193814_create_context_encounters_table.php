<?php

use App\Models\Context;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('context_encounters', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Context::class)->nullable();
            $table->foreignId('encounter_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->integer('weight')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('context_encounters');
    }
};
