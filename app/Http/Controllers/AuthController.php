<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\CustomerAddress;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
     /**
     * Login Action
     *
     * 
     */
     /**
 * 
 * @author Mahabub Mon<mahabubmon@gmail.com>
 */
    public function login()
    {

        return view("front.account.login");
    }

     /**
     * register Action
     *
     * 
     */

    public function register()
    {
        return view("front.account.register");
    }

    /**
     * processRegister Action
     *
     * 
     */

    public function processRegister(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:5|confirmed'
        ]);

        if ($validator->passes()) {
            $user = new User;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->password = Hash::make($request->password);
            $user->save();

            session()->flash('success', "you have been registered successfully.");

            return response()->json([
                'status' => true,
            ]);
        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }

    
    /**
     * authenticate Action
     *
     * 
     */
    public function authenticate(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if ($validator->passes()) {



            if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {
                if (session()->has('url.intended')) {
                    return redirect(session()->get('url.intended'));
                }
                return redirect()->route('account.profile');
            } else {

                // session()->flash('error', 'Either email/password incorrect');
                return redirect()->route('account.login')->withInput($request->only('email'))->with('error', 'Either email/password incorrect');

            }

        } else {
            return redirect()->route('account.login')->withErrors($validator)->withInput($request->only('email'));
        }

    }


    public function profile()
    {
        $userId = Auth::user()->id;

        

        $countries = Country::orderBy('name','ASC')->get();
        $user = User::where('id',  $userId)->first();

        $address =  CustomerAddress::where('user_id',$userId)->first();

        return view("front.account.profile", [
            'user' => $user,
            'countries' => $countries,
            'address' => $address,
        ]);

    }

    public function updateProfile(Request $request)
    {
        $userId = Auth::user()->id;
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,expected,id',
            'phone' => 'required'
        ]);

        if ($validator->passes()) {
            $user = User::find($userId);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->save();  

            session()->flash('success','Profile Updated Successfully');

        } else {
            return response()->json([
                'status' => true,
                'message' =>'Profile Updated Successfully'
            ]);
        }
    }
    public function updateAddress(Request $request)
    {
        $userId = Auth::user()->id;

        $validator = Validator::make($request->all(), [

            'first_name' => 'required|min:5',
            'last_name' => 'required',
            'email' => 'required|email',
            'country_id' => 'required',
            'address' => 'required|min:30',
            'city' => 'required',
            'state' => 'required',
            'zip' => 'required',
            'mobile' => 'required'

        ]);

        if ($validator->passes()) {
            CustomerAddress::updateOrCreate(
                ['user_id' =>$userId],
                [
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'email' => $request->email,
                    'mobile' => $request->mobile,
                    'country_id' => $request->country_id,
                    'address' => $request->address,
                    'apartment' => $request->apartment,
                    'city' => $request->city,
                    'state' => $request->state,
                    'zip' => $request->zip
                ]
            );

            session()->flash('success','Address Updated Successfully');

        } else {
            return response()->json([
                'status' => true,
                'message' =>'Profile Updated Successfully'
            ]);
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('account.login')->with('success', 'You successfully Logout');



    }

    public function orders()
    {

        $user = Auth::user();

        $orders = Order::where('user_id', $user->id)->orderBy('created_at', 'DESC')->get();

        $data['orders'] = $orders;
        return view('front.account.order', $data);
    }

    public function orderDetail($id)
    {
        //getting order details
        $data = [];
        $user = Auth::user();
        $order = Order::where('user_id', $user->id)->where('id', $id)->first();
        $data['order'] = $order;

        $orderItems = OrderItem::where('order_id', $id)->get();
        $data['orderItems'] = $orderItems;


        $orderItemsCount = OrderItem::where('order_id', $id)->get();
        $data['orderItemsCount'] = $orderItemsCount;

        return view('front.account.order-detail', $data);

    }

    public function wishlist()
    {
        $wishlists = Wishlist::where('user_id', Auth::user()->id)->get();

        $data = [];
        $data['wishlists'] = $wishlists;
        return view('front.account.wishlist', $data);

    }

    public function removeProductFromWishList(Request $request)
    {
        $wishlist = Wishlist::where('user_id', Auth::user()->id)->where('product_id', $request->id)->first();

        if ($wishlist == null) {
            session()->flash('error', 'Product already removed');

            return response()->json([
                'status' => true,

            ]);
        } else {
            Wishlist::where('user_id', Auth::user()->id)->where('product_id', $request->id)->delete();
            session()->flash('success', 'Product removed successfully.');

            return response()->json([
                'status' => true,

            ]);
        }
    }

}
