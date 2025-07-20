<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Seller\ProfileRequest;

class ProfileController extends Controller
{
    public function index()
    {
        return view('seller.profile.index');
    }

    public function store(ProfileRequest $request)
    {
        # code...
    }
}
