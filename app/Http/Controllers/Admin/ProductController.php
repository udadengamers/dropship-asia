<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductImage;
use App\Models\Product;
use App\Models\Category;
use App\Models\OrderItem;
use App\Models\Stock;
use App\Models\Seller;
// use DataTables;
use Exception;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Admin\ProductRequest;
use App\Traits\GenerateUuidTrait;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    use GenerateUuidTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            if (request()->get('tab') == 'active') {
                $data = Product::with(['category'])->active();
            } else if (request()->get('tab') == 'deleted') {
                $data = Product::with(['category'])->where('state', 'deleted');
            } else {
                $data = Product::with(['category'])->active();
            }

            if (isset(request()->order[0]['column']) && (request()->order[0]['column'] == 0)) {
                $data->orderByDesc('id');
            }

            return Datatables::of($data)
                ->addIndexColumn()
                ->editColumn('state', function ($row) {
                    return ucfirst($row->state);
                })
                ->editColumn('stock', function ($row) {
                    return number_format($row->stocks()->sum('quantity')) . ' pcs';
                })
                ->addColumn('image', function ($row) {
                    $data['product'] = $row;
                    return view('administrator.product.table.image', $data);
                })
                ->addColumn('action', function ($row) {
                    $data['product'] = $row;
                    return view('administrator.product.table.action', $data);
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('administrator.product.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['categories'] = Category::get();

        return view('administrator.product.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        try {
            DB::beginTransaction();
            
            // $validatedData = $request->validate([
            //     'images.*' => 'required|image|max:50|mimes:jpeg,jpg,png',
            // ]);

            $product = Product::create([
                "name" => $request->name,
                "sku" => $request->sku,
                "category_id" => $request->categories,
                "description" => $request->description,
                "state" => "active",
            ]);

            if ($product) {
                // stocks
                if ($request->stock) {
                    $product->update([
                        'is_variation' => true
                    ]);
                    foreach ($request->stock as $key => $stock) {
                        $product->stocks()->create([
                            'name' => $stock['variation_name'],
                            'quantity' => $stock['quantity'],
                            'price' => $stock['price'],
                            'state' => 'active',
                        ]);
                    }
                } else {
                    $product->update([
                        'is_variation' => false
                    ]);
                    $product->stocks()->create([
                        'name' => 'default',
                        'quantity' => $request->quantity,
                        'price' => $request->price,
                        'state' => 'active',
                    ]);
                }
                // images
                if ($request->images) {
                    foreach ($request->images as $key => $image) {
                        upload($product->product_images(), $image, $request->name, 'product');
                    }
                }
            }

            session()->flash('success', [
                "Product has been created."
            ]);

            DB::commit();

            return redirect()->route('administrator.product.create')->with('success', 'Product has been created.');
        } catch (Exception $e) {

            Log::info($e);

            DB::rollback();

            session()->flash('error', 
                $e->getMessage()
            );

            return redirect()->route('administrator.product.create')->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($uuid)
    {
        $data['product'] = Product::where('uuid', $uuid)->firstOrFail();

        $data['categories'] = Category::get();

        return view('administrator.product.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($uuid)
    {
        $data['product'] = Product::where('uuid', $uuid)->firstOrFail();

        $data['categories'] = Category::get();

        return view('administrator.product.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $uuid)
    {
        try {
            DB::beginTransaction();

            $product = Product::where('uuid', $uuid)->firstOrFail();

            $product->update([
                "name" => $request->name,
                "sku" => $request->sku,
                "category_id" => $request->categories,
                "description" => $request->description,
                "state" => "active",
            ]);

            if ($request->stock) {

                $product->update([
                    'is_variation' => true
                ]);

                foreach ($product->stocks as $key => $stock) {
                    if (array_key_exists($stock->uuid, $request->stock)) {
                        $old_stock = $request->stock[$stock->uuid];
                        $stock->update([
                            'name' => $old_stock['variation_name'],
                            'quantity' => $old_stock['quantity'],
                            'price' => $old_stock['price'],
                            'state' => 'active',
                        ]);
                    } else {
                        $stock->delete();
                    }
                }

                $new_stocks = array_filter($request->stock, 'is_int', ARRAY_FILTER_USE_KEY);

                foreach ($new_stocks as $key => $new_stock) {
                    $product->stocks()->create([
                        'name' => $new_stock['variation_name'],
                        'quantity' => $new_stock['quantity'],
                        'price' => $new_stock['price'],
                        'state' => 'active',
                    ]);
                }
            } else {
                if ($product->is_variation) {
                    foreach ($product->stocks as $key => $stock) {
                        $stock->delete();
                    }
                    $product->stocks()->create([
                        'name' => 'default',
                        'quantity' => $request->quantity,
                        'price' => $request->price,
                        'state' => 'active',
                    ]);
                } else {
                    foreach ($product->stocks as $key => $old_stock) {
                        $old_stock->update([
                            'name' => 'default',
                            'quantity' => $request->quantity,
                            'price' => $request->price,
                            'state' => 'active',
                        ]);
                    }
                }
                $product->update([
                    'is_variation' => false
                ]);
            }
            // images
            if ($request->images) {
                foreach ($request->images as $key => $image) {
                    upload($product->product_images(), $image, $request->name, 'product');
                }
            }

            session()->flash('success', [
                "Product has been updated."
            ]);

            DB::commit();

            return redirect()->back()->with('success', 'Product has been updated.');
        } catch (Exception $e) {

            Log::info($e);

            DB::rollback();

            session()->flash('error', 
                $e->getMessage()
            );
            
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($uuid)
    {
        try {
            DB::beginTransaction();

            $product = Product::where('uuid', $uuid)->firstOrFail();

            $item = OrderItem::where('product_id', $product->id)->first();

            if ($item) {

                session()->flash('error', "The product cannot be deleted because it has already been purchased.");

                return redirect()->back();
            }

            $product->update([
                'state' => 'deleted'
            ]);

            session()->flash('success', [
                "Product has been deleted."
            ]);

            DB::commit();

            return redirect()->back()->with('success', 'Product has been deleted.');
        } catch (Exception $e) {

            DB::rollback();

            session()->flash('danger', [
                "ERROR look like something went wrong."
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete_image($uuid)
    {
        try {
            DB::beginTransaction();

            $image = ProductImage::where('uuid', $uuid)->first();

            if ($image->product) {

                $product = $image->product;

                if ($product->product_images->count() < 2) {

                    return response()->json([
                        'status' => false,
                        'message' => 'required'
                    ]);
                }
            }

            if ($image) {

                $image->delete();

                DB::commit();

                return response()->json([
                    'status' => true,
                    'message' => 'Success'
                ]);
            }

            return response()->json([
                'status' => false,
                'message' => 'Image not found'
            ]);
        } catch (Exception $e) {

            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);

            DB::rollback();
        }
    }

    public function upload_ckeditor_images(Request $request)
    {
        if ($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName . '_' . time() . '.' . $extension;
            $path = storage_path('app/public/media/' . now()->format('Y/m'));
            File::exists($path) or File::makeDirectory($path, 0777, true);
            $request->file('upload')->move($path, $fileName);
            $url = url('storage/media/' . now()->format('Y/m/') . $fileName);
            return response()->json(['fileName' => $fileName, 'uploaded' => 1, 'url' => $url]);
        }
    }
}
