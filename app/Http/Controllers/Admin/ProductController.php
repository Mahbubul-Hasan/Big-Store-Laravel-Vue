<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::with("category")->orderBy("id", "desc")->get();
        return $products;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'category_id' => 'required',
            'code' => 'required',
            'price' => 'required',
            'short_description' => 'required',
            'long_description' => 'required',
            'photo' => 'required',
        ]);

        $directoryDB = $this->saveImage($request);

        $product = New Product();
        $product->saveProductInfo($request, $product, $directoryDB);

    }

    public function saveImage($request)
    {
        $photo = $request->photo;

        $position = strpos($photo, ";");
        $subString = substr($photo, 0, $position);
        $extension = explode("/", $subString)[1];

        $imgName = "IMG_" . date("Ymd_his") . "." . $extension;
        $directory = "img/post/".$imgName;

        Image::make($photo)->save($directory);

        return "/".$directory;
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'category_id' => 'required',
            'code' => 'required',
            'price' => 'required',
            'short_description' => 'required',
            'long_description' => 'required',
            'photo' => 'required',
        ]);
        $product = Product::find($id);

        if ($request->photo != $product->photo){
            $directory = "img\post\_".$product->photo;
            if (file_exists($directory)){
                unlink($directory);
            }

            $directoryDB = $this->saveImage($request);
        } else{
            $directoryDB = $product->photo;
        }

        $product->saveProductInfo($request, $product, $directoryDB);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);

        $directory = "img\post\_".$product->photo;
        if (file_exists($directory)){
            unlink($directory);
        }

        $product->delete();
    }
}
