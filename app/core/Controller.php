<?php

class Controller
{
    public function view($view, $data = [])
    {
        extract($data);

        // support folder/view (home/index)
        $view = str_replace('.', '/', $view);

        $viewPath = dirname(__DIR__) . '/views/' . $view . '.php';

        if (!file_exists($viewPath)) {
            die("View tidak ditemukan: " . $viewPath);
        }

        require $viewPath;
    }
}
