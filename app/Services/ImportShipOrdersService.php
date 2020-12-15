<?php

namespace App\Services;

use App\Models\Person;
use App\Models\ShipItem;
use App\Models\ShipOrder;
use App\Models\ShipTo;

class ImportShipOrdersService implements ImportServiceInterface
{
    public static function import($items, $fileId)
    {
        foreach($items as $item) {
            $shipOrder = self::insert($item, $fileId);
            self::insertShipTo($item, $shipOrder);
            self::insertShipItem($item, $shipOrder);
        }

        return ShipOrder::whereFileId($fileId)->count();
    }

    public static function insert($item, $fileId)
    {
        $person = Person::select('id')->where('original_id', $item['orderperson'])->first();

        $data = [
            'file_id' => $fileId,
            'person_id' => $person->id,
            'original_id' => $item['orderid']
        ];

        $shipOrder = ShipOrder::create($data);

        return $shipOrder->id;
    }

    private static function insertShipTo($item, $shipOrderId)
    {
        $data = [
            'ship_order_id' => $shipOrderId,
            'name' => $item['shipto']['name'],
            'address' => $item['shipto']['address'],
            'city' => $item['shipto']['city'],
            'country' => $item['shipto']['country']
        ];

        ShipTo::create($data);

        return;
    }

    private static function insertShipItem($item, $shipOrderId)
    {
        $setItems = count($item['items']['item']) == 2 ? $item['items']['item'] : $item['items'];

        foreach ($setItems as $itemOnce) {
            $data = [
                'ship_order_id' => $shipOrderId,
                'title' => $itemOnce['title'],
                'note' => $itemOnce['note'],
                'quantity' => $itemOnce['quantity'],
                'price' => $itemOnce['price']
            ];

            ShipItem::create($data);
        }
        return;
    }

}