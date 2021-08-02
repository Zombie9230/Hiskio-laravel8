<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Exception;

class Cart extends Model
{
    use HasFactory;

    protected $guarded = [''];

    private $vip = 1;

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function order(){
        return $this->hasOne(Order::class);
    }

    public function cartItems(){
        return $this->hasMany(CartItem::class);
    }

    public function checkout(){
        $result = DB::transaction(function () {
            foreach($this->cartItems as $cartItem){
                $product = $cartItem->product;
                if(!$product->checkQuantity($cartItem->quantity)){
                    return $product->title.'數量不足';
                }
            }

            $order = $this->order()->create([
                'user_id' => $this->user_id
            ]);

            if($this->user->level == 1){
                $this->vip = 0.5;
            }
            // throw new Exception('123123');

            foreach($this->cartItems as $cartItem){
                $order->orderItems()->create([
                    'product_id' => $cartItem->product_id,
                    'price' => $cartItem->product->price * $this->vip,
                ]);
                $cartItem->product->update(['quantity' =>  $cartItem->product->quantity - $cartItem->quantity]);
            }

            $this->update(['checkouted' => true]);

            $order->orderItems;
            return $order;
        });

        return $result;
    }
}