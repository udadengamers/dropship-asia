<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = Product::with(['stocks', 'product_images', 'category'])->active();

        if (request()->has('category')) {

            $category = request()->get('category');

            $product->whereHas('category', function ($query) use ($category) {
                $query->where('slug', $category);
            });
        }

        if (request()->has('search')) {

            $search = request()->get('search');

            $product->where('name', 'LIKE', "%{$search}%")->orWhere('description', 'LIKE', "%{$search}%");
        }

        if (request()->ajax()) {

            $view = view('seller.item', ['products' => $product->paginate(5)])->render();

            return response()->json(['html' => $view]);
        }

        $data['products'] = $product->paginate(5);

        return view('seller.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function banned()
    {
        return view('seller.page.banned');
    }
}
