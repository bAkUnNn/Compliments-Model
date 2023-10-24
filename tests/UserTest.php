<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

namespace megahard\ComplimentsModel;
use PHPUnit\Framework\TestCase;

/**
 * Description of UserTest
 *
 * @author 42195
 */
final class UserTest extends TestCase {

    public function testCanCreate() {
        $user = new User();
        $db_user = $user->add("Вася");

        $this->assertInstanceOf(data\DBUser::class, $db_user);
        $this->assertEquals("Вася", $db_user->user_name);
        
    }
    
    public function testCanGetUserId() {

        $user = new User();
        $db_user = $user->add("Вова1");
        
        $db_user2 = $user->getById($db_user->id);
        $this->assertEquals($db_user->id, $db_user2->id);
        
    }
    
    public function testCanGetUserTelegramId() {

        $user = new User();
        $db_user = $user->add("Вова2");

        $db_user->telegram_id = 34567;
        $db_user->write();
        
        
        $db_user2 = $user->getByTelegramId(34567);
        $this->assertEquals($db_user->id, $db_user2->id);
        
    }
    
    public function testCantAddUserWithTheSameTelegramId() {
        
        $user = new User();
        $db_user = $user->add("Петя");
        $db_user->telegram_id = 54321;
        $db_user->write();
        
        $db_user2 = $user->add("Кузя");
        $db_user2->telegram_id = 54321;
        
        $this->expectExceptionCode(23000);
        $db_user2->write();
        
    }
    
    public function testReturnFalseIfWrongId() {
        $user = new User();
        $db_user = $user->getById(888888888888);
        $this->assertFalse($db_user);
    }

    public function testReturnFalseIfWrongTgId() {
        $user = new User();
        $db_user = $user->getByTelegramId(888888888888);
        $this->assertFalse($db_user);
    }

}
