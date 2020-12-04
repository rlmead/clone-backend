<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Location;
use Illuminate\Support\Facades\Validator;

class LocationsController extends Controller
{
    public function add(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'postal_code' => 'string|max:64',
            'city' => 'string|max:64',
            'state' => 'string|max:64',
            'country_code' => 'string|max:64',
            'meta' => 'json|nullable'
        ]);

        if($validator->fails()){
            return response(['message' => 'Validation errors', 'errors' =>  $validator->errors(), 'status' => false], 422);
        }

        $input = $request->all();
        $location = Location::create($input);

        return response(['data' => $location, 'message' => 'Location created successfully!', 'status' => true]);
    }

    public function get_by_postal_code(Request $request)
    {
        $postal_code = $request['postal_code'];
        return Location::where('postal_code', $postal_code)->get();
    }

}