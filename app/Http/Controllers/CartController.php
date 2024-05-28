<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\CustomerAddress;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class CartController extends Controller
{
    //
    // public function addToCart(Request $request)
    // {
    //     $product = Product::with('product_images')->find($request->id);

    //     if ($product == null) {
    //         return response()->json([
    //             'status' => false,
    //             'message' => 'Product not found'
    //         ]);
    //     }

    //     if (Cart::count() > 0) {

    //         //Products found in cart
    //         //Check if this product already added in your cart
    //         //iif product not found in the cart,then add product in cart

    //         $cartContent = Cart::content();
    //         $productAlreadyExist = false;

    //         foreach ($cartContent as $item) {
    //             if ($item->id == $product->id) {
    //                 $productAlreadyExist = true;
    //             }
    //         }

    //         if ($productAlreadyExist == false) {
    //             Cart::add($product->id, $product->title, $product->price, ['productImage' => (!empty($product->product_images)) ? $product->product_images->first() : '']);

    //             $status = true;
    //             $message = $product->title . 'added in cart';
    //         } else {
    //             $status = false;
    //             $message = $product->title . 'Already added in cart';

    //         }

    //     } else {
    //         Cart::add($product->id, $product->title, $product->price, ['productImage' => (!empty($product->product_images)) ? $product->product_images->first() : '']);
    //         $status = true;
    //         $message = $product->title . 'added in cart';


    //     }

    //     return response()->json([
    //         'status' => $status,
    //         'message' => $message
    //     ]);





    // }


    public function addToCart(Request $request)
    {
        $product = Product::with('product_images')->find($request->id);

        if ($product == null) {
            return response()->json([
                'status' => false,
                'message' => 'Product not found'
            ]);
        }

        $productAlreadyExist = false;

        if (Cart::count() > 0) {
            $cartContent = Cart::content();
            foreach ($cartContent as $item) {
                if ($item->id == $product->id) {
                    $productAlreadyExist = true;
                    break;
                }
            }
        }

        if (!$productAlreadyExist) {
            Cart::add($product->id, $product->title, 1, $product->price, ['productImage' => (!empty($product->product_images)) ? $product->product_images->first() : '']);
            $status = true;
            $message = '<strong>' . $product->title . '</strong> added to cart';
            session()->flash('success', $message);
        } else {
            $status = false;
            $message = $product->title . ' is already in the cart';
        }
        return response()->json([
            'status' => $status,
            'message' => $message
        ]);
    }

    public function cart()
    {
        $cartContent = Cart::content();
        $data['cartContent'] = $cartContent;
        return view('front.cart', $data);
    }

    public function updateCart(Request $request)
    {
        $rowId = $request->rowId;
        $qty = $request->qty;

        $itemInfo = Cart::get($rowId);

        $product = Product::find($itemInfo->id);


        if ($product->track_qty == 'Yes') {
            if ($qty <= $product->qty) {
                Cart::update($rowId, $qty);
                $message = 'Cart updated successfully';
                $status = true;
                session()->flash('success', $message);



            } else {
                $message = 'Requested qty(' . $qty . ') not available in stock';
                $status = false;
                session()->flash('error', $message);


            }
        } else {
            Cart::update($rowId, $qty);
            $message = 'Cart updated successfully';
            $status = true;
            session()->flash('success', $message);

        }

        //check quantity availabe stock


        return response()->json([
            'status' => true,
            'message' => $message
        ]);
    }

    public function deleteItem(Request $request)
    {
        $itemInfo = Cart::get($request->rowId);

        if ($itemInfo == null) {

            $errorMessage = 'Item not found in cart';
            session()->flash('error', $errorMessage);

            return response()->json([
                'status' => false,
                'message' => $errorMessage
            ]);
        }

        Cart::remove($request->rowId);
        $message = 'Item removed from cart successfully.';
        session()->flash('success', $message);
        return response()->json([
            'status' => true,
            'message' => $message
        ]);
    }

    public function checkout()
    {

        //if cart is empty
        if (Cart::count() == 0) {
            return redirect()->route('front.cart');
        }

        //if user is not logged in
        if (Auth::check() == false) {

            if (!session()->has('url.intended')) {
                session(['url.intended' => url()->current()]);
            }
            return redirect()->route('account.login');

        }


        session()->forget('url.intended');

        $countries = Country::orderBy('name', 'ASC')->get();

        return view('front.checkout', [
            'countries' => $countries
        ]);
    }


    public function processCheckout(Request $request)
    {
        // STEP-1 Apply validation
        $validator = Validator::make($request->all(), [

            'first_name' => 'required|min:5',
            'last_name' => 'required',
            'email' => 'required|email',
            'country' => 'required',
            'address' => 'required|30',
            'city' => 'required',
            'state' => 'required',
            'zip' => 'required',
            'mobile' => 'required'

        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Please fix the errors',
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }

        // STEP-2 Save users address

        // $customerAddress =
        $user = Auth::user();
        CustomerAddress::updateOrCreate(
            ['user_id' => $user->id],
            [
                'first_name' => $request->first_name,
                'lasr_name' => $request->last_name,
                'email' => $request->email,
                'mobile' => $request->mobile,
                'country_id' => $request->country,
                'address' => $request->address,
                'apartment' => $request->apartment,
                'city' => $request->city,
                'state' => $request->state,
                'zip' => $request->zip
            ]
        );

    }


}
