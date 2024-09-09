<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FrontController extends Controller
{
    //
    public function index()
    {

        $products = Product::where('is_featured', 'Yes')
            ->orderBy('id', 'DESC')
            ->take(8)
            ->where('status', 1)
            ->get();

        $data['featuredProducts'] = $products;


        $latestProducts = Product::orderBy('id', 'DESC')
            ->where('status', 1)
            ->take(8)
            ->get();
        $data['latestProducts'] = $latestProducts;


        return view("front.home", $data);
    }
    // front wishlist functionality for addwish to cart
    public function addToWhishList(Request $request)
    {
        if (Auth::check() == false) {

            session(['url.intend' => url()->previous()]);

            return response()->json([
                'status' => false
            ]);
        }
        $wishlist = new Wishlist();
        $wishlist->user_id = Auth::user()->id;
        $wishlist->product_id = $request->id;
        $wishlist->save();

        return response()->json([
            'status' => true,
            'message' => 'Product added in your wishlist'
        ]);
    }
}
