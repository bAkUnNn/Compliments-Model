<?php

use losthost\DB\DB;

require_once '../etc/config.php';
require_once '../vendor/autoload.php';

DB::connect(DB_HOST, DB_USER, DB_PASS, DB_NAME, DB_PREF);
DB::dropAllTables(true, true);