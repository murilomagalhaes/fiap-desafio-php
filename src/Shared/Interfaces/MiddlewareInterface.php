<?php

namespace App\Shared\Interfaces;

use App\Shared\Http\{Request, Response};

interface MiddlewareInterface
{
    public function handle(Request $request, Response $response): void;
}