<?php

namespace App\Http\Controllers;

use Session;
use Illuminate\Http\Request;
use App\Http\Requests\Products\CreateProductRequest;
use App\Product;
use App\Http\Requests\Products\ UpdateProductRequest ;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('products.index')->with('products', Product::all()); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateProductRequest $request)
    {

        $this->validate($request,[

            'product_name' => 'required|unique:products',
            'description' => 'required',
            'image' => 'required|image',
            'price' => 'required',

        ]);

        //upload the image to storage
        $image = $request->image->store('products');

        Product::create([

            'product_name' => $request->product_name,
            'description' => $request->description,
            'price' => $request->price,
            'image' => $image,
            'published_at' => $request->published_at,

        ]);


        //flash message
        session()->flash('success', 'Product created successfully.');

        //redirect user
        return redirect(route('products.index'));
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
    public function edit(Product $product)
    {
        return view('products.create')->with('product', $product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $data = $request->only(['product_name', 'description', 'published_at', 'price']); //only for security and it take a least of attribute of the only attribute that we want

        //check if new image
        if($request->hasFile('image'))
        {

            // upload it

            $image = $request->image->store('products');

            // delete old one

            $product->deleteImage(); //move the functionality and put in the post modal and just called in the controller 
            //Storage::delete($post->image);

            $data['image'] = $image;

        }

        //update attributes
        $product->update($data);

        //flash message
        session()->flash('success', 'Product updated successfully.');

        //redirect user
        return redirect(route('products.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();

        session()->flash('success', 'Products deleted successfully.');

        return redirect(route('products.index'));
    }
}
