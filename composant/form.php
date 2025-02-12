<?php

class Form {

    public $action;
    public $method;
    private $fieldset;
    private $label;

    public function __construct($fieldset,$label)
    {
        $this->fieldset = $fieldset;
        $this->fieldset = $label;
    }

    public function setText($fieldset){

        $this->fieldset = '<input type="text" name= "" />';
    }

    public function getForm(){

        

    }



}

?>