<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Idea;
use Illuminate\Support\Facades\Validator;

class IdeasController extends Controller
{
    public function generate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:64',
            'status' => 'required|email|max:8',
            'image_url' => 'nullable|url',
            'ref_location_id' => 'nullable|int',
            'description' => 'nullable|max:255'
        ]);

        if($validator->fails()){
            return response(['message' => 'Validation errors', 'errors' =>  $validator->errors(), 'status' => false], 422);
        }

        $input = $request->all();
        $idea = Idea::create($input);

        return response(['data' => $idea, 'message' => 'Listing created successfully!', 'status' => true]);
    }
    
    public function index()
    {
        return Idea::select('id', 'name', 'image_url')->get();
    }

    public function get($id)
    {
        return Idea::findOrFail($id);
    }

    public function update(Request $request)
    {
        $input = $request->all();
        $idea = Idea::find($input['id']);
        // loop through input associative array
        foreach ($input as $field => $value) {
            // update all fields that are in input
            $idea[$field] = $value;
        }
        $idea->save();
        
        return response(['message' => 'Idea updated successfully!', 'status' => true, 'idea' => $idea['email']]);
    }

    public function delete(Request $request)
    {
        $input = $request->all();
        $idea = Idea::find($input['id']);
        $idea->delete();

        return response(['message' => 'Idea deleted successfully!', 'status' => true, 'id' => $input['id']]);
    }

}