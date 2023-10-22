<?php

namespace megahard\ComplimentsModel;
use PHPUnit\Framework\TestCase;
use megahard\ComplimentsModel\data\DBUser;
use megahard\ComplimentsModel\data\DBCompliment;
use megahard\ComplimentsModel\data\DBComplimentHistory;
use megahard\ComplimentsModel\User;
use megahard\ComplimentsModel\Compliment;
use losthost\DB\DBView;

class ComplimentHistory {
    
    
   public function add(DBUser $db_user, DBCompliment $db_compliment) : DBComplimentHistory {
       
       $history = new DBComplimentHistory();
       $history->user = $db_user->id;
       $history->compliment = $db_compliment->id;        
       $history->date_time = date_create();
       $history->write();
       return $history;
       
    }
    
   
    
    public function getHistory($db_user, $depth) : array { 
        
        $true_depth = (int)$depth;
        $sql = <<<END
                SELECT compliment FROM [history] WHERE user = ?
                ORDER BY id DESC
                LIMIT $true_depth
                END;
        $view = new DBView($sql, $db_user->id);
        
        $history = [];
        while ($view->next()) {
            $history[] = new DBCompliment("id = ?", $view->compliment);
        }
        
       return $history; 
    }
}
