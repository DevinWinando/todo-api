<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterAPIRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * @param int $id
     * 
     * @OA\Post(
     *     path="/login",
     *     summary="Login",
     *     tags={"Auth"},
     *     description="Login",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *              required={"description", "password"},
     *              @OA\Property(
     *                  property="email",
     *                  type="string",
     *                  example="example@gmail.com"
     *              ),
     *              @OA\Property(
     *                  property="password",
     *                  type="string",
     *                  example="password"
     *              ),
     *          )
     *      ),
     *     @OA\Response(
     *          response=200,
     *          description="successful operation",
     *          @OA\Schema(
     *              type="object",
     *              @OA\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     *   )
     */
    public function login(Request $request)
    {
        $auth = Auth::attempt($request->only('email', 'password'));

        if (!$auth) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid credentials'
            ], 401);
        }

        return response()->json([
            'success' => true,
            'message' => 'Login successful',
            'token' => 'Bearer ' . Auth::user()->createToken('jwt')->plainTextToken
        ]);
    }

    /**
     * @param int $id
     * 
     * @OA\Post(
     *     path="/register",
     *     summary="register",
     *     tags={"Auth"},
     *     description="Register",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *              required={"description", "password"},
     *              @OA\Property(
     *                  property="name",
     *                  type="string",
     *                  example="Example"
     *              ),
     *              @OA\Property(
     *                  property="email",
     *                  type="string",
     *                  example="example@gmail.com"
     *              ),
     *              @OA\Property(
     *                  property="password",
     *                  type="string",
     *                  example="password"
     *              ),
     *          )
     *      ),
     *     @OA\Response(
     *          response=200,
     *          description="successful operation",
     *          @OA\Schema(
     *              type="object",
     *              @OA\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     *   )
     */
    public function register(RegisterAPIRequest $request)
    {
        $user = User::create($request->only('name', 'email') + [
            'password' => bcrypt($request->password)
        ]);

        return response()->json([
            'success' => true,
            'message' => 'User created successfully',
            'data' => $user
        ]);
    }
}
