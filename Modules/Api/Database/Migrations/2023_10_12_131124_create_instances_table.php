<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInstancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::connection('sqlite')->hasTable('instances')) {
            Schema::connection('sqlite')->create('instances', function (Blueprint $table) {
                $table->id();
                $table->unsignedInteger('vendor_id');
                $table->string('name');
                $table->string('status');
                $table->string('user');
                $table->string('path');
                $table->timestamps();
            });
        }

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('instances');
    }
}
