<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sessions', static function (Blueprint $table) {
            $table->id();
            $table->string('name')->index();
            $table->dateTime('date')->index();
            $table->text('stream_url')->nullable();
            $table->foreignId('location_id')->index()->constrained()->cascadeOnDelete();
            $table->foreignId('game_rules_id')->index()->constrained()->cascadeOnDelete();
            $table->foreignId('stake_id')->index()->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }
};
