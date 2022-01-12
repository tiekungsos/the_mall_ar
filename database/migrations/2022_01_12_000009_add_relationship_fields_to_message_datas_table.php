<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToMessageDatasTable extends Migration
{
    public function up()
    {
        Schema::table('message_datas', function (Blueprint $table) {
            $table->unsignedBigInteger('model_id')->nullable();
            $table->foreign('model_id', 'model_fk_5783764')->references('id')->on('ar_models');
        });
    }
}
