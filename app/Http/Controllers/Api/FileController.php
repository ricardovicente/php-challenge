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
        $items = File::whereId($id)->get();
        return $items;
    }
}
