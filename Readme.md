# Class annotation support for PHP

This repository provides a class named `ReflectionClassAnnotations` that provides simple programmatic access to the annotations described in the docmentation block above a class.


### Example

    <?php
    /**
     * This is my class.  I can now gain programmatic access to the following annotations.
     *
     * @todo We need to improve this!
     * @todo We also need to improve that!
     * @fixme This is fairly serious.
     */
    class NicksClass {
        public function __construct() {
           // …
        }
        
        public function doSomething() {
        	// …
        }
    }
    
We can now perform our reflection:
    
    $annotations = new ReflectionClassAnnotations('NicksClass');
    print_r($annotations->getAllAnnotations());

..and get the following data structure:

    Array
    (
        [todo] => Array
        (
            [0] => We need to improve this!
            [1] => We also need to improve that!
        )

        [fixme] => Array
        (
            [0] => This is fairly serious.
        )

    )
    
### Testing

[![Build Status](https://secure.travis-ci.org/punkstar/php-annotations.png?branch=master)](http://travis-ci.org/punkstar/php-annotations)

A basic test suite is provided with the class.  You can test yourself by running `phpunit` in the root directory.  I've also hooked this repository up to [Travis](http://travis-ci.org/punkstar/php-annotations) for continuous integration.
    
### License

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
