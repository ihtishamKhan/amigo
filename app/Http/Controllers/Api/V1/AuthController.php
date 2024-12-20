<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Config;
use App\Models\User;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'phone' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
        ]);

        // Check if email verification is enabled in config
        // if (Config::get('auth.email_verification_enabled', true)) {
        //     event(new Registered($user));
            
        //     return response()->json([
        //         'status' => 'success',
        //         'message' => 'Registration successful. Please verify your email.',
        //         'user' => $user
        //     ], 201);
        // }

        // If email verification is disabled, automatically mark email as verified
        // $user->markEmailAsVerified();
        
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'status' => 'success',
            'message' => 'Registration successful',
            'user' => $user,
            'token' => $token
        ], 201);
    }

    /**
     * Login user and create token
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid credentials'
            ], 401);
        }

        $user = User::where('email', $request->email)->firstOrFail();

        // Check if email verification is required and email is not verified
        // if (Config::get('auth.email_verification_enabled', true) && !$user->hasVerifiedEmail()) {
        //     return response()->json([
        //         'status' => 'error',
        //         'message' => 'Please verify your email first'
        //     ], 403);
        // }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'status' => 'success',
            'message' => 'Login successful',
            'user' => $user,
            'token' => $token
        ]);
    }

    /**
     * Logout user (Revoke the token)
     */
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Successfully logged out'
        ]);
    }

    /**
     * Get the authenticated User
     */
    public function user(Request $request)
    {
        return response()->json($request->user());
    }

    /**
     * Resend verification email
     */
    public function resendVerification(Request $request)
    {
        if (!Config::get('auth.email_verification_enabled', true)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Email verification is disabled'
            ], 400);
        }

        $user = $request->user();

        if ($user->hasVerifiedEmail()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Email already verified'
            ], 400);
        }

        $user->sendEmailVerificationNotification();

        return response()->json([
            'status' => 'success',
            'message' => 'Verification link sent'
        ]);
    }

    /**
     * Prepare for social login integration
     * These methods will be implemented later
     */
    public function redirectToGoogle()
    {
        // Will be implemented when adding Google login
        return response()->json([
            'status' => 'error',
            'message' => 'Google login not implemented yet'
        ], 501);
    }

    public function handleGoogleCallback()
    {
        // Will be implemented when adding Google login
    }

    public function redirectToFacebook()
    {
        // Will be implemented when adding Facebook login
        return response()->json([
            'status' => 'error',
            'message' => 'Facebook login not implemented yet'
        ], 501);
    }

    public function handleFacebookCallback()
    {
        // Will be implemented when adding Facebook login
    }

    public function redirectToApple()
    {
        // Will be implemented when adding Apple login
        return response()->json([
            'status' => 'error',
            'message' => 'Apple login not implemented yet'
        ], 501);
    }

    public function handleAppleCallback()
    {
        // Will be implemented when adding Apple login
    }
}
