<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ScraperController extends Controller
{
    public function index()
    {
        return view('admin.scraper.index');
    }

    public function scrape(Request $request)
    {
        $url = $request->input('url');

        // Example: run Python scraper
        $command = escapeshellcmd("python3 /opt/scraperenv/alibaba_scraper.py '$url'");
        $output = shell_exec($command);

        return back()->with('message', 'Scraped successfully. Output: ' . $output);
    }
}

