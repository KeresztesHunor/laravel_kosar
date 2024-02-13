<?php

namespace App\Http\Controllers;

use App\Models\Basket;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BasketController extends Controller
{
    public function index(){
        return response()->json(Basket::all());
    }

    public function show($user_id, $item_id){
        $basket = Basket::where('user_id', $user_id)
        ->where('item_id',"=", $item_id)
        ->get();
        return $basket[0];
    }

    public function store(Request $request){
        $item = new Basket();
        $item->user_id = $request->user_id;
        $item->item_id = $request->item_id;
                
        $item->save();
    }

    public function update(Request $request, $user_id, $item_id){
        $item = $this->show($user_id, $item_id);
        $item->user_id = $request->user_id;
        $item->item_id = $request->item_id;

        $item->save();
    }

    public function destroy($user_id, $item_id){
        $this->show($user_id, $item_id)->delete();
    }

    public function delete2dayOld()
    {
        Basket::where('updated_at', '<=' , now()->subDays(2))->delete();
    }

    public function productTypeInBasket($user_id, $product_name)
    {
        return DB::table('products')
            ->join('baskets as b', 'b.item_id', '=', 'products.item_id')
            ->join('product_types as pt', 'pt.type_id', '=', 'products.type_id')
            ->where('b.user_id', $user_id)
            ->where('pt.name', 'like', '%'.$product_name.'%')
            ->get()
        ;
    }

    public function basket()
    {
        return Product::join('baskets as b', 'b.item_id', '=', 'products.item_id')
            //->with('products')
            ->where('b.user_id', '=', Auth::user()->id)
            ->get()
        ;
    }
}
