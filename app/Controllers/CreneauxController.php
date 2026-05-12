<?php

namespace App\Controllers;

class CreneauxController extends BaseController
{
    public function index(): string
    {
        return view('client/creneaux');
    }
}
