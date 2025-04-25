<?php

namespace App\Shared\Interfaces;

interface MiddlewareInterface
{
    public function handle(): void;
}