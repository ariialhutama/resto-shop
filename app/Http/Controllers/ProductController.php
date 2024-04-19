<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index(Request $request)
    {
        $products = Product::latest()->paginate(5);
        $categories = Category::all();

        return view('pages.product.index', compact('products', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('pages.product.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'min:10',
            'category_id' => 'required',
            'price' => 'required',
            'stock' => 'required|numeric',
            'status' => 'required|boolean',
            'is_favorite' => 'required|boolean',
            'image' => 'image|mimes:png,jpg,jpeg|max:2048',


        ], [
            'name.required' => '*Silahkan Mengisi Nama Produk',
            'category_id.required' => '*Silahkan Mengisi Kategori Produk',
            'price.required' => '*Silahkan Mengisi Harga Produk',
            'stock.required' => '*Silahkan Mengisi Stok Produk',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $path = time() . '_' . $request->name . '_' . '.' . $image->getClientOriginalExtension();
            Storage::disk('local')->put('public/products/' . $path, file_get_contents($image));
            // $product->create();

            Product::create([
                'name' => $request->name,
                'description' => $request->description,
                'category_id' => $request->category_id,
                'price' => $request->price,
                'stock' => $request->stock,
                'status' => $request->status,
                'is_favorite' => $request->is_favorite,
                'image' => $path,
            ]);
        } else {
            Product::create([
                'name' => $request->name,
                'description' => $request->description,
                'category_id' => $request->category_id,
                'price' => $request->price,
                'stock' => $request->stock,
                'status' => $request->status,
                'is_favorite' => $request->is_favorite,
                // 'image' => $path,
            ]);
        }

        return redirect()->route('product.index')->with('success', 'product created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::findOrfail($id);
        $categories = Category::all();
        return view('pages.product.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'min:10',
            'category_id' => 'required',
            'price' => 'required',
            'stock' => 'required|numeric',
            'status' => 'required|boolean',
            'is_favorite' => 'required|boolean',
            'image' => 'image|mimes:png,jpg,jpeg|max:2048',


        ], [
            'name.required' => '*Silahkan Mengisi Nama Produk',
            'category_id.required' => '*Silahkan Mengisi Kategori Produk',
            'price.required' => '*Silahkan Mengisi Harga Produk',
            'stock.required' => '*Silahkan Mengisi Stok Produk',
        ]);


        $product = Product::findOrfail($id);

        if ($request->hasFile('image')) {
            if ($product->image != null) {

                Storage::delete('public/products/' . $product->image);
            }
            $image = $request->file('image');
            $path = time() . '_' . $request->name . '_' . $request->id . '.' . $image->getClientOriginalExtension();
            Storage::disk('local')->put('public/products/' . $path, file_get_contents($image));

            $product->update([
                'name' => $request->name,
                'description' => $request->description,
                'category_id' => $request->category_id,
                'price' => $request->price,
                'stock' => $request->stock,
                'status' => $request->status,
                'is_favorite' => $request->is_favorite,
                'image' => $path,
                // 'image' => $request->image,
            ]);
        } else {
            $product->update([
                'name' => $request->name,
                'description' => $request->description,
                'category_id' => $request->category_id,
                'price' => $request->price,
                'stock' => $request->stock,
                'status' => $request->status,
                'is_favorite' => $request->is_favorite,

            ]);
        }

        return redirect()->route('product.index')->with('success', 'Product Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = product::find($id);
        Storage::delete('public/products/' . $product->image);
        $product->delete();

        return redirect()->route('product.index')->with('success', 'Data Berhasil Di Hapus');
    }
}
