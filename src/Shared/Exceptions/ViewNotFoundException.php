<?php

namespace App\Shared\Exceptions;

class ViewNotFoundException extends \Exception
{
    public function __construct($view)
    {
        parent::__construct("View not found: $view");
    }
}