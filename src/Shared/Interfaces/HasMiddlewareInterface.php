<?php

namespace App\Shared\Interfaces;

interface HasMiddlewareInterface
{
    public function middlewares(): array;
}