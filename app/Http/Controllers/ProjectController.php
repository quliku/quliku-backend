<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProjectResource;
use App\Models\Project;
use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProjectController extends Controller
{

    public function createProject(Request $request): JsonResponse
    {
        $rules = [
            'foreman_id' => 'required|integer|exists:users,id',
            'name' => 'required|string',
            'description' => 'sometimes|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'province' => 'required|string',
            'city' => 'required|string',
            'district' => 'required|string',
            'village' => 'required|string',
            'address' => 'required|string',
            'project_area' => 'required|numeric',
            'payment_type' => 'required|string',
            'wa_number' => 'required|string',
        ];

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()) return $this->validationError($validator->errors());

        try {
            $foreman = User::find($request->input('foreman_id'));
            $detail = $foreman->foremanDetail()->first();

            if ($request->user()->role != 'contractor') throw new Exception('You are not authorized to create project',1001);
            if ($detail->is_work) throw new Exception('Foreman is working in another project',1002);

            $project = Project::create($request->all() + [
                'contractor_id' => auth()->user()->getAuthIdentifier(),
                'status' => 'waiting',
            ]);

            return $this->successWithData((new ProjectResource($project)));
        } catch (Exception $e) {
            return $this->error($e);
        }
    }

}