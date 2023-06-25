<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->role_id != 1) {
            $products = Product::with('User')
                ->where('user_id', Auth::user()->id)->paginate(5);
        } else {
            $products = Product::with('User')->paginate(5);
        }

        return view('dashboard.product.index', [
            'products' => $products
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $suppliers = Supplier::all();
        return view('dashboard.product.create', [
            'categories' => $categories,
            'suppliers' => $suppliers
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $validatedData = $request->validate([
            'category_id' => 'required',
            'nama' => 'required',
            'harga' => 'required',
            'supplier_id' => 'required',
            'description' => 'required',
            'telfon' => 'required',
            'stok' => 'required',
            'diskon' => 'nullable',
            'image' => 'nullable',
        ]);
        $diskon = ($request->diskon * 0.01) * $request->harga;

        $validatedData['diskon'] = $request->harga - $diskon;
        $validatedData['user_id'] = Auth::user()->id;



        if ($request->file('image')) {
            $validatedData['image'] = $request->file('image')->store('images', 'public');
        }

        Product::create($validatedData);

        return redirect()->route('product.index')
            ->with('success', 'Product berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::where('id', $id)->first();

        return view('dashboard.product.detail', [
            'product' => $product
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::where('id', $id)->first();
        $categories = Category::all();
        $suppliers = Supplier::all();
        return view('dashboard.product.edit', [
            'product' => $product,
            'categories' => $categories,
            'suppliers' => $suppliers
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $rules = [
            'category_id' => 'required',
            'nama' => 'required',
            'harga' => 'required',
            'supplier_id' => 'required',
            'description' => 'required',
            'telfon' => 'required',
            'stok' => 'required',
            'diskon' => 'nullable',
            'image' => 'nullable',
        ];

        $validatedData = $request->validate($rules);
        $diskon = ($request->diskon * 0.01) * $request->harga;

        $validatedData['diskon'] = $request->harga - $diskon;

        if ($request->file('image')) {
            $validatedData['image'] = $request->file('image')->store('images', 'public');
        }

        Product::where('id', $product->id)
            ->update($validatedData);

        return redirect()->route('product.index')
            ->with('success', 'Data Berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        if (File::exists('storage/' . $product->image)) {
            File::delete('storage/' . $product->image);
        }

        Product::find($product->id)->delete();
        return redirect()->route('product.index')
            ->with('success', 'Product berhasil dihapus');
    }
}
