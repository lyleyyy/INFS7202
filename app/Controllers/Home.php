<?php

namespace App\Controllers;

class Home extends BaseController
{
    // for render the home page
    public function index() {
        echo view('welcome_message');
    }
}
