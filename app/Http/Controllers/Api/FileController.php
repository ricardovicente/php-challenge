<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\File;

class FileController extends Controller
{
    public function index()
    {
        $files = File::all();
        return $files;
    }

    public function items($id)
    {
        return File::whereId($id)->with(['person' => function ($query) {
            $query->with('person_phone');
        }])->with(['ship_order' => function ($query) {
            $query->with('ship_to');
            $query->with('ship_item');
        }])->get();
    }
}
