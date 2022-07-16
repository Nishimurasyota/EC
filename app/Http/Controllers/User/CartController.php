<?php

namespace App\Http\Controllers\User;

use App\Constants\Common;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Stock;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function add(Request $request)
    {
    $itemInCart = Cart::where('user_id', Auth::id())
    ->where('product_id', $request->product_id)->first(); //カートに商品があるか確認
    
    if($itemInCart){
    $itemInCart->quantity += $request->quantity; //あれば数量を追加
    $itemInCart->save();
    } else {
    Cart::create([ // なければ新規作成
    'user_id' => Auth::id(),
    'product_id' => $request->product_id,
    'quantity' => $request->quantity
    ]);
    }
    return redirect()->route('user.cart.index');
    }

    public function index(){
        $user = User::findOrFail(Auth::id());
        $products = $user->products;
        $totalPrice = 0;

        foreach($products as $product){
            $totalPrice += $product->price * $product->pivot->quantity;
        }

        // dd($products,$totalPrice);

        return view("user.cart", compact("products","totalPrice"));

    }

    public function delete($id){
        Cart::where('product_id', $id)
        ->where('user_id', Auth::id())->delete();

        return redirect()->route('user.cart.index');
    }

    public function checkout(){
        $user = User::findOrFail(Auth::id());
        $products = $user->products;

        $line_items = [];
        foreach($products as $product){

            $quantity = '';
            $quantity = Stock::where('product_id', $product->id)->sum('quantity');

            if($product->pivot->quantity > $quantity ){
                return redirect()->route('user.cart.index');
                } else {
                    $line_item = [
                        'name' => $product->name,
                        'description' => $product->information,
                        'amount' => $product->price,
                        'currency' => 'jpy',
                        'quantity' => $product->pivot->quantity,
                        ];
        
                        array_push($line_items, $line_item); 
                }
            }
            foreach($products as $product)
            {
            Stock::create([
            'product_id' => $product->id,
            'type' => Common::PRODUCT_LIST["reduce"],
            'quantity' => $product->pivot->quantity * -1
            ]);
            }

        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET_KEY'));
        $session = \Stripe\Checkout\Session::create([
            'line_items' => [$line_items],
            'mode' => 'payment',
            'success_url' => route("user.cart.success"),
            'cancel_url' => route("user.cart.cancel"),
      ]);

        $publickey = env("STRIPE_PUBLIC_KEY");

        // dd("test");

        return view("user.checkout",compact("session","publickey"));    
    }
    public function success(){

        Cart::where("user_id",Auth::id())->delete();
        
        return redirect()->route("user.items.index");
    }

    public function cancel(){
        $user = User::findOrFail(Auth::id());
        foreach($user->products as $product){
            Stock::create([
            'product_id' => $product->id,
            'type' => Common::PRODUCT_LIST["add"],
            'quantity' => $product->pivot->quantity
            ]);
        }

        return redirect()->route("user.cart.index");
       }
}
