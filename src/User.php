<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

namespace megahard\ComplimentsModel;
use megahard\ComplimentsModel\data\DBUser;

/**
 * Description of User
 *
 * @author 42195
 */
class User {
    
    public function add(string $user_name) : DBUser {
        $user = new DBUser();
        $user->user_name = $user_name;
        $user->write();
        return $user;
    }
    
    public function getById(int $id) : DBUser|false {
        
        try {
            $user = new DBUser("id = ?", $id);           
        } catch (\Exception $exc) {            
            return false;           
        }
            
        return $user;
    }
     
    public function getByTelegramId(int $telegram_id) : DBUser|false {
        
        try {           
            $user = new DBUser("telegram_id = ?", $telegram_id);          
        } catch (\Exception $exc) {           
            return false;           
        }
            
        return $user;
    }
    
}
