<?php

namespace App\Controllers;

use User\Framework\http\Response;

class HomeController
{
    public function index(): Response
    {
        $content = '<h1>My First Controller</h1>';

        return new Response($content);
    }
}
