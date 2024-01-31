<?php

declare(strict_types=1);

namespace App\Controllers;

use Framework\TemplateEngine;

class HomeController
{
    private TemplateEngine $view;

    public function __construct(TemplateEngine $view)
    {
        $this->view = new TemplateEngine();
    }

    public function home()
    {
        echo "Hello from the Home Page";
    }
}
