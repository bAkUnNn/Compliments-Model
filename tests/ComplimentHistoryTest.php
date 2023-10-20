<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

namespace ComplimentsModel;
use PHPUnit\Framework\TestCase;
use ComplimentsModel\data\DBUser;
use ComplimentsModel\data\DBCompliment;
use ComplimentsModel\data\DBComplimentHistory;
use ComplimentsModel\User;
use ComplimentsModel\Compliment;

/**
 * Description of ComplimentHistoryTest
 *
 * @author 42195
 */
class ComplimentHistoryTest extends TestCase {
    
    public function testCanAddHistoryRecord() {
        $history = new ComplimentHistory();
        
        $db_user = (new User())->add("Серго");
        $db_compliment = (new Compliment())->add("Ты молодец!", true, true);
        
        $db_history = $history->add($db_user, $db_compliment);
        
        $this->assertTrue($db_history->id !== null);
        $this->assertGreaterThanOrEqual(date_create()->getTimestamp()-1, $db_history->date_time->getTimestamp());
    }
    
    public function testCanGetHistory() {
        
        // Подготовка тестовых данных
        $history = new ComplimentHistory();
        
        // Создаем двух юзеров
        $db_user1 = (new User())->add("Andrew");
        $db_user2 = (new User())->add("Sam");
        
        // И три комплимента
        $db_compliment[0] = (new Compliment())->add("Выше тебя только горы!", true, true);
        $db_compliment[1] = (new Compliment())->add("Круче тебя только яйца!", true, true);
        $db_compliment[2] = (new Compliment())->add("Ты гениален!", true, false);
        
        // Записываем 10 случайных комплиментов (из этих трех первому пользователю)
        // и так же запоминаем их в массив $test_history, чтобы знать в каком они были порядке
        foreach (range(0,9) as $index) {
            $test_history[$index] = $db_compliment[random_int(0, 2)];
            $history->add($db_user1, $test_history[$index]);
        }
        
        // аналогично поступаем со вторым пользователем
        foreach (range(10,19) as $index) {
            $test_history[$index] = $db_compliment[random_int(0, 2)];
            $history->add($db_user2, $test_history[$index]);
        }
                
        // Вызов 1 
        $depth = 5; // Типа мы хотим получить 5 последних комплиментов
        $history_array1 = $history->getHistory($db_user1, $depth);

        // Проверки для вызова 1
        // Убеждаемся что в массиве 5 элементов (мы же 5 просили)
        $this->assertEquals(5, count($history_array1));
        
        // Проверяем, что все они нужного типа DBComplimentHistory
        $this->assertInstanceOf(DBCompliment::class, $history_array1[0]);
        $this->assertInstanceOf(DBCompliment::class, $history_array1[1]);
        $this->assertInstanceOf(DBCompliment::class, $history_array1[2]);
        $this->assertInstanceOf(DBCompliment::class, $history_array1[3]);
        $this->assertInstanceOf(DBCompliment::class, $history_array1[4]);

        // Теперь провеляем что это правильные комплименты в правильном порядке
        // Этому пользователю мы последний комплимент сделали с индексом 9, 
        // Значит он должен быть первым в полученном массиве
        $this->assertEquals($test_history[9]->compliment, $history_array1[0]->compliment);
        // Предпоследний с индексом 8, значит он в массиве должен быть вторым
        $this->assertEquals($test_history[8]->compliment, $history_array1[1]->compliment);
        // И т.д.
        $this->assertEquals($test_history[7]->compliment, $history_array1[2]->compliment);
        $this->assertEquals($test_history[6]->compliment, $history_array1[3]->compliment);
        $this->assertEquals($test_history[5]->compliment, $history_array1[4]->compliment);
        
        // Вызов 2
        // Типа мы хотим получить 5 последних комплиментов
        $history_array2 = $history->getHistory($db_user2, 3);
        
        // Проверки для вызова 2
        // Убеждаемся что в массиве 3 элементов (мы же 3 просили)
        $this->assertEquals(3, count($history_array2));
        
        // Проверяем, что все они нужного типа DBComplimentHistory
        $this->assertInstanceOf(DBCompliment::class, $history_array2[0]);
        $this->assertInstanceOf(DBCompliment::class, $history_array2[1]);
        $this->assertInstanceOf(DBCompliment::class, $history_array2[2]);

        // Теперь провеляем что это правильные комплименты в правильном порядке
        // Этому пользователю мы последний комплимент сделали с индексом 19, 
        // Значит он должен быть первым в полученном массиве (с индексом 0) и т.д.
        $this->assertEquals($test_history[19]->compliment, $history_array2[0]->compliment);
        $this->assertEquals($test_history[18]->compliment, $history_array2[1]->compliment);
        $this->assertEquals($test_history[17]->compliment, $history_array2[2]->compliment);

    }

 }
