<?php

namespace App\Http\Controllers;

use App\Http\Resources\ForemanImageResource;
use App\Http\Resources\ForemanResource;
use App\Http\Resources\UserResource;
use App\Models\ForemanDetail;
use App\Models\ForemanImage;
use App\Models\User;
use App\Shared\DBManager;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AuthForemanController extends Controller
{
    public function __construct(private DBManager $db_manager){ }

    public function register(Request $request): JsonResponse
    {
        $rules = [
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'role' => 'required|string|max:255',
            'profile_image' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:8192',
            'city' => 'required|string|max:255',
            'wa_number' => 'required|string|max:255',
            'classification' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'experience' => 'required|integer',
            'min_people' => 'required|integer',
            'max_people' => 'required|integer',
            'price' => 'required|numeric',
            'bank_type' => 'required|string|max:255',
            'account_name' => 'required|string|max:255',
            'account_number' => 'required|string|max:255',
            'ktp_image' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:8192',
            'certificate_image' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:8192',
            'portfolio_image' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:8192',
        ];

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()) return $this->validationError($validator->errors());

        $this->db_manager->begin();
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
                'role' => $request->input('role'),
                'profile_url' => $filename,
            ]);

            ForemanDetail::create([
                'user_id' => $user->id,
                'city' => $request->input('city'),
                'wa_number' => $request->input('wa_number'),
                'classification' => $request->input('classification'),
                'description' => $request->input('description'),
                'experience' => $request->input('experience'),
                'min_people' => $request->input('min_people'),
                'max_people' => $request->input('max_people'),
                'price' => $request->input('price'),
                'bank_type' => $request->input('bank_type'),
                'account_name' => $request->input('account_name'),
                'account_number' => $request->input('account_number'),
            ]);

            $images = ['ktp', 'certificate', 'portfolio'];

            foreach ($images as $image) {
                if ($request->hasFile($image.'_image')) {
                    $extension = $request->file($image.'_image')->getClientOriginalExtension();
                    $filename = $request->input('username'). '-' . time() . rand(1,1000) . '.' . $extension;

                    Storage::disk('public')->putFileAs('foreman_images', $request->file($image.'_image'), $filename);
                } else {
                    $filename = 'user-default.png';
                }

                ForemanImage::create([
                    'user_id' => $user->id,
                    'photo_url' => $filename,
                    'type' => $image,
                ]);
            }

            $this->db_manager->commit();
            return $this->successWithData(new UserResource($user));
        } catch (Exception $e) {
            $this->db_manager->rollBack();
            return $this->error($e);
        }
    }

    public function me(): JsonResponse
    {
        try {
            $user = Auth::user();
            $foreman = ForemanDetail::where('user_id', $user->getAuthIdentifier())->first();
            $images = ForemanImage::where('user_id', $user->getAuthIdentifier())->get();

            $response = new ForemanResource($foreman);
            $response->setUser((new UserResource($user))->toArray(request()));
            $response->setImages(ForemanImageResource::collection($images)->toArray(request()));

            return $this->successWithData($response);
        } catch (Exception $e) {
            return $this->error($e);
        }
    }

}
