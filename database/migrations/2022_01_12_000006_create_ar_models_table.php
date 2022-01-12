<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArModelsTable extends Migration
{
    public function up()
    {
        Schema::create('ar_models', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->integer('code')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
