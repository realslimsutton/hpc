<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('stakes', static function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('small_blind')->index();
            $table->unsignedInteger('big_blind')->index();
            $table->string('name')->virtualAs('concat(\'$\', small_blind, \'/\', big_blind)')->unique();
            $table->timestamps();
        });
    }
};
