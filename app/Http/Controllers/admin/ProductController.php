<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //
    public function index()
    {

    }

    public function store(Request $request)
    {

    }
    public function create()
    {
        $categories = Category::orderBy("name", "asc")->get();
        $brands = Brand::orderBy("name", "asc")->get();
        return view("admin.products.create", compact("categories", "brands"));
    }
}
