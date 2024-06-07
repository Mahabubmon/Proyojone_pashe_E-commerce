<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DiscountCodeController extends Controller
{
    //
    public function index()
    {

    }

    public function create()
    {
        return view('admin.coupon.create');

    }
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'code' => 'required',
            'type' => 'required|in:percent,fixed',
            'discount_amount' => 'required|numeric',
            'status' => 'required|boolean',
        ]);

        if ($validator->passes()) {

        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }
    public function edit()
    {

    }
    public function update()
    {

    }
    public function destroy()
    {

    }

}
