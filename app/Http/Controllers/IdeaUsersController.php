<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\IdeaUser;
use Illuminate\Support\Facades\Validator;

class IdeaUsersController extends Controller
{
    public function generate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'idea_id' => 'required|int',
            'user_id' => 'required|int',
            'user_role' => 'required|string|max:12'
        ]);

        if ($validator->fails()) {
            return response(['message' => 'Validation errors', 'errors' =>  $validator->errors(), 'status' => false], 422);
        }

        $input = $request->all();
        $idea_user = IdeaUser::create($input);

        return response(['data' => $idea_user, 'message' => 'Relationship created successfully!', 'status' => true]);
    }

    public function update(Request $request)
    {
        $input = $request->all();
        $idea_user = IdeaUser::where('idea_id', $input['idea_id'])->where('user_id', $input['user_id'])->first();
        $idea_user['user_role'] = $input['user_role'];
        $idea_user->save();

        return response(['message' => 'Relationship updated successfully!', 'status' => true, 'idea_user' => $idea_user['id']]);
    }

    public function delete(Request $request)
    {
        $input = $request->all();
        $idea_user = IdeaUser::where('idea_id', $input['idea_id'])->where('user_id', $input['user_id'])->first();
        $idea_user->delete();

        return response(['message' => 'Relationship deleted successfully!', 'status' => true, 'id' => $idea_user['id']]);
    }
}
