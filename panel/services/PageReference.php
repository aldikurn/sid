<?php

class PageReference {
    public $title;
    public $path;
    public $icon;

    public function __construct($title, $path, $icon) {
        $this->title = $title;
        $this->path = $path;
        $this->icon = $icon;
    }
}