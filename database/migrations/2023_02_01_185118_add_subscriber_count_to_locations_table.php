<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('locations', static function (Blueprint $table) {
            $table->string('subscriber_count')->nullable()->after('name');
        });
    }
};
