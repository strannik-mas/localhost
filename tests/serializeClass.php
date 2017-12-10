<?php

class MyClass{
    function __construct() {
        for($i=0; $i<rand(10,20); $i++){
            $this->{key.$i} = $i;
        }
        
    }

    function __toString() {
        return json_encode($this);
    }

}
echo new MyClass(); 