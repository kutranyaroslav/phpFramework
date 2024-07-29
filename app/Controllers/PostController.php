<?php

namespace App\Controllers;

use User\Framework\http\Response;

class PostController
{
    public function show(int $id): Response
    {
        $content = "Post id is $id";

        return new Response($content);
    }
}
