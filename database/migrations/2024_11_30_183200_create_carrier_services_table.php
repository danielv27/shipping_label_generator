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
            $table->foreignId('carrier_id')->constrained('carriers')->onDelete('cascade');
            $table->string('name');
            $table->string('scope');
            $table->timestamps();
            $table->unique(['carrier_id', 'scope']);
        });
        
    }

    public function down(): void
    {
        Schema::dropIfExists('carrier_services');
    }
};
