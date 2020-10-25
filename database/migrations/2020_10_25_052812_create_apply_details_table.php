<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApplyDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apply_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('apply_id')->index();
            $table->foreign('apply_id')->references('id')->on('applies')->onDelete('cascade');
            $table->string('last_name');
            $table->string('first_name');
            $table->string('postcode')->comment('郵便番号');
            $table->string('prefecture')->comment('都道府県');
            $table->string('city')->comment('市町村');
            $table->string('gender');
            $table->string('age');
            $table->string('phone1');
            $table->string('phone2');
            $table->string('phone3');
            $table->string('occupation');
            $table->string('final_education')->comment('最終学歴');
            $table->string('work_start_date')->comment('勤務開始可能日');
            $table->text('job_msg')->comment('志望動機')->nullable();
            $table->text('job_q1')->nullable();
            $table->text('job_q2')->nullable();
            $table->text('job_q3')->nullable();
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
        Schema::dropIfExists('apply_details');
    }
}
