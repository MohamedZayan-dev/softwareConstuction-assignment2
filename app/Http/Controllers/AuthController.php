<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use stdClass;

class AuthController extends Controller
{

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        $credentials = request(['email', 'password']);

        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    /**
     * Registers a new user.
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function signup(Request $request)
    {

        $validatedData = $request->validate([
            'email' => ['required', 'unique:users', 'email'],
            'password' => 'required',
            'name' => 'required'
        ]);

        User::create(['name' => $validatedData['name'], 'email' => $validatedData['email'], 'password' => Hash::make($validatedData['password'])]);
    }

    /**
     * Registers a new admin user.
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function registerAdmin(Request $request)
    {

        $validatedData = $request->validate([
            'email' => ['required', 'unique:users', 'email'],
            'password' => 'required',
            'name' => 'required'
        ]);

        $validatedData['role'] = config('roles.admin');
        User::create(['name' => $validatedData['name'], 'email' => $validatedData['email'], 'password' => Hash::make($validatedData['password']), 'role' => $validatedData['role']]);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
        ]);
    }
}
