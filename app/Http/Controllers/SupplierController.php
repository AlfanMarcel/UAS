<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Cviebrock\EloquentSluggable\Services\SlugService;

class SupplierController extends Controller
{
        public function __construct()
        {
        $this->middleware('auth');
        }

    public function index()
    {
        $suppliers = Supplier::paginate(10);

        return view('dashboard.supplier.index',[
            'suppliers' => $suppliers
        ]);
    }

    public function create(){
        return view('dashboard.supplier.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required'
        ]);

        $suppliers = new Supplier;

        $suppliers->nama = $request->get('nama');
        $suppliers->save(); 

        return redirect()->route('supplier.index')->with('success','supplier Ditambahkan');
    }

    public function delete($id){
        $suppliers = Supplier::where('id', $id)->first();

        Supplier::find($suppliers->id)->delete();

        return redirect()->route('supplier.index')->with('success','Category berhasil dihapus');
    }

    public function show($id)
    {
        $product = Product::where('id', $id)->first();

        return view('dashboard.product.detail',[
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
        $supplier = Supplier::where('id', $id)->first();
        return view('dashboard.supplier.edit',[
            'supplier' => $supplier,
        ]);
    }

    public function update(Request $request, Supplier $supplier)
    {
        $rules = [
            'nama' => 'required',
        ];

        $validatedData = $request->validate($rules);

        Supplier::where('id', $supplier->id)
        ->update($validatedData);

        return redirect()->route('supplier.index')
        ->with('success', 'Data Berhasil diupdate');
    }



}
