<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\CompanyResource;
use App\Http\Resources\ProductResource;
use App\Models\Category;
use App\Models\Company;
use App\Models\Product;

class ApiController extends Controller
{
    public function company()
    {
        $company = Company::first();
        return new CompanyResource($company);
    }

    public function categories()
    {
        $categories = Category::all();
        return CategoryResource::collection($categories);
    }

    public function products()
    {
        $products = Product::all();
        return ProductResource::collection($products);
    }

    public function product($id)
    {
        $product = Product::find($id);
        return new ProductResource($product);
    }


}
