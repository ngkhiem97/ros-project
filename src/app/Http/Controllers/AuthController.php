<?php


namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Enums\UserType;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware(['cors']);
    }

    public function register(Request $request)
    {
        if (User::where('email', $request->email)->exists()) {
            return response()->json(['error' => 'Email exists in the system'], 406);
        }
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'type' => UserType::Member
        ]);

        $token = auth()->login($user);

        return $this->respondWithToken($token);
    }

    public function login(Request $request)
    {
        $credentials = $request->only(['email', 'password']);
        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}
