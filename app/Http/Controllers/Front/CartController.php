<?php

namespace App\Http\Controllers\Front;

use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use Darryldecode\Cart\Cart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CartController extends Controller
{
    public function index(){
        $data["cartProducts"] = \Cart::getContent();
        $data["subTotal"] = \Cart::getSubTotal();
        return $data;
    }

    public function store(Request $request, $id){
        $this->validate($request, [
            'quantity' => 'required',
        ]);

        $product = Product::select(["id", "name", "price", "offer_price", "photo", "short_description"])->where("id", $id)->first();

        \Cart::add(array(
            'id' => $product->id,
            'name' => $product->name,
            'price' => ($product->offer_price > 0)? $product->offer_price : $product->price,
            'quantity' => $request->quantity,
            'attributes' => array(
                'photo' => $product->photo,
                'short_description' => $product->short_description
            )
        ));
    }

    public function update(Request $request, $id){

//        return $request->all();
        $this->validate($request, [
            'quantity' => 'required',
        ]);

        \Cart::update($id, array(
            'quantity' => $request->quantity,
        ));
    }

    public function remove($id){
       \Cart::remove($id);
    }

    public function removeAll(){
       \Cart::clear();
    }



    public function checkout(Request $request){

        $this->validate($request, [
            'customer_name' => 'required',
            'customer_phone' => ['required', 'min:11', 'max:11', 'regex:/(01)[0-9]{9}/'],
            'customer_address' => 'required',
            'location' => 'required',
        ]);

        $order = new Order();
        $order = $order->saveNewOrderInfo($request, $order);

        $cartProducts = \Cart::getContent();
        foreach ($cartProducts as $product) {
            $orderProduct = new OrderProduct();
            $orderProduct->saveNewOrderProductInfo($orderProduct, $product, $order);
        }

        \Cart::clear();
    }
}
