<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index() {
        // return view('products.index', ['products'=> Product::get()]);
        //return view('products.index', ['products'=> Product::latest()->get()]);  //for latest
        return view('products.index', ['products'=> Product::latest()->paginate(5)]);  //for Paginate
    }

    public function create() {
        return view('products.create');
    }

    public function store(Request $request) {
        // Validate data
        $request->validate([
            'name'=> 'required|max:255',
            'description'=> 'required',
            'image'=> 'required | mimes:jpeg,jpg,png|max:10000',
        ]);

        // upload image
        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('products'), $imageName);

        $products = new Product;
        $products->image = $imageName;
        $products->name = $request->name;
        $products->description = $request->description;

        $products->save();

        return back()->withSuccess('Product Created Successfully');
    }

    public function edit($id) {
        $product = Product::where('id', $id)->first();
        return view('products.edit', ['product' => $product]);
    }

    public function update(Request $request, $id) {
        // Validate data
        $request->validate([
            'name'=> 'required',
            'description'=> 'required',
            'image'=> 'nullable|mimes:jpeg,jpg,png|max:10000',
        ]);

        $product = Product::where('id', $id)->first();

        if(isset($request->image)) {
            // upload image
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('products'), $imageName);
            $product->image = $imageName;
        }

        $product->name = $request->name;
        $product->description = $request->description;

        $product->save();

        return back()->withSuccess('Product Updated Successfully');
    }

    public function destroy($id) {
        $product = Product::where('id', $id)->first();
        $product->delete();
        return back()->withSuccess('Product Deleted Successfully');
    }

    public function show($id) {
        $product = Product::where('id', $id)->first();
        return view('products.show',['product'=>$product]);
    }
}
