<?php

namespace App\Http\Controllers;

use App\Http\Resources\ForemanImageResource;
use App\Http\Resources\ForemanDetailResource;
use App\Http\Resources\ForemanResource;
use App\Http\Resources\RatingResource;
use App\Http\Resources\UserResource;
use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContractorController extends Controller
{

    public function searchForeman(Request $request)
    {
        $rules = [
            'name' => 'required|string',
        ];

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()) return $this->validationError($validator->errors());

        try {
            $foremans = User::where([
                ['role', 'foreman'],
                ['name', 'like', '%' . $request->query('name') . '%'],
            ])->with([
                'foremanDetail',
                'foremanRatings',
            ])->get()->sortBy(function($foreman) {
                return $foreman->foremanDetail->subscription_type;
            })->filter(function($foreman) {
                return $foreman->foremanDetail->is_work == false;
            });
            $response = ForemanResource::collection($foremans);
            return $this->successWithData($response);
        } catch (Exception $e) {
            return $this->error($e);
        }
    }

    public function detailForeman(int $id): JsonResponse
    {
        try {
            $foreman = User::where([
                'role' => 'foreman',
                'id' => $id,
            ])->with([
                'foremanDetail',
                'foremanImages',
                'foremanRatings' => function($query) {
                    $query->with('contractor')->orderBy('created_at', 'desc');
                },
            ])->first();
            if(!$foreman) throw new Exception('Foreman not found', 1004);
            $response = new ForemanResource($foreman);
            return $this->successWithData($response);
        } catch (Exception $e) {
            return $this->error($e);
        }
    }
}
