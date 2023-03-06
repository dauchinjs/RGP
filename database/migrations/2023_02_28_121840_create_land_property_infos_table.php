<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    private const TABLE_NAME = 'land_property_infos';

    public function up()
    {
        Schema::create(self::TABLE_NAME, function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('land_property_id');
            $table->foreign('land_property_id')->references('id')->on('land_properties');
            $table->bigInteger('cadastre_number')->unique();
            $table->string('land_usage');
            $table->decimal('total_area');
            $table->date('survey_date');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('land_property_infos');
    }
};
