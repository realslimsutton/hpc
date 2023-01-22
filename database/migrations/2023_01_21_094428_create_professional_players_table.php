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
    public function up()
    {
        Schema::create('professional_players', static function (Blueprint $table) {
            $table->id();
            $table->string('name')->index();
            $table->text('biography');
            $table->boolean('enabled')->index();
            $table->foreignId('featured_image_id')->nullable()->index()->constrained('media')->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('professional_players');
    }
};
