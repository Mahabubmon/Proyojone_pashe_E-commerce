<?php

use App\Mail\OrderEmail;
use App\Models\Category;
use App\Models\Order;
use App\Models\ProductImage;
use Illuminate\Support\Facades\Mail;

function getCategories()
{
    return Category::orderBy('name', 'ASC')
        ->with('sub_category')
        ->orderBy('id', 'DESC')
        ->where('status', 1)
        ->where('showHome', 'Yes')
        ->get();
}

function getProductImage($productId)
{
    return ProductImage::where('product_id', $productId)->first();
}


function OrderEmail($orderId)
{
    $order = Order::where('id', $orderId)
        ->with('items')
        ->first();

    $mailData = [

        'subject' => 'Thanks for Your order',
        'order' => $order
    ];


    Mail::to($order->emmail)->send(new OrderEmail());
}
?>