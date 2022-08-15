<?php

namespace App\Http\Controllers;

use App\Http\Resources\PaymentResource;
use App\Http\Resources\ProjectResource;
use App\Http\Resources\RatingResource;
use App\Http\Resources\ReportResource;
use App\Models\Payment;
use App\Models\Project;
use App\Models\Rating;
use App\Models\Report;
use App\Models\ReportImage;
use App\Models\User;
use App\Shared\DBManager;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProjectController extends Controller
{
    public function __construct(private DBManager $db_manager){ }

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
            'total_price' => 'required|numeric',
            'document_url' => 'sometimes|string',
            'payment_type' => 'required|string',
            'wa_number' => 'required|string',
        ];

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()) return $this->validationError($validator->errors());

        try {
            $foreman = User::where([
                'id' => $request->input('foreman_id'),
                'role' => 'foreman'
            ])->with('foremanDetail')->first();

            if(!$foreman) throw new Exception('Foreman not found',1014);
            if ($request->user()->role != 'contractor') throw new Exception('You are not authorized to create project',1001);
            if ($foreman->foremanDetail->is_work) throw new Exception('Foreman is working in another project',1002);

            $project = Project::create($request->all() + [
                'contractor_id' => auth()->user()->getAuthIdentifier(),
                'already_paid' => 0,
                'status' => 'waiting',
            ]);

            return $this->successWithData((new ProjectResource($project)));
        } catch (Exception $e) {
            return $this->error($e);
        }
    }

    public function listProject(Request $request): JsonResponse
    {
        $rules = [
            'status' => 'sometimes|string',
        ];

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()) return $this->validationError($validator->errors());

        try {
            $user = request()->user();
            if(!in_array($user->role, ['contractor', 'foreman']))
                throw new Exception('You are not authorized to get list project',1006);

            $projects = Project::where($user->role.'_id', $user->getAuthIdentifier());
            if($request->has('status'))
                $projects = $projects->where('status', $request->query('status'));

            $projects = $projects->orderByDesc('created_at')
                ->with($user->role == 'contractor' ? 'foreman' : 'contractor')
                ->get();

            return $this->successWithData(ProjectResource::collection($projects));
        } catch (Exception $e) {
            return $this->error($e);
        }
    }

    public function detailProject(int $id): JsonResponse
    {
        try {
            $project = Project::where('id', $id)
                ->with([
                    'contractor',
                    'foreman',
                    'payments',
                    'reports',
                ])
                ->first();
            if (!$project) throw new Exception('Project not found',1003);
            return $this->successWithData((new ProjectResource($project)));
        } catch (Exception $e) {
            return $this->error($e);
        }
    }

    public function acceptProject(Request $request): JsonResponse
    {
        $rules = [
            'project_id' => 'required|integer|exists:projects,id',
            'fix_people' => 'required|numeric',
            'transportation_fee' => 'required|numeric',
        ];

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()) return $this->validationError($validator->errors());

        $this->db_manager->begin();
        try {
            $project = Project::where('id', $request->input('project_id'))
                ->with('foreman.foremanDetail')
                ->first();

            if ($project->foreman_id != auth()->user()->getAuthIdentifier())
                throw new Exception('You are not authorized to accept this project',1005);
            if ($project->status != 'waiting')
                throw new Exception('Project is not waiting',1006);
            if ($project->foreman->foremanDetail->is_work)
                throw new Exception('You can\'t accept project when working another project',1007);

            $project->status = 'not_paid';
            $project->fix_people = $request->input('fix_people');
            $project->transportation_fee = $request->input('transportation_fee');
            $project->save();

            $project->foreman->foremanDetail->is_work = true;
            $project->foreman->foremanDetail->save();

            $this->db_manager->commit();
            return $this->successWithData((new ProjectResource($project)));
        } catch (Exception $e) {
            $this->db_manager->rollback();
            return $this->error($e);
        }
    }

    public function rejectProject(Request $request): JsonResponse
    {
        $rules = [
            'project_id' => 'required|integer|exists:projects,id',
            'reason' => 'sometimes|string',
        ];

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()) return $this->validationError($validator->errors());

        try {
            $project = Project::where('id', $request->input('project_id'))->first();
            if ($project->foreman_id != auth()->user()->getAuthIdentifier())
                throw new Exception('You are not authorized to reject this project',1007);
            if ($project->status != 'waiting')
                throw new Exception('Project is not waiting',1008);
            $project->status = 'reject';
            $project->reject_reason = $request->input('reason');
            $project->save();
            return $this->successWithData((new ProjectResource($project)));
        } catch (Exception $e) {
            return $this->error($e);
        }
    }

    public function cancelProject(Request $request): JsonResponse
    {
        $rules = [
            'project_id' => 'required|integer|exists:projects,id',
        ];

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()) return $this->validationError($validator->errors());

        try {
            $project = Project::where('id', $request->input('project_id'))->first();

            if ($project->contractor_id != auth()->user()->getAuthIdentifier())
                throw new Exception('You are not authorized to cancel this project',1017);
            if ($project->status != 'waiting')
                throw new Exception('Project is not waiting',1018);

            $project->status = 'reject';
            $project->reject_reason = "Project canceled by contractor";
            $project->save();
            return $this->successWithData((new ProjectResource($project)));
        } catch (Exception $e) {
            return $this->error($e);
        }
    }

    public function paymentProject(Request $request): JsonResponse
    {
        $rules = [
            'project_id' => 'required|integer|exists:projects,id',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:4096',
            'amount' => 'required|numeric',
            'description' => 'sometimes|string',
        ];

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()) return $this->validationError($validator->errors());

        try {
            if (request()->user()->role != 'contractor')
                throw new Exception('You don\'t have a contractor role',1009);

            $project = Project::where('id', $request->input('project_id'))->first();
            if ($project->contractor_id != auth()->user()->getAuthIdentifier())
                throw new Exception('You are not authorized to payment this project',1010);

            $extension = $request->file('photo')->getClientOriginalExtension();
            $fileName = time() . rand(1,100) . '.' . $extension;

            Storage::disk('public')
                ->putFileAs(
                    'project/'. $request->input('project_id') .'/payment',
                    $request->file('photo'),
                    $fileName
                );

            $payment = Payment::create([
                'user_id' => auth()->user()->getAuthIdentifier(),
                'project_id' => $project->id,
                'photo_url' => $fileName,
                'amount' => $request->input('amount'),
                'description' => $request->input('description'),
                'status' => 'waiting',
            ]);

            return $this->successWithData((new PaymentResource($payment)));
        } catch (Exception $e) {
            return $this->error($e);
        }
    }

    public function reportProject(Request $request): JsonResponse
    {
        $rules = [
            'project_id' => 'required|integer|exists:projects,id',
            'percentage' => 'required|integer|between:0,100',
            'description' => 'sometimes|string',
            'photos' => 'required',
            'photos.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:4096',
        ];

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()) return $this->validationError($validator->errors());

        $this->db_manager->begin();

        try {
            if (request()->user()->role != 'foreman')
                throw new Exception('You don\'t have a foreman role',1015);

            $project = Project::where('id', $request->input('project_id'))->first();

            if ($project->foreman_id != auth()->user()->getAuthIdentifier())
                throw new Exception('You are not authorized to report this project',1016);

            if ($request->hasFile('photos')) {
                $report = Report::create([
                    'user_id' => auth()->user()->getAuthIdentifier(),
                    'project_id' => $project->id,
                    'percentage' => $request->input('percentage'),
                    'description' => $request->input('description'),
                ]);

                $photos = [];
                foreach ($request->file('photos') as $photo) {
                    $extension = $photo->getClientOriginalExtension();
                    $fileName = time() . rand(1,100) . '.' . $extension;
                    Storage::disk('public')
                        ->putFileAs(
                            'project/'. $request->input('project_id') .'/report',
                            $photo,
                            $fileName
                        );
                    $photos[] = [
                        'report_id' => $report->id,
                        'photo_url' => $fileName,
                    ];
                }
                ReportImage::insert($photos);
            }

            $this->db_manager->commit();
            return $this->successWithData((new ReportResource($report)));
        } catch (Exception $e) {
            $this->db_manager->rollback();
            return $this->error($e);
        }
    }

    public function completeProject(Request $request): JsonResponse
    {
        $rules = [
            'project_id' => 'required|integer|exists:projects,id',
        ];

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()) return $this->validationError($validator->errors());

        try {
            $project = Project::where('id', $request->input('project_id'))
                ->with([
                    'reports' => function($query) {
                        $query->orderByDesc('created_at')->first();
                    }
                ])
                ->first();

            if ($project->contractor_id != auth()->user()->getAuthIdentifier())
                throw new Exception('You are not authorized to complete this project',1019);
            if ($project->status != 'ongoing')
                throw new Exception('Only ongoing projects can be completed',1020);
            if ($project->reports->count() == 0 || $project->reports[0]->percentage != 100)
                throw new Exception('Project percentage must be 100% to finish project',1021);

            $project->status = 'done';
            $project->save();

            return $this->success();
        } catch (Exception $e) {
            return $this->error($e);
        }
    }

    public function reviewProject(Request $request): JsonResponse
    {
        $rules = [
            'project_id' => 'required|integer|exists:projects,id',
            'rating' => 'required|integer|between:1,5',
            'description' => 'sometimes|string',
        ];

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()) return $this->validationError($validator->errors());

        $this->db_manager->begin();
        try {
            $project = Project::where('id', $request->input('project_id'))->first();

            if ($project->contractor_id != auth()->user()->getAuthIdentifier())
                throw new Exception('You are not authorized to review this project',1022);
            if ($project->status != 'done')
                throw new Exception('Only done projects can be reviewed',1023);

            $review = Rating::create([
                'contractor_id' => $project->contractor_id,
                'foreman_id' => $project->foreman_id,
                'project_id' => $project->id,
                'rating' => $request->input('rating'),
                'description' => $request->input('description'),
            ]);

            $project->status = 'review';
            $project->save();

            $this->db_manager->commit();
            return $this->success();
        } catch (Exception $e) {
            $this->db_manager->rollback();
            return $this->error($e);
        }
    }
}
