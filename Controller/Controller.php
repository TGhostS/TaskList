<?php
abstract class Controller
{
    protected $m;
    public function __construct() {
        $this->m = new model();;
    }
} 
?>