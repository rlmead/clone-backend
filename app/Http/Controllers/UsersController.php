<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Validator;

class UsersController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:64',
            'username' => 'required|string|max:64',
            'email' => 'required|email|max:64',
            'password' => 'required|string',
            'image_url' => 'nullable|url',
            'ref_location_id' => 'nullable|int',
            'pronouns' => 'nullable|max:64',
            'bio' => 'nullable|max:255'
        ]);

        if($validator->fails()){
            return response(['message' => 'Validation errors', 'errors' =>  $validator->errors(), 'status' => false], 422);
        }

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $user = User::create($input);
      
        /**Take note of this: Your user authentication access token is generated here **/
        $data['token'] =  $user->createToken('MyApp')->accessToken;
        $data['name'] =  $user->name;

        return response(['data' => $data, 'message' => 'Account created successfully!', 'status' => true]);
    }
    
    public function index()
    {
        return User::get();
    }

    public function get($id)
    {
        return User::findOrFail($id);
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