<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('club_updates', static function (Blueprint $table) {
            $table->id();
            $table->dateTime('date')->index();
            $table->foreignId('user_id')->index()->nullable()->constrained()->nullOnDelete();
            $table->timestamps();
        });
    }
};
