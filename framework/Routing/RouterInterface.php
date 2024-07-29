<?php

namespace User\Framework\Routing;

use User\Framework\http\Request;

interface RouterInterface
{
    public function dispatch(Request $request);
}
