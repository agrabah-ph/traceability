<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->integer('model_id')->nullable();
            $table->string('model_type')->nullable();
            $table->string('first_name')->nullable();
            $table->string('middle_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('mobile')->nullable();
            $table->text('address')->nullable();
            $table->string('education')->nullable();
            $table->boolean('four_ps')->default(0);
            $table->boolean('pwd')->default(0);
            $table->boolean('indigenous')->default(0);
            $table->boolean('livelihood')->default(0);
            $table->string('farm_lot')->nullable();
            $table->string('farming_since')->nullable();
            $table->string('organization')->nullable();
            $table->string('qr_image')->nullable();
            $table->string('qr_image_path')->nullable();
            $table->string('status')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('branch_name')->nullable();
            $table->string('address_line')->nullable();
            $table->string('account_name')->nullable();
            $table->string('account_number')->nullable();
            $table->string('tin')->nullable();
            $table->string('contact_person')->nullable();
            $table->string('contact_number')->nullable();
            $table->string('designation')->nullable();
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
        Schema::dropIfExists('profiles');
    }
}
