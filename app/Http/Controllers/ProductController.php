<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductPostRequest;
use App\Models\Category;
use App\Models\Product;
use App\Services\FileUploaderService;
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
        //
    }

    public function create()
    {
        return view('products.create', ['categories' => Categoty::all()]);
    }

    public function list(Category $category)
    {
        return view('products.index', ['list' => $category->products]);
    }

    public function store(ProductPostRequest $request, FileUploaderService $fileUploaderService)
    {
        $validatedData = $request->validated();
        unset($validatedData['image']);
        $product = Product::create($validatedData);

        $product->update([
            'image' => $fileUploaderService->uploadPhoto($request->image, $product),
        ]);

        return redirect()->route('products.list', [$validatedData['category_id']])->with('status', 'Product created successfully');
    }

    public function show(Product $product) 
    {
        return view('products.show', ['product' => Product::all()]);
    }

}