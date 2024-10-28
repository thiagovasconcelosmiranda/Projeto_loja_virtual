<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view(
            'Pages/home',
            ['products' => self::findProduct()]

        );
    }

    private function findProduct()
    {
        $products = new ProductController();
        return $products->findAll();
    }
}
