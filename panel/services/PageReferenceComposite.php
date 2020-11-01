<?php

include_once('PageReference.php');

class PageReferenceComposite  {

    public $title, $icon, $subMenu = array();

    public function __construct($title, $icon, $subMenu)
    {
        $this->title = $title;
        $this->icon = $icon;

        foreach ($subMenu as $sm) :
            array_push($this->subMenu, $sm);
        endforeach;
    }
}