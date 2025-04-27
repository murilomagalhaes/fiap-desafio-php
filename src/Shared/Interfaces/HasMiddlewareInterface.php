<?php

namespace App\Shared\Interfaces;

interface HasMiddlewareInterface
{
    /**
     * @return array<int, string>
     */
    public function middlewares(): array;
}