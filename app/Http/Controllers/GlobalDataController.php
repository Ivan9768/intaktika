<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class GlobalDataController extends Controller
{
    public static function getGlobalData()
    {
        $service = Service::where('active', true)->get();
        return $service;
    }
}
