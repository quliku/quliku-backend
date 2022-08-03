<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('contractor_id');
            $table->foreignId('foreman_id');
            $table->string('name');
            $table->string('description')->nullable();
            $table->string('status');
            $table->date('start_date');
            $table->date('end_date');
            $table->string('province');
            $table->string('city');
            $table->string('district');
            $table->string('village');
            $table->string('address');
            $table->decimal('project_area', 10, 2);
            $table->string('payment_type');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
