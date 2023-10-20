<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

namespace ComplimentsModel\data;
use losthost\DB\DBObject;
/**
 * Description of DBUser
 *
 * @author 42195
 */
class DBUser extends DBObject {

    const TABLE_NAME = 'users';
    
    const SQL_CREATE_TABLE = <<<END
            CREATE TABLE IF NOT EXISTS %TABLE_NAME% (
                id bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
                user_name varchar(128) NOT NULL DEFAULT '',
                gender varchar(1),
                interval_start varchar(5),
                interval_end varchar(5),
                telegram_id bigint(20),
                PRIMARY KEY (id),
                UNIQUE INDEX TELEGRAM_ID (telegram_id)
            ) COMMENT = 'v1.0.0'
            END;
}
