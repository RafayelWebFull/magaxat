<?php

namespace App\Http\Controllers\Api\V1\Country;

use App\Http\Controllers\Api\Traits\ApiResponser;
use App\Http\Controllers\Controller;
use App\Http\Resources\Country\CountryResource;
use App\Models\Country;

class CountryController extends Controller
{
    use ApiResponser;

    public function index()
    {
        return $this->successResponse([
            'data' => CountryResource::collection(Country::all())->hide(['created_at','updated_at'])
        ]);
    }
}
