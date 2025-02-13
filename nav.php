<?php

class navigation{

    public $menu;
    private $nav;
    private $link = "#";
    private $nameLink;

    public function __construct($menu){
        $this->nav = "<nav id='".$menu."'>";
        $this->nav .= "<ul id='listMenu' >";
    }

    public function addItem($link,$nameLink){
        $this->nav .= "<li><a href='".$link."'>".$nameLink."</a></li>";
    }

    public function getNav(){
        $this->nav .= "</ul></nav>";
        return $this->nav;
    }

}
?>
