<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Money;
use App\Models\User;
use App\Traits\ApiResponser;
use App\Http\Controllers\Response;

class AuthController extends Controller
{
    use ApiResponser;
/**
 * Create a new controller instance.
 *
 * @return void
 */
public function __construct()
{
    $this->middleware('auth:api', ['except' => ['register', 'login', 'refresh', 'logout']]);
}

    /**
 * Get a JWT via given credentials.
 *
 * @param  Request  $request
 * @return Response
 */

    public function login(Request $request)
    {
        $validation = [
            'email' => 'required | email',
            'password' => 'required | string'
        ];

        $this->validate($request, $validation);

        $credentials = $request->only(['email', 'password']);

        if (! $token = Auth::attempt($credentials)) {
            return $this->errorResponse("invalid email or password", 403);
        }
            return $this->respondwithToken($token);
    }

    public function me()
    {    
        $id = auth()->user()->id;
        $user = Money::findOrFail($id);
        return $this->successResponse($user);
    }

    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    public function refresh()
    {
        return $this->respondwithToken(auth()->refresh());
    }



    protected function respondwithToken($token) 
    {
        return response()->json(
            [
                'access_token' => $token,
                'token_type' => 'bearer',
                'user' => auth()->user(),
                'expires_in' => auth()->factory()->getTTL() * 60 * 24
            ]
            );
    }
}