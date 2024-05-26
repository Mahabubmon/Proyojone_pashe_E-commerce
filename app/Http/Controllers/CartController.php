<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;


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


}
