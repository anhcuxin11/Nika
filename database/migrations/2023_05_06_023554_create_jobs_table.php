<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('company_id')->index();
            $table->string('job_no');
            $table->string('job_title');
            $table->text('job_detail');
            $table->integer('job_status')->default(1);
            $table->text('location_detail')->nullable();
            $table->tinyInteger('english_level')->nullable();
            $table->tinyInteger('experienced_count')->nullable();
            $table->tinyInteger('education')->nullable();
            $table->tinyInteger('age_min')->nullable();
            $table->tinyInteger('age_max')->nullable();
            $table->text('must_condition')->nullable();
            $table->text('position_name')->nullable();
            $table->tinyInteger('salary_type')->nullable();
            $table->integer('salary_min');
            $table->integer('salary_max');
            $table->text('salary_detail')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jobs');
    }
}
