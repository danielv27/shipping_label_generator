<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('labels', function (Blueprint $table) {
            $table->id(); 
            $table->string('barcode')->unique(); 
            $table->string('recipient_name'); 
            $table->string('recipient_street'); 
            $table->string('recipient_postal_code'); 
            $table->string('recipient_city'); 
            $table->string('recipient_country'); 
            $table->foreignId('carrier_service_id')->constrained('carrier_services')->onDelete('cascade'); 
            $table->timestamps(); 
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('labels');
    }
};
