<?php
require 'ReflectionClassAnnotations.php';

/**
 * @test Test1
 * @param test1
 * @param test2 test3
 */
class Test {
    
}

class SimpleTest extends PHPUnit_Framework_TestCase {
    protected $_obj = null;
    
    public function setUp() {
        $this->_obj = new ReflectionClassAnnotations(new Test());
    }
    
    public function tearDown() {
        $this->_obj = null;
    }
    
    public function testCorrectSetup() {
        $this->assertEquals('ReflectionClassAnnotations', get_class($this->_obj));
    }
    
    public function testAnnotationCount() {
        $this->assertEquals(3, $this->_obj->getAnnotationsCount());
    }
    
    public function testAnnotationsRaw() {
        $this->assertEquals(
            3,
            count($this->_obj->getAnnotationsRaw())
        );
    }
    
    public function testGetAnnotation() {
        $result_test  = $this->_obj->getAnnotation('test');
        $result_param = $this->_obj->getAnnotation('param');
        $result_nonexistent = $this->_obj->getAnnotation('idontexist');
        
        $this->assertEquals(1, count($result_test));
        $this->assertEquals(2, count($result_param));
        
        $this->assertEquals(0, count($result_nonexistent));
        
        $this->assertEquals('Test1', $result_test[0]);
        $this->assertEquals('test1', $result_param[0]);
        $this->assertEquals('test2 test3', $result_param[1]);
    }
    
    public function testGetAllAnnotations() {
        $annotations = $this->_obj->getAllAnnotations();
        
        $this->assertArrayHasKey('test',  $annotations);
        $this->assertArrayHasKey('param', $annotations);
        
        $this->assertEquals($annotations['test'],  $this->_obj->getAnnotation('test'));
        $this->assertEquals($annotations['param'], $this->_obj->getAnnotation('param'));
    }
}
