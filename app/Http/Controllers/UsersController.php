<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:64',
            'username' => 'required|max:64',
            'email' => 'nullable|email|max:64',
            'password' => 'required|string',
            'image_url' => 'nullable|url',
            'ref_location_id' => 'nullable|int',
            'pronouns' => 'nullable|max:64',
            'bio' => 'nullable|text'
        ]);

        if($validator->fails()){
            return response(['message' => 'Validation errors', 'errors' =>  $validator->errors(), 'status' => false], 422);
        }

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $user = User::create($input);
      
        /**Take note of this: Your user authentication access token is generated here **/
        $data['token'] =  $user->createToken('MyApp')->accessToken;
        $data['user_data'] = $user;

        return response(['data' => $data, 'message' => 'Account created successfully!', 'status' => true]);
    }
    
    public function index()
    {
        return User::select('id', 'name', 'image_url')->orderBy('name')->get();
    }

    public function get($id)
    {
        return User::with('location')->findOrFail($id);
    }

    public function get_by_username(Request $request)
    {
        $input = $request->all();
        $user = User::with('location')->where('username',$input['username'])->get()->first();
        return $user;
    }

    public function get_creations(Request $request)
    {
        $input = $request->all();
        $creations = User::findOrFail($input['id'])->creations;
        return $creations;
    }

    public function get_collaborations(Request $request)
    {
        $input = $request->all();
        $collaborations = User::findOrFail($input['id'])->collaborations;
        return $collaborations;
    }

    public function update(Request $request)
    {
        $input = $request->all();
        $user = User::find($input['id']);
        // loop through input associative array
        foreach ($input as $field => $value) {
            // update all fields that are in input
            $user[$field] = $value;
        }
        $user->save();
        
        return response(['message' => 'User updated successfully!', 'status' => true, 'user' => $user['username']]);
    }

    public function delete(Request $request)
    {
        $input = $request->all();
        $user = User::find($input['id']);
        $user->delete();

        return response(['message' => 'User deleted successfully!', 'status' => true, 'id' => $input['id']]);
    }

}