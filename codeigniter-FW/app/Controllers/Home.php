<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $session = \Config\Services::session();
        $session->set('id', 1);

        return view('IdView/connexion');
        return view('templates/footer');
    }

    public function test(){
        return view('IdView/connexion');

    }
}
