<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

namespace ComplimentsModel\data;
use losthost\DB\DBObject;

/**
 * Description of DBComplimentHistory
 *
 * @author 42195
 */
class DBComplimentHistory extends DBObject {

    const TABLE_NAME = 'history';
    
    const SQL_CREATE_TABLE = <<<END
            CREATE TABLE IF NOT EXISTS %TABLE_NAME% (
                id bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
                user bigint(20) UNSIGNED NOT NULL,
                compliment bigint(20) UNSIGNED NOT NULL,
                date_time datetime NOT NULL,
                PRIMARY KEY (id)
            ) COMMENT = 'v1.0.0'
            END;
}
