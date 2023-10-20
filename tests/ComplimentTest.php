<?php

namespace ComplimentsModel;
use ComplimentsModel\data\DBCompliment;
use PHPUnit\Framework\TestCase;
/**
 * Description of ComplimentTest
 *
 * @author 42195
 */
class ComplimentTest extends TestCase {
    
    public function testCanCreateCompliment() {
        $compliment = new Compliment();
        
        $for_male = true;
        $for_female = false;
        $db_compliment = $compliment->add("Ты крутой!", $for_male, $for_female);
        
        $this->assertEquals("Ты крутой!", $db_compliment->compliment);
        $this->assertTrue($db_compliment->for_male);
        $this->assertFalse($db_compliment->for_female);
    }
    
    public function testIsComplimentWritten() {
        $compliment = new Compliment();

        $for_male = true;
        $for_female = false;
        $db_compliment = $compliment->add("Ты крутой!", $for_male, $for_female);
        
        $db_compliment2 = $compliment->getById($db_compliment->id);
        $this->assertEquals($db_compliment2->id, $db_compliment->id);
    }

    public function testCanListCompliments() {
        
        $compliment = new Compliment();
        
        $db_compliment = $compliment->add("Ты лох!", true, false);
        
        $gender = 'm';
        $compliments = $compliment->list($gender);
        
        $this->assertGreaterThanOrEqual(1, count($compliments));

        $found = false;
        foreach ($compliments as $val) {
            $this->assertInstanceOf(DBCompliment::class, $val);
            if ($val->id == $db_compliment->id) {
                $found = true;
            }
        }
        
        $this->assertTrue($found);
    }

    public function testCanGetRandomCompliment() {
        $compliment = new Compliment();
        
        $for_male = false;
        $for_female = true;
        $compliment->add("Ты крутая!", $for_male, $for_female);
        $compliment->add("Ты сильная!", $for_male, $for_female);
        $compliment->add("Ты лохушка!", $for_male, $for_female);
        
        $gender = 'f';
        $history = [];
        for ($index = 0; $index<100; $index++) {
            $db_compliment = $compliment->getRandom($gender);
            $history[] = $db_compliment->compliment;
        }
        
        $this->assertTrue(array_search("Ты крутая!", $history) !== false);
        $this->assertTrue(array_search("Ты сильная!", $history) !== false);
        $this->assertTrue(array_search("Ты лохушка!", $history) !== false);

    }
}
