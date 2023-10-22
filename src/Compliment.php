<?php

namespace megahard\ComplimentsModel;
use megahard\ComplimentsModel\data\DBCompliment;
use losthost\DB\DBView;

class Compliment {
   
    public function add(string $compliment, bool $for_male, bool $for_female) : DBCompliment {
    
        $db_compliment = new DBCompliment();
        $db_compliment->compliment = $compliment; 
        $db_compliment->for_male = $for_male;
        $db_compliment->for_female = $for_female;
        $db_compliment->write();
        return $db_compliment;
    }
    
    public function getRandom(string $gender) : DBCompliment {
        
        $list = $this->list($gender);
        $random_number = random_int(0, count($list)-1);
        $random_compliment = $list[$random_number];
        return $random_compliment;
        
    }
    
    public function getById(int $id) : DBCompliment {
        
        $db_compliment = new DBCompliment("id = ?", $id);
        return $db_compliment;
        
    }
    
    public function list(string $gender) : array {
        
        if ($gender == 'm') {
            $field = 'for_male';
        } elseif ($gender == 'f') {
            $field = 'for_female';
        }
        
        $sql = <<<END
                SELECT id FROM [compliments] WHERE $field = 1
                END;
        $view = new DBView($sql);
        
        $result = [];
        while ($view->next()) {
            $result[] = $this->getById($view->id);
        }
        return $result;
        
    }
            
}
