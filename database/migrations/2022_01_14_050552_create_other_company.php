<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateOtherCompany extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("
            SET FOREIGN_KEY_CHECKS = 0;
            ALTER TABLE company DISABLE KEYS;
            INSERT INTO company(id,name,email,business_plan_id) VALUES (0,'other','other@info.com',1);
            UPDATE company SET id = 0 WHERE `name` = 'other';
            ALTER TABLE company ENABLE KEYS;
            SET FOREIGN_KEY_CHECKS = 1;
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

    }
}
