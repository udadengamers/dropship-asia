<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Product; // Adjust if your model name is different

class ProductScraperController extends Controller
{
    public function showForm()
    {
        return view('admin.scraper.form');
    }

    public function scrape(Request $request)
    {
        $request->validate(['url' => 'required|url']);

        // For now, fake scraped data
        $data = [
            'name' => 'Example Product from Alibaba',
            'description' => 'Scraped product description.',
            'price' => 99.99,
        ];

        Product::create($data); // Insert into database

        return redirect()->back()->with('success', 'Product scraped and added!');
    }
}

