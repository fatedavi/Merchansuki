<?php

class HomeController extends Controller
{
    public function index()
    {
        $productModel = new Product();
        $products = $productModel->getHighlighted();


        $this->view('home/index', [
            'products' => $products
        ]);
    }
}
