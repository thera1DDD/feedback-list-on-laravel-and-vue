<?php

namespace App\Http\Controllers\API\V1\Feedback;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Feedback\Admin\FeedbackAnswerRequest;
use App\Http\Requests\API\Feedback\User\FeedbackRequest;
use App\Http\Resources\Feedback\FeedbackResourceAdmin;
use App\Models\Feedback;
use App\Models\ToDoList;
use App\Models\User;
use App\Service\API\FeedbackService;
use Carbon\Carbon;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class FeedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    protected FeedbackService $feedbackService;

    public function __construct(FeedbackService $feedbackService)
    {
        $this->feedbackService = $feedbackService;
    }

    public function postFeedback(FeedbackRequest $request): JsonResponse
    {
        $data = $request->validated();
        $this->feedbackService->store($data);
        return response()->json(['data'=>$data]);

    }

    public function getFeedback(): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        $feedback = Feedback::all();
        return FeedbackResourceAdmin::collection($feedback);
    }

    public function answerFeedback(FeedbackAnswerRequest $request,int $id){
        $data = $request->validated();
        $this->feedbackService->update($data,$id);
        return response()->json(['data'=>$data]);
    }

    public function filter(Request $request): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        $query = Feedback::query();
        // Фильтр по статусу
        if($request->status !=''){
            $query->where('status', $request->status ?? '');
        }
        //Фильтр по диапазону дат
        if ($request->start_date != '')
        {
            $query->whereBetween('created_at',[$request->start_date ?? '', $request->end_date]);
        }
        $filteredFeedback = $query->get();

        return FeedbackResourceAdmin::collection($filteredFeedback);
    }
}
