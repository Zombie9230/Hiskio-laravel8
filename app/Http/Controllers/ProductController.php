<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateProduct;
use App\Models\Product;
use Illuminate\Support\Facades\Redis;
use App\Http\Services\ShorUrlService;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $data = DB::table('products')->get();
        dump(now());
        for($i = 0;$i < 10000;$i++){
            $data = DB::table('products')->get();
        }

        dump(now());
        $data = json_decode(Redis::get('products'));

        return response ($data);
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $products = new Product;
        $products->fill([
            'title' => $request->title,
            'content' => $request->content,
            'price' => $request->price,
            'quantity' => $request->quantity
        ]);
        $products->save();

        return response('產品建立成功');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function checkProduct(Request $request){
        $id = $request->all()['id'];

        $product = Product::find($id);
        if($product->quantity > 0){
            return response(true);
        }else{
            return response(false);
        }
    }

    public function sharedUrl($id){

        $service = new ShorUrlService();
        $url = $service->makeShortUrl("http://localhost:3000/products/$id");
        return response(['url' => $url]);

    }
}