<?php

namespace controllers;

use lib\MVC\View;

class About extends View
{
    protected function index()
    {
        View::render('about.index');
    }
}
