<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:api', 'admin', 'cors']);
    }

    public function check()
    {
        return Auth::user();
    }

    public function getAllUsers()
    {
        return User::all();
    }


    public function getUser($id)
    {
        if (User::where('id', $id)->exists()) {
            return User::where('id', $id)->get();
        } else {
            return response()->json([
                "message" => "User not found"
            ], 404);
        };
    }

    public function updateUser(Request $request, $id)
    {
        if (User::where('id', $id)->exists()) {
            if (User::where('email', $request->email)->exists()){
                return response()->json([
                    "message" => "Email already exists in the system"
                ], 412);
            }
            $user = User::find($id);
            $user->name = is_null($request->name) ? $user->name : $request->name;
            $user->email = is_null($request->email) ? $user->email : $request->email;
            $user->password = is_null($request->password) ? $user->password : md5($request->password);
            $user->save();
            return response()->json([
                "message" => "User updated",
                "data" => $user
            ], 200);
        } else {
            return response()->json([
                "message" => "User not found"
            ], 404);
        }
    }

    public function deleteUser($id)
    {
        if (User::where('id', $id)->exists()) {
            $user = User::find($id);
            $user->delete();
            return response()->json([
                "message" => "User deleted"
            ], 200);
        } else {
            return response()->json([
                "message" => "User not found"
            ], 404);
        }
    }
}
