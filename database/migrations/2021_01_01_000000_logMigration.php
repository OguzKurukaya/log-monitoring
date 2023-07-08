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
        Schema::dropIfExists('logs');
        Schema::create('logs', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->json('stacktree');
            $table->enum(
                'type',
                [
                    1,2,3,4,5,6,7,8,0
                ]
            );
            $table->string('message');
            $table->json('tag')->nullable();
            $table->json('class')->nullable();
            $table->json('function')->nullable();
            $table->string('user_id')->nullable();
            $table->boolean('show')->default(true);
            $table->timestamp('failed_at')->nullable()->default(now()->format("Y-m-d H:i:s"));
        });
    }
/**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('logs');
    }
};
