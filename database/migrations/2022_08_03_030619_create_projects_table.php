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
            $table->foreignId('contractor_id')->constrained('users');
            $table->foreignId('foreman_id')->constrained('users');
            $table->string('name');
            $table->string('description')->nullable();
            $table->enum('status', ['waiting', 'not_paid','ongoing', 'done', 'reject'])->default('waiting');
            $table->date('start_date');
            $table->date('end_date');
            $table->string('province');
            $table->string('city');
            $table->string('district');
            $table->string('village');
            $table->string('address');
            $table->decimal('total_price', 14);
            $table->string('document_url')->nullable();
            $table->unsignedInteger('fix_people')->nullable();
            $table->decimal('transportation_fee',14)->nullable();
            $table->decimal('already_paid', 14)->default(0);
            $table->enum('payment_type', ['daily', 'bulk'])->default('daily');
            $table->string('wa_number');
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
