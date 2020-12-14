<?php

namespace App\Services;

use App\Models\Person;
use App\Models\PersonPhone;

class ImportPeopleService implements ImportServiceInterface
{
    public static function import($items, $fileId)
    {
        foreach($items as $item) {
            $personId = self::insert($item, $fileId);
            self::insertPersonPhone($personId, $item);
        }

        return Person::whereFileId($fileId)->count();
    }

    public static function insert($item, $fileId)
    {
        $data = [
            'file_id' => $fileId,
            'original_id' => $item['personid'],
            'name' => $item['personname']
        ];

        $person = Person::create($data);

        return $person->id;
    }

    private static function insertPersonPhone($personId, $item)
    {
        if (is_array($item['phones']['phone'])) {
            foreach ($item['phones']['phone'] as $phone) {
                self::insertPersonPhoneItem($personId, $phone);
            }
            return;
        }

        self::insertPersonPhoneItem($personId, $item['phones']['phone']);

        return;
    }

    private static function insertPersonPhoneItem($personId, $item)
    {
        $data = [
            'person_id' => $personId,
            'number' => $item
        ];

        PersonPhone::create($data);

        return;
    }
}