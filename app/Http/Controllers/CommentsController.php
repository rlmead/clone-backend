<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\Validator;

class CommentsController extends Controller
{
    public function add(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'parent_id' => 'nullable|int',
            'idea_id' => 'required|int',
            'user_id' => 'required|int',
            'text' => 'required|string'
        ]);

        if($validator->fails()){
            return response(['message' => 'Validation errors', 'errors' =>  $validator->errors(), 'status' => false], 422);
        }

        $input = $request->all();
        $comment = Comment::create($input);

        return response(['data' => $comment, 'message' => 'Comment created successfully!', 'status' => true]);
    }

    public function get_by_idea(Request $request)
    {
        $idea_id = $request['idea_id'];
        return Comment::where('idea_id', $idea_id)
        ->with('users')
        ->orderBy('created_at', 'desc')
        ->get();
    }

    public function update(Request $request)
    {
        $input = $request->all();
        $comment = Comment::find($input['id']);
        $comment['text'] = $input['text'];
        $comment->save();
        
        return response(['message' => 'Comment updated successfully!', 'status' => true, 'comment' => $comment['id']]);
    }

    public function delete(Request $request)
    {
        $input = $request->all();
        $comment = Comment::find($input['id']);
        $comment->delete();

        return response(['message' => 'Comment deleted successfully!', 'status' => true, 'id' => $input['id']]);
    }

}