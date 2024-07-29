<?php

namespace User\Framework\http;

class Response
{
    public function __construct(
        private mixed $content,
        private int $status_code = 200,
        private array $headers = [])
    {
        http_response_code($this->status_code);
    }

    public function send()
    {
        echo $this->content;
    }
}
