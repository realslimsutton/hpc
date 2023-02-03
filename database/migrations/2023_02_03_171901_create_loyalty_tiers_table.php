<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('loyalty_tiers', static function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->unsignedBigInteger('lp_requirement')->unique();
            $table->foreignId('featured_image_id')->nullable()->index()->constrained('media')->nullOnDelete();
            $table->timestamps();
        });
    }
};
