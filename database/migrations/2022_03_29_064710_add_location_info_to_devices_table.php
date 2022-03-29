<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::table('devices', function (Blueprint $table) {
            $table->string('country_name',)->nullable();
            $table->string('country_code',)->nullable();
            $table->string('region_name',)->nullable();
            $table->string('region_code',)->nullable();
            $table->string('city_name',)->nullable();
            $table->string('zip_code',)->nullable();
            $table->string('latitude',)->nullable();
            $table->string('longitude',)->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('devices', function (Blueprint $table) {
            $table->dropColumn(
                'country_name',
                'country_code',
                'region_name',
                'region_code',
                'city_name',
                'zip_code',
                'latitude',
                'longitude'
            );
        });
    }
};
