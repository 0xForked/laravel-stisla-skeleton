<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccessActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('access_activities', function (Blueprint $table) {
            $table->increments('id');
            $table->longText('description');
            $table->string('userType');
            $table->integer('userId')->nullable();
            $table->longText('route')->nullable();
            $table->ipAddress('ipAddress')->nullable();
            $table->text('userAgent')->nullable();
            $table->string('locale')->nullable();
            $table->longText('referer')->nullable();
            $table->string('methodType')->nullable();
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
        Schema::dropIfExists('access_activities');
    }
}
