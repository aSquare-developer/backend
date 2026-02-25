<?php
declare(strict_types=1);

namespace App\Controller;

class ApiController extends AppController
{
    /**
     * API health-check / welcome endpoint.
     *
     * @return void
     */
    public function index(): void
    {
        $this->set([
            'message' => 'Welcome to BlogiBlogi API',
            'version' => '1.0.0',
            'status' => 'online',
        ]);
    }
}

