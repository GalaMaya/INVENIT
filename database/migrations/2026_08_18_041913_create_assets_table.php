<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('assets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained()->cascadeOnDelete();
            
            $table->string('name');
            $table->string('brand')->nullable();
            $table->string('model')->nullable();
            $table->string('serial_number')->unique()->nullable();
            
            $table->enum('status', ['available', 'in_use', 'damaged'])->default('available');
            
            $table->string('location')->nullable()->comment('Lokasi fisik, misal: Gudang, Rak A, Lantai 2');
            $table->date('purchase_date')->nullable();
            
            $table->text('notes')->nullable()->comment('Catatan umum, kondisi, atau riwayat kerusakan');
            
           
            $table->index('status');
            $table->index('serial_number');
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('assets');
    }
};