<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Restaurant;
use App\Models\Dish;

class DishController extends Controller
{

    public function review_list(Dish $dish,Restaurant $restaurant)
    {
        $id = Auth::id();
        $restaurant_id = $restaurant::where('user_id',$id)->first()->id;

        $dish = $dish::where('restaurant_id',$id)->get();

        return response()->json($dish);
    }

    public function review_item(Dish $dish,Request $request,Restaurant $restaurant)
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

    public function create(Request $request,Dish $dish,Restaurant $restaurant)
    {
        $id = Auth::id();
        $restaurant_id = $restaurant::where('user_id',$id)->first()->id;

        $validated = $request->validate([
            'name' => 'required|string',
            'unit_price' => 'required|numeric',
            'recipe' => 'required|json',
            'description' => 'required|string'
        ]);

        $dish->restaurant_id = $id;
        $dish->name = $validated['name'];
        $dish->unit_price = $validated['unit_price'];
        $dish->recipe = $validated['recipe'];
        $dish->description = $validated['description'];

        $dish->save();
    }

    public function update(Request $request,Dish $dish,Restaurant $restaurant)
    {
        $id = Auth::id();
        $restaurant_id = $restaurant::where('user_id',$id)->first()->id;

        $validated = $request->validate([
            'id' => 'required|numeric',
            'name' => 'required|string',
            'unit_price' => 'required|numeric',
            'recipe' => 'required|json',
            'description' => 'required|string'
        ]);

        $dish = $dish::where('id',$validated['id']);
        $dish->name = $validated['name'];
        $dish->unit_price = $validated['unit_price'];
        $dish->recipe = $validated['recipe'];
        $dish->description = $validated['description'];

        $dish->save();
    }

    public function delete(Dish $order,Request $request,Restaurant $restaurant)
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
