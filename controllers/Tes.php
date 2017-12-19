<?php

namespace controllers;

use lib\MVC\View;

class Tes extends View
{
    protected function index()
    {
        $tesVar = 'tes kirim variable';
        View::render('tes.index', ['tesvar' => $tesVar]);
    }

    public function tesKedua()
    {
        View::render('tes.teskedua');
    }
}
