<?php

namespace App\Exports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class OrderExport implements FromCollection, WithHeadings
{
    public function __construct(public $order)
    {
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {

        $orders = $this->order->order_items->transform(function ($order_item) {
            return [
                "order_num" => $order_item->order->id,
                "status" => $order_item->order->status,
                "store" => $order_item->order->store->name,
                "mall" => $order_item->order->store->mall->name,
                "region" => $order_item->order->store->mall->region->name_pretty,
                "product_name" => $order_item->product->name,
                "quantity" => $order_item->quantity,
            ];
        });

        return $orders;
    }

    public function headings(): array
    {
        return [
            ['Order Number', 'Status', "Store", "Mall", "Region", "Product Name", "Quantity"],
        ];
    }
}
