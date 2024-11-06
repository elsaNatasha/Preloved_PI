<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    protected $products;

    public function __construct(){
        $this->products = new Product();
    }


    public function index()
    {
    // Mengambil semua produk dari model Product
    $products = $this->products->all(); 
    $categories = Category::pluck('name', 'id');

    // Debugging untuk memastikan produk dan kategori yang diambil
    //dd($products, $categories);

    return view('pages.product.index', compact('products', 'categories'));}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       $validatedData = $request->validate([
        'productname' => 'required',
        'cat_id' => 'required',
        'description' => 'required',
        'price' => 'required',
        'photo' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
       ]);

       if($request->hasFile('photo')){
        $fileName = time().$request->file('photo')->getClientOriginalName();
        $request ->file('photo')->move(public_path('images'),$fileName);
        $validatedData['photo'] = $fileName;
       }
       Product::create($validatedData);
       return redirect()->back();

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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
