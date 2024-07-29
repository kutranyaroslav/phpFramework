<?php

namespace User\Framework\http\exceptions;

class HttpException extends \Exception
{
    private int $status_code = 200;

    public function setStatusCode(int $status_code): HttpException
    {
        $this->status_code = $status_code;

        return $this;
    }

    public function getStatusCode(): int
    {
        return $this->status_code;
    }
}
