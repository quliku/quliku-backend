<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AuthContractorController extends Controller
{

    public function me(): JsonResponse
    {
        try {
            $user = new UserResource(Auth::user());
            return $this->successWithData($user);
        } catch (Exception $e) {
            return $this->error($e);
        }
    }

    public function register(Request $request): JsonResponse
    {
        $rules = [
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'profile_image' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:8192',
        ];

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()) return $this->validationError($validator->errors());

        try {
            if ($request->hasFile('profile_image')) {
                $extension = $request->file('profile_image')->getClientOriginalExtension();
                $filename = $request->input('username') . '.' . $extension;

                Storage::disk('public')->putFileAs('profile_images', $request->file('profile_image'), $filename);
            } else {
                $filename = 'user-default.png';
            }

            $user = User::create([
                'name' => $request->input('name'),
                'username' => $request->input('username'),
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password')),
                'role' => 'contractor',
                'profile_url' => $filename,
            ]);

            return $this->successWithData(new UserResource($user));
        } catch (Exception $e) {
            return $this->error($e);
        }
    }

    public function login(Request $request): JsonResponse
    {
        $rules = [
            'email' => 'required|string|max:255',
            'password' => 'required|string|min:6',
        ];

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()) return $this->validationError($validator->errors());

        $email = $request->input('email');
        $password = $request->input('password');

        try {
            $login_type = filter_var($request->input('email'), FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

            if (Auth::attempt([$login_type => $email, 'password' => $password])) {
                $user = new UserResource(Auth::user());
                $token = $user->createToken($user['role'].'-auth')->plainTextToken;
                $user->setToken($token);
                return $this->successWithData($user);
            }
            throw new Exception('Invalid credentials', 1000);

        } catch (Exception $e) {
            return $this->error($e);
        }
    }

    public function logout(): JsonResponse
    {
        try {
            Auth::user()->currentAccessToken()->delete();
            return $this->success();
        } catch (Exception $e) {
            return $this->error($e);
        }
    }

    public function unauthenticated(): JsonResponse
    {
        return $this->customResponse([
            'status' => 401,
            'response' => [
                'status' => false,
                'message' => 'Unauthenticated'
            ]
        ]);
    }

}
