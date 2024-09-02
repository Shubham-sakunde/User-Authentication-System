<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Models\User;
// use Exception;
// use Illuminate\Support\Str;
// use Illuminate\Validation\ValidationException;
// use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Exception;




class AuthController extends Controller
{
    //signup
    public function signup(Request $request)
    {
        $validateUser = Validator::make(
            $request->all(),
            [
                'name' => 'required|min:2',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:8',
            ]
        );

        if ($validateUser->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation Error',
                'errors' => $validateUser->errors()->all(),
                'data' => null,
                'status' => 401,
            ], 401);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'User Created Successfully',
            'data' => [
                'user_id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
            ],
            'status' => 201,
        ], 201);
    }




    //login
    public function login(Request $request)
    {
        $validateUser = Validator::make(
            $request->all(),
            [
                'email' => 'required|email',
                'password' => 'required',
            ]

        );

        if ($validateUser->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Authentication Fails',
                'errors' => $validateUser->errors()->all(),
                'data' => null,
                'status' => 404,
            ], 404);
        }

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $authUser = Auth::user();
            return response()->json([
                'success' => true,
                'message' => 'User Logged in Successfully',
                'token' => $authUser->createToken("User Token")->plainTextToken,
                'token_type' => 'bearer',
                'data' => null,
                'status' => 200,
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Email or Password does not matched.',
                'data' => null,
                'status' => 401,
            ], 401);
        }
    }


    public function logout(Request $request)
    {
        try {
            // Get the authenticated user
            $user = Auth::user();

            // If user is not authenticated, return a response
            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid token or user already logged out',
                    'data' => null,
                    'status' => 401,
                ], 401);
            }

            // Revoke all tokens for the authenticated user
            $user->tokens()->delete();

            return response()->json([
                'success' => true,
                'message' => 'You logged out successfully',
                'data' => null,
                'status' => 200,
            ], 200);
        } catch (Exception $e) {
            // Handle unexpected errors
            return response()->json([
                'success' => false,
                'message' => 'An error occurred during logout',
                'data' => null,
                'status' => 500,
            ], 500);
        }
    }







    // //logout api
    // public function logout(Request $request)
    // {
    //     $user = $request->user();
    //     $user->tokens()->delete();

    //     return response()->json([
    //         'success' => true,
    //         'message' => 'You logged out successfully',
    //         'data' => null,
    //         'status' => 200,
    //     ], 200);
    // }




    // Update Password
    public function updatePassword(Request $request)
    {
        // Check if the Authorization header is present
        if (!$request->hasHeader('Authorization')) {
            return response()->json([
                'success' => false,
                'message' => 'Authorization token not provided',
                'data' => null,
                'status' => 401,
            ], 401);
        }

        // Validate the request
        $validateUser = Validator::make(
            $request->all(),
            [
                'current_password' => 'required|min:8',
                'new_password' => 'required|min:8|confirmed',
            ]
        );

        if ($validateUser->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation Error',
                'errors' => $validateUser->errors()->all(),
                'data' => null,
                'status' => 401,
            ], 401);
        }

        // Check if the current password matches the user's password
        $user = Auth::user();
        if (!Hash::check($request->current_password, $user->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Current password does not match',
                'data' => null,
                'status' => 401,
            ], 401);
        }

        // Update the password
        $user->update([
            'password' => Hash::make($request->new_password),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Password updated successfully',
            'data' => [
                'user_id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
            ],
            'status' => 200,
        ], 200);
    }
}
