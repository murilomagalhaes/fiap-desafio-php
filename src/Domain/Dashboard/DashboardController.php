<?php

namespace App\Domain\Dashboard;

use App\Shared\Interfaces\HasMiddlewareInterface;
use App\Shared\Http\AuthMiddleware;
use App\Shared\Http\Response;
use App\Shared\Http\Request;


class DashboardController implements HasMiddlewareInterface
{
    public function middlewares(): array
    {
        return [AuthMiddleware::class];
    }

    public function index(Request $request, Response $response)
    {
        $response->view('dashboard/index');
    }

}