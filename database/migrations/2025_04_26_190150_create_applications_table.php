<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->id('ApplicationId');
            $table->foreignId('ApplicantId')->constrained('applicants', 'ApplicantId')->onDelete('cascade');
            $table->foreignId('JobId')->constrained('job_positions', 'JobId')->onDelete('cascade');
            $table->string('ApplicationStatus');
            $table->date('ReviewDate')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};