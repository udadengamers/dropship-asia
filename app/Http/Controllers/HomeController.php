<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Ambil data produk dari database
        $products = Product::latest()->paginate(12);

        // Kirim ke view
        return view('home', compact('products'));
    }
}

