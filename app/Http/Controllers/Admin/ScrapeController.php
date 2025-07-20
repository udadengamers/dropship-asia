<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ScrapeController extends Controller
{
    public function index()
    {
        // Cek apakah login sebagai superuser
        if (!session()->has('superuserlogin')) {
            return redirect('/superuseradminlacj5ub3lqwysaj9rik5')
                   ->with('error', 'Silakan login sebagai admin.');
        }

        return view('admin.scrape');
    }

    public function scrape(Request $request)
    {
        if (!session()->has('superuserlogin')) {
            return redirect('/superuseradminlacj5ub3lqwysaj9rik5')
                   ->with('error', 'Silakan login sebagai admin.');
        }

        $url = $request->input('url');
        $command = "source /opt/scraperenv/bin/activate && python3 /opt/scrape.py \"$url\"";

        $output = shell_exec($command);
        $data = json_decode($output, true);

        return view('admin.scrape', ['data' => $data]);
    }
}
