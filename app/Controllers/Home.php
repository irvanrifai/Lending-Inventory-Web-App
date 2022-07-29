<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\HomeModel;

class Home extends BaseController
{
    protected $HomeModel;
    public function __construct()
    {
        $this->HomeModel = new HomeModel();
    }
    public function index()
    {
        $home = $this->HomeModel->findAll();

        $data = [
            'title' => 'Home | SPOKI UMS',
            'home' => $home
        ];

        return view('pages/home', $data);
    }
}
