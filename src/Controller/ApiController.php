<?php
namespace App\Controller;

class ApiController extends AppController
{
    public function index()
    {
        $this->set([
            'message' => 'Welcome to BlogiBlogi API',
            'version' => '1.0.0',
            'status' => 'online'
        ]);
    }
}
