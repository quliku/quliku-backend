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
        Schema::create('foreman_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->enum('subscription_type', ['regular', 'premium'])->default('regular');
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->boolean('is_work')->default(false);
            $table->string('city');
            $table->string('wa_number');
            $table->enum('classification', ['water','infra','craft'])->default('water');
            $table->text('description')->nullable();
            $table->integer('experience');
            $table->integer('min_people');
            $table->integer('max_people');
            $table->string('bank_type');
            $table->string('account_name');
            $table->string('account_number');
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
        Schema::dropIfExists('foreman_details');
    }
};
