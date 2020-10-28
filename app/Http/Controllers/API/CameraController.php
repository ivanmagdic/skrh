<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\CameraResourceCollection;
use App\Models\Camera;
use Illuminate\Http\Request;

class CameraController extends Controller
{
    public function index()
    {
        return CameraResourceCollection::make(Camera::query()->get([
            'id',
            'longitude',
            'latitude',
            'name'
        ]));
    }
}
