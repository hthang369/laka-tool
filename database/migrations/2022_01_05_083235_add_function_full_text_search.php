<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class AddFunctionFullTextSearch extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $database_name = DB::getDatabaseName();
        DB::unprepared("ALTER DATABASE $database_name CHARACTER SET utf8 COLLATE utf8_unicode_ci;");
        DB::unprepared('DROP FUNCTION IF EXISTS fnc_LocDauTV');
        DB::unprepared("CREATE FUNCTION `fnc_LocDauTV`(strInput varchar(255)) RETURNS varchar(255)
        DETERMINISTIC
        BEGIN
            DECLARE sign_char varchar(136);
            DECLARE unsign_char varchar(136);
            declare i int;
            set sign_char   = 'àáạảãâầấậẩẫăằắặẳẵèéẹẻẽêềếệểễìíịỉĩòóọỏõôồốộổỗơờớợởỡùúụủũưừứựửữỳýỵỷỹđÀÁẠẢÃÂẦẤẬẨẪĂẰẮẶẲẴÈÉẸẺẼÊỀẾỆỂỄÌÍỊỈĨÒÓỌỎÕÔỒỐỘỔỖƠỜỚỢỞỠÙÚỤỦŨƯỪỨỰỬỮỲÝỴỶỸĐ';
            set unsign_char = 'aaaaaaaaaaaaaaaaaeeeeeeeeeeeiiiiiooooooooooooooooouuuuuuuuuuuyyyyydAAAAAAAAAAAAAAAAAEEEEEEEEEEEIIIIIOOOOOOOOOOOOOOOOOUUUUUUUUUUUYYYYYD';
            set i = 1;
            WHILE i <= length(unsign_char) DO
                SET strInput = replace(strInput,substring(sign_char,i,1),substring(unsign_char,i,1));
                SET i = i + 1;
            END WHILE;
            RETURN strInput;
        END;");

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP FUNCTION IF EXISTS fnc_LocDauTV');
    }
}
