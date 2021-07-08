<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loans', function (Blueprint $table) {
            $table->id();
            $table->integer('borrower_id')->nullable();
            $table->string('borrower_type')->nullable();
            $table->integer('loan_provider_id');
            $table->integer('loan_product_id');
            $table->enum('status', array('Pending', 'Active', 'Completed', 'Declined'));
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->double('penalty')->nullable();
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
        Schema::dropIfExists('loans');
    }
}
