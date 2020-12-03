<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Idea;
use App\Models\IdeaUser;
use Illuminate\Support\Facades\Validator;

class IdeasController extends Controller
{
    public function generate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:64',
            'status' => 'required|string|max:8',
            'image_url' => 'nullable|url',
            'ref_location_id' => 'nullable|int',
            'description' => 'nullable|string'
        ]);

        if($validator->fails()){
            return response(['message' => 'Validation errors', 'errors' =>  $validator->errors(), 'status' => false], 422);
        }

        $input = $request->all();
        $idea = Idea::create($input);

        $ideauser = new IdeaUser();
        $ideauser["idea_id"] = $idea->id;
        $ideauser["user_id"] = $request->user;
        $ideauser["user_role"] = "creator";
        $ideauser->save();

        return response(['data' => $idea, 'message' => 'Listing created successfully!', 'status' => true]);
    }
    
    public function index()
    {
        return Idea::select('id', 'name', 'image_url')
        ->where('status', 'open')
        ->orderBy('updated_at', 'desc')
        ->get();
    }

    public function index_by_user(Request $request)
    {
        $user_id = $request['user'];
        return Idea::select('id', 'name', 'image_url', 'status')
        ->with('users:id')
        ->whereHas('users', function($query) use ($user_id) {
        $query->where('users.id', $user_id);
        })
        ->orderBy('status', 'desc')
        ->orderBy('updated_at', 'desc')
        ->get();
    }

    public function get($id)
    {
        return Idea::findOrFail($id);
    }

    public function get_users(Request $request)
    {
        $input = $request->all();
        return Idea::findOrFail($input['id'])->users()->select('users.id', 'users.name')->withPivot('user_role')->get();
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