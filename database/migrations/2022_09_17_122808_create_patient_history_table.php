<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patient_history', function (Blueprint $table) {
            // $table->engine = 'InnoDB';

            $table->id();
            $table->unsignedBigInteger('patient_id');
            $table->unsignedBigInteger('doctor_id');
            $table->text('doctor_advice')->nullable();
            $table->text('patient_condition')->nullable();
            $table->string('picture_name', 200)->nullable();
            $table->timestamps();

            $table->foreign('patient_id')->nullable()->references('id')->on('patients')->onDelete('cascade');
            $table->foreign('doctor_id')->nullable()->references('id')->on('doctors')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('patient_history', function (Blueprint $table) {
            $table->dropForeign('patient_history_patient_id_foreign');
            $table->dropForeign('patient_history_doctor_id_foreign');
        });
        Schema::dropIfExists('patient_history');
    }
};
