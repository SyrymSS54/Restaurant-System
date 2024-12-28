<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Restaurant;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{

    public function index()
    {
        return view('order');
    }

    public function review_list(Order $order,Restaurant $restaurant)
    {
        $id = Auth::id();
        $restaurant_id = $restaurant::where('user_id',$id)->first()->id;
        $order = $order::where('user_id',$id)->where('restaurant_id',$restaurant_id)->get();

        return response()->json($order);
    }

    public function review_item(Order $order,Request $request,Restaurant $restaurant)
    {
        $id = Auth::id();
        $restaurant_id = $restaurant::where('user_id',$id)->first()->id;

        $validated = $request->validate([
            'id' => 'required|numeric'
        ]);

        $id = $validated['id'];
        $order = $order::where('user_id',$id)->where('restaurant_id',$id)->where('id',$id)->first();

        return response()->json($order);
    }

    public function create(Order $order,Request $request,Restaurant $restaurant)
    {
        $id = Auth::id();
        $restaurant_id = $restaurant::where('user_id',$id)->first()->id;

        $validated = $request->validate([
            'order' => 'required|json',
            'paid' => 'required|boolean'
        ]);

        $order->user_id = $id;
        $order->restaurant_id = $id;
        $order->order = $validated['order'];
        $order->paid = $validated['paid'];

        $order->save();
    }

    public function update(Order $order,Request $request,Restaurant $restaurant)
    {
        $id = Auth::id();
        $restaurant_id = $restaurant::where('user_id',$id)->first()->id;

        $validated = $request->validate([
            'id' => 'required|numeric',
            'order' => 'required|json',
            'paid' => 'required|boolean'
        ]);


        $order = $order::where('id',$validated['id']);
        $order->user_id = $id;
        $order->restaurant_id = $id;
        $order->order = $validated['order'];
        $order->paid = $validated['paid'];

        $order->save();
    }

    public function delete(Order $order,Request $request,Restaurant $restaurant)
    {
        $id = Auth::id();
        $restaurant_id = $restaurant::where('user_id',$id)->first()->id;

        $validated = $request->validate([
            'id' => 'required|numeric'
        ]);

        $id = $validated['id'];
        $order::where('id',$id)->delete();
    }
}
