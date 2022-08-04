<?php

namespace App\Http\Controllers;

use App\Http\Resources\ForemanImageResource;
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
                $detail = new ForemanResource($foreman->foremanDetail()->first());
                $rating = $foreman->foremanRatings()->avg('rating')?: 0;
                $detail->setUser((new UserResource($foreman))->toArray($request));
                $detail->setRating($rating);
                $response[] = $detail->toArray($request);
            }
            return $this->successWithData($response);
        } catch (Exception $e) {
            return $this->error($e);
        }
    }

    public function detailForeman(Request $request): JsonResponse
    {
        $rules = [
            'foreman_id' => 'required|integer',
        ];

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()) return $this->validationError($validator->errors());

        try {
            $foreman = User::find($request->input('foreman_id'));
            $detail = new ForemanResource($foreman->foremanDetail()->first());
            $comments = RatingResource::collection($foreman->foremanRatings()->get())->toArray($request);
            $rating = $foreman->foremanRatings()->avg('rating')?: 0;
            $images = ForemanImageResource::collection($foreman->foremanImages()->get())->toArray($request);
            $detail->setUser((new UserResource($foreman))->toArray($request));
            $detail->setImages($images);
            $detail->setRating($rating);
            $detail->setComment($comments);
            return $this->successWithData($detail->toArray($request));
        } catch (Exception $e) {
            return $this->error($e);
        }
    }
}
