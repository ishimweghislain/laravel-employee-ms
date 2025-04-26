<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('recruitment_stages', function (Blueprint $table) {
            $table->id('StageId');
            $table->foreignId('ApplicationId')->constrained('applications', 'ApplicationId')->onDelete('cascade');
            $table->string('StageName');
            $table->string('StageStatus');
            $table->date('CompletionDate')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('recruitment_stages');
    }
};