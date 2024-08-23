<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Email</title>
</head>

<body style="font-family: Arial, Helvetica, sans-serif; font-size:16px;">

    <h1>Thanks for your order!!</h1>
    <h2>You order Id Is: #{{$mailData['order']->id}}</h2>



    <h2>Products</h2>

    <table cellpadding="'3" cellspacing="3" border="0">
        <thead>
            <tr>
                <th>Product</th>
                <th>Price</th>
                <th>Qty</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($mailData['order']->item as $item)
                <tr>
                    <td>{{$item->name}}</td>
                    <td>${{$item->price}}</td>
                    <td>{{$item->qty}}</td>
                    <td>${{$item->total}}</td>
                </tr>

            @endforeach
            <tr>
                <th colspan="3" align="right">Subtotal:</th>
                <td>${{number_format($mailData['order']->subtotal, 2)}}</td>
            </tr>

            <tr>
                <th colspan="3" align="right">
                    Discount:{{(!empty($mailData['order']->coupon_code)) ? '(' . $mailData['order']->coupon_code . ')' : '' }}
                </th>
                <td>${{number_format($mailData['order']->discount, 2)}}</td>
            </tr>
            <tr>
                <th colspan="3" align="right">Shipping:</th>
                <td>${{number_format($mailData['order']->shipping, 2)}}</td>
            </tr>
            <tr>
                <th colspan="3" align="right">Grand Total:</th>
                <td>${{number_format($mailData['order']->grand_total, 2)}}</td>

            </tr>
        </tbody>
    </table>
</body>

</html>