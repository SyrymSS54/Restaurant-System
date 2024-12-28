<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Restaurant;
use App\Models\Product;
use App\Models\Product_count;


class ProductController extends Controller
{

    public function review_list(Product $dish,Restaurant $restaurant)
    {
        $id = Auth::id();
        $restaurant_id = $restaurant::where('user_id',$id)->first()->id;

        $dish = $dish::where('restaurant_id',$id)->get();

        return response()->json($dish);
    }

    public function review_item(Product $dish,Request $request,Restaurant $restaurant)
    {
        $id = Auth::id();
        $restaurant_id = $restaurant::where('user_id',$id)->first()->id;

        $validated = $request->validate([
            'id' => 'required|numeric'
        ]);

        $id = $validated['id'];
        $dish = $dish::where('restaurant_id',$id)->where('id',$id)->first();

        return response()->json($dish);
    }

    public function create(Product $product,Request $request,Product_count $count,Restaurant $restaurant)
    {
        $id = Auth::id();
        $restaurant_id = $restaurant::where('user_id',$id)->first()->id;

        $validated = $request->validate([
            'name' => 'required|string',
            'unit_price' => 'required|numeric',
            'count' => 'required|numeric'
        ]);

        $product->restaurant_id = $id;
        $product->name = $validated['name'];
        $product->unit_price = $validated['unit_price'];
        $product->save();

        $product_id = $product::where('name',$validated['name'])->where('restaurant_id',$id)->first()->id;
        
        $count->product_id = $product_id;
        $count->count = $validated['count'];
        $count->save();
    }

    public function update(Product $product,Request $request,Restaurant $restaurant)
    {
        $id = Auth::id();
        $restaurant_id = $restaurant::where('user_id',$id)->first()->id;

        $validated = $request->validate([
            'id' => 'required|numeric',
            'name' => 'required|string',
            'unit_price' => 'required|numeric'
        ]);

        $product = $product::where('id',$validated['id']);
        $product->name = $validated['name'];
        $product->unit_price = $validated['unit_price'];
        $product->save();
    }

    public function delete(Product $order,Request $request,Restaurant $restaurant)
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
