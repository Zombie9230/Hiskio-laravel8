<?php

namespace App\Exports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\Schema;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class OrdersExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public $dataCount;

    public function collection()
    {
        $orders = Order::with(['user','cart.cartItems.product'])->get();
        $orders = $orders->map(function($order){
            return [
                $order->id,
                $order->user->name,
                $order->is_shipped,
                $order->cart->cartItems->sum(function($cartItem){
                    return $cartItem->product->price * $cartItem->quantity;
                }),
                $order->created_at,
                // Date::dateTimeToExcel($order->created_at)
            ];
        });
        $this->dataCount = $orders->count();
        return $orders;


        // return Order::all();w
    }

    public function headings(): array
    {
        // return Schema::getColumnListing('orders');
        return ['編號', '購買者', '購物車 id', '總價', '建立時間'];
    }

    public function columnFormats(): array
    {
        return [
            'B' => NumberFormat::FORMAT_TEXT,
            'D' => NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1,
            'E' => NumberFormat::FORMAT_DATE_DDMMYYYY,
        ];
    }
}