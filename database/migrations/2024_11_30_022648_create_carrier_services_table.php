<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('carrier_services', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('scope'); // Either the name of the country or international
            $table->decimal('price_up_to_1kg', 8, 2);
            $table->decimal('price_up_to_10kg', 8, 2);
            $table->decimal('price_above_10kg', 8, 2);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('carrier_services');
    }
};
