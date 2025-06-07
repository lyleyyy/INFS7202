<?php

namespace App\Controllers;

class Donation extends BaseController
{
    // for render the donation page
    public function index()
    {
        return view('donation/index');
    }
}
