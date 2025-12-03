<?php
class Controller
{
    protected function render($view, $data = [])
    {
        extract($data);
        $viewFile = __DIR__ . "/../app/views/{$view}.php";
        include __DIR__ . "/../app/views/layout/main.php";
    }

    protected function redirect($url)
    {
        header("Location: " . $url);
        exit;
    }
}
