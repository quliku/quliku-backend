<?php

namespace App\Http\Controllers;

use App\Http\Resources\ForemanImageResource;
use App\Http\Resources\ForemanDetailResource;
use App\Http\Resources\RatingResource;
use App\Http\Resources\UserResource;
use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContractorController extends Controller
{

    public function searchForeman(Request $request): JsonResponse
    {
        $rules = [
            'name' => 'required|string',
        ];

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()) return $this->validationError($validator->errors());

        try {
            $foremans = User::where('role', 'foreman')->where('name', 'like', '%' . $request->input('name') . '%')->get();
            $response = [];
            foreach ($foremans as $foreman) {
                $detail_raw = $foreman->foremanDetail()->first();
                if(!$detail_raw->is_work){
                    $detail = new ForemanDetailResource($detail_raw);
                    $rating = $foreman->foremanRatings()->avg('rating')?: 0;
                    $detail->setUser((new UserResource($foreman))->toArray($request));
                    $detail->setRating($rating);
                    $response[] = $detail->toArray($request);
                }
            }
            usort($response, function($a, $b) {
                return ($a['subscription'] < $b['subscription'])? -1 : 1;
            });
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
            $response = new UserResource($foreman);
            return $this->successWithData($response);
        } catch (Exception $e) {
            return $this->error($e);
        }
    }
}
