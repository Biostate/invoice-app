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
        Schema::create('invoices', function (Blueprint $table) {
            $table->string('id')->primary();

            $table->string('from_street_address');
            $table->string('from_city');
            $table->string('from_post_code');
            $table->string('from_country');

            $table->string('client_name');
            $table->string('client_email');
            $table->string('to_street_address');
            $table->string('to_city');
            $table->string('to_post_code');
            $table->string('to_country');

            $table->longText('description');
            $table->integer('payment_terms')->default(1);
            $table->string('status');
            $table->double('total')->default(0);
            $table->date('payment_due');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
