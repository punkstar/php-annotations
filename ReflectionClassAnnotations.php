<?php
/**
 * Allow for annotation inspection in PHP classes.
 */
class ReflectionClassAnnotations {
    const REGEX_ANNOTATION = '/@(?P<name>\w+)\s+(?P<value>.+)/';
    
    protected $_reflection = null;
    protected $_matches    = null;
    protected $_count      = 0;
    
    /**
     * @return string|object
     */
    public function __construct($class) {
        if (is_object($class)) {
            $classname = get_class($class);
        } else {
            $classname = $class;
        }
        
        $this->_reflection = new ReflectionClass($classname);
        $this->_count      = preg_match_all(self::REGEX_ANNOTATION, $this->_getCommentBlock(), $this->_matches);
    }
    
    /**
     * Get the class comment.
     *
     * @return string
     */
    protected function _getCommentBlock() {
        return $this->_reflection->getDocComment();
    }
    
    /**
     * Return the raw array of all annotations.
     *
     * @return array
     */
    public function getAnnotationsRaw() {
        return $this->_matches[0];
    }
    
    /**
     * Get the number of annotations on the class.
     *
     * @return int
     */
    public function getAnnotationsCount() {
        return $this->_count;
    }
    
    /**
     * Return an array of annotation values for the given $name.
     *
     * @param string $name
     * @return array
     */
    public function getAnnotation($name) {
        $result = array();
        
        for ($i = 0; $i < $this->_count; $i++) {
            if ($this->_matches['name'][$i] == $name) {
                $result[] = $this->_matches['value'][$i];
            }
        }
        
        return $result;
    }

    /**
     * Return a nested array of all annotation values.
     * 
     * @return array
     */    
    public function getAllAnnotations() {
        $result = array();
        
        if ($this->_count > 0) {
            $keys = array_unique($this->_matches['name']);
            foreach ($keys as $key) {
                $result[$key] = $this->getAnnotation($key);
            }
        }
        
        return $result;
    }
}
    