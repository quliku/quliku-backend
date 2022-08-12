<?php

namespace App\Http\Controllers;

use App\Http\Resources\ForemanImageResource;
use App\Http\Resources\ForemanDetailResource;
use App\Http\Resources\ForemanResource;
use App\Http\Resources\RatingResource;
use App\Http\Resources\SimpleForemanResource;
use App\Http\Resources\UserResource;
use App\Models\ForemanDetail;
use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

    public function recommendationForeman(Request $request): JsonResponse
    {
        try {
            $foremans = DB::table('foreman_details')
                ->join('users', 'foreman_details.user_id', '=', 'users.id')
                ->leftJoinSub(DB::table('ratings')
                    ->selectRaw('foreman_id, TRUNCATE(AVG(rating),2) as rating')
                    ->groupBy('foreman_id'), 'ar', 'ar.foreman_id', '=', 'users.id')
                ->where('foreman_details.is_work', '=', false)
                ->orderBy('foreman_details.subscription_type', 'desc')
                ->orderBy('ar.rating', 'desc')
                ->select('users.id', 'users.name', 'users.username', 'users.email', 'users.role',
                    'users.profile_url', 'ar.rating', 'foreman_details.subscription_type', 'foreman_details.is_work',
                    'foreman_details.city', 'foreman_details.wa_number', 'foreman_details.classification',
                    'foreman_details.description', 'foreman_details.experience', 'foreman_details.min_people',
                    'foreman_details.max_people', 'foreman_details.price')
                ->limit(20)
                ->get();

            $response = SimpleForemanResource::collection($foremans);
            return $this->successWithData($response);
        } catch (Exception $e) {
            return $this->error($e);
        }
    }
}
