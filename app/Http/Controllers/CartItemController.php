<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\UpdateCartItem;
use Illuminate\Support\Facades\DB;
use App\Models\Cart;
use App\Models\Product;
use App\Models\CartItem;

class CartItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

        $mes = [
            'required' => ':attribute 是必須要填寫',
            'between' => ':attribute 您輸入的 quantity :input 不在  :min  和 :max 之間'

        ];

        $validator = Validator::make($request->all(),[
            'cart_id' => 'required|integer',
            'product_id' => 'required|integer',
            'quantity' => 'required|integer|between:0,100'
        ],$mes);

        if( $validator->fails()){
            return response($validator->errors(), 400);
        };

        $validateData = $validator->validate();
        // print_R($validateData);

        // $form = $request->all();

        $product = Product::find($validateData['product_id']);

        if(!$product->checkQuantity($validateData['quantity'])){
            return response($product->title.'數量不足',400);
        }

        $cart = Cart::find($validateData['cart_id']);
        $result = $cart->cartItems()->create(['product_id' => $product->id,'quantity' => $validateData['quantity']]);


        // DB::table('cart_items')->insert(['cart_id' => $validateData['cart_id'],'product_id' => $validateData['product_id'],'quantity' => $validateData['quantity']]);

        return response()->json($result);
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
    public function update(UpdateCartItem $request, $id)
    {

        $form = $request->validated();
        $item = CartItem::find($id);
        $item->update(['quantity' => $form['quantity']]);
        $item->save();

        // DB::table('cart_items')->where('id',$id)->update(['quantity' => $form['quantity'],'updated_at' => now()]);

        return response()->json('update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = CartItem::find($id)->delete();

        // DB::table('cart_items')->where('id',$id)->delete();

        return response('刪除成功');
    }
}
