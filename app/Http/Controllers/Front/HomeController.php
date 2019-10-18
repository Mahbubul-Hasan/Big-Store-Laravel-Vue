<?php

namespace App\Http\Controllers\Front;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
         return view("front.master");;
    }

    public function categories()
    {
        $categories = Category::orderby("id", "desc")->get();
        return $categories;
    }

    public function products()
    {
        $data["offerProducts"] = Product::where("offer_price", "!=", 0.00)->where("active", 1)->orderby("id", "desc")->get();
        $data["popularProducts"] = Product::where("popular", 1)->where("active", 1)->orderby("id", "desc")->get();
        $data["products"] = Product::orderby("id", "desc")->get();
        return $data;
    }

    public function singleProduct($id){
        $product = Product::find($id);

        return $product;
    }
    public function relatedProducts($id){
        $product = Product::find($id);
        $products = Product::where("category_id", $product->category_id)->where("active", 1)->orderby("id", "desc")->take(6)->get();

        return $products;
    }

    public function categoryProducts($id){
        $products = Category::with("products")->where("id", $id)->get();

        return $products;
    }
}
