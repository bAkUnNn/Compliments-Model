<?php

namespace megahard\ComplimentsModel\data;
use \losthost\DB\DBObject;

class DBCompliment extends DBObject {
    
    const TABLE_NAME = 'compliments';
    
    const SQL_CREATE_TABLE = <<<END
            CREATE TABLE IF NOT EXISTS %TABLE_NAME% (
                id bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
                compliment varchar(512) NOT NULL DEFAULT '',
                for_male tinyint(1) not null,
                for_female tinyint(1) not null,
                PRIMARY KEY (id)
            ) COMMENT = 'v1.0.0'
            END;
}
