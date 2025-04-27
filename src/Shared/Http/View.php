<?php

namespace App\Shared\Http;

use App\Shared\Exceptions\ViewNotFoundException;

class View
{
    private string $viewsBasePath;
    protected array $data;
    private bool $bypassException = false;

    public function __construct()
    {
        $this->viewsBasePath = __DIR__ . "/../../../views/";
    }


    /**
     * @throws ViewNotFoundException
     */
    public function render(string $view, $data = []): void
    {

        $viewPath = realpath("{$this->viewsBasePath}/{$view}.php");

        if (!$viewPath && !$this->bypassException) throw new ViewNotFoundException($view);

        $this->data = $data;

        ob_start();
        include($viewPath);
        $buffer = ob_get_contents();
        @ob_end_clean();

        echo $buffer;

        $this->bypassException = false;

        die();
    }

    public function __get($key)
    {
        return $this->data[$key] ?? null;
    }
}