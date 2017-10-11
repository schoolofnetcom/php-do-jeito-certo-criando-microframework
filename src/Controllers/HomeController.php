<?php

namespace ErikFig\Controllers;

class HomeController
{
    private $params;

    public function __construct($params)
    {
        $this->params = $params;
    }

    public function index()
    {
        return "<h1>{$this->params[1]}</h1>";
    }
}
