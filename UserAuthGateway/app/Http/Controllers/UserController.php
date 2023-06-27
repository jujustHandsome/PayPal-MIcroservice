<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Response;
use App\Traits\ApiResponser;

class UserController extends Controller
{
    use ApiResponser;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'refresh', 'logout', 'register']]);
    }


    public function register(Request $request) 
    {
        $validation = [
            'name' => 'required| string',
            'email' => 'required | email| unique:users',
            'password' => 'required | string',
        ];

        $this->validate($request, $validation);

        $password = Hash::make(request('password'));

        $users = User::create(
        [   
            'name' => request('name'),
            'email' => request('email'),
            'password' => $password,
        ]
        );
        
        $token = Auth::attempt([
            'email' => request('email'),
            'password' => request('password')
        ]);
        return $this->respondwithToken($token);
        
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


        public function index(){
            $users = User::all();
            return $this -> successResponse($users);
        }
    
        public function user($id){
            $users = User::findOrFail($id);
            return $this -> successResponse($users);
        }
}