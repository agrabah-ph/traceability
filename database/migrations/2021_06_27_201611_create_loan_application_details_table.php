<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoanApplicationDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loan_application_details', function (Blueprint $table) {
            $table->id();
            $table->integer('loan_id')->nullable();
            $table->text('info_loan_detail')->nullable();
            $table->text('credit_financial_info')->nullable();
            $table->text('trade_reference_info')->nullable();
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
        Schema::dropIfExists('loan_application_details');
    }
}
