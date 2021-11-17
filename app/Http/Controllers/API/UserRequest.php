<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;
use Validator;

class UserRequest extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request){
        $input = $request->only('email', 'password');
        $token = 'none';

        if (!$token = JWTAuth::attempt($input)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid Email or Password',
                'token' => 'none',
            ], 401);
        } else {
            return $this->createNewToken($token);
        }
    }

    /**
     * Register a User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|between:2,100',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|min:6',

        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }

        $user = User::create(array_merge(
                    $validator->validated(),
                    [
                        'level' => 2,
                        'password' => bcrypt($request->password),
                    ]

                ));

        return response()->json([
            'message' => 'User successfully registered',
            'user' => $user
        ], 201);
    }


    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout() {
        Auth::logout();

        return response()->json(['message' => 'User successfully signed out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh() {
        return $this->createNewToken(Auth::refresh());
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function userProfile() {
        return response()->json(Auth::user());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function createNewToken($token){
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60,
            'user' => Auth::user(),
        ]);
    }

    public function changePassWord(Request $request) {
        // $validator = Validator::make($request->all(), [
        //     'old_password' => 'required|string|min:6',
        //     'new_password' => 'required|string|min:6',
        // ]);

        if (Hash::check($request->old_password, Auth::user()->password)) {
            if($request->new_password == $request->confirm_password){
                $userId = Auth::user()->_id;

                $user = User::where('_id', $userId)->update(
                            ['password' => bcrypt($request->new_password)]
                        );

                return response()->json([
                    'success' => true,
                    'message' => 'User successfully changed password',
                    // 'request' => $request->new_password.'+++'.$request->confirm_password,
                ], 201);
            }else{
                return response()->json([
                    'success' => false,
                    'message' => 'Password confirm not correct',
                    // 'request' => $request->new_password.'+++'.$request->confirm_password,
                ]);
            }
        }else{
            return response()->json([
                'success' => false,
                'message' => 'Your old-password does not match',
                // 'request' => $request->new_password.'+++'.$request->confirm_password,
            ]);
        }

        // if($validator->fails()){
        //     return response()->json($validator->errors()->toJson(), 400);
        // }

    }
}
