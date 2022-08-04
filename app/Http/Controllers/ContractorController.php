<?php

namespace App\Http\Controllers;

use App\Http\Resources\ForemanResource;
use App\Http\Resources\UserResource;
use App\Models\User;
use Exception;
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
}
