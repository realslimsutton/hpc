<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('players', static function (Blueprint $table) {
            $table->id();
            $table->string('name')->index();
            $table->string('nickname')->nullable()->index();
            $table->text('biography')->nullable();
            $table->string('profession')->nullable()->index();
            $table->dateTime('date_of_birth')->nullable();
            $table->text('twitter_url')->nullable();
            $table->string('twitter_handle')->nullable()->index();
            $table->string('country_id')->nullable()->index();
            $table->string('hometown')->nullable();
            $table->foreignId('featured_image_id')->nullable()->index()->constrained('media')->nullOnDelete();
            $table->boolean('enabled')->default(false);
            $table->timestamps();
        });
    }
};
