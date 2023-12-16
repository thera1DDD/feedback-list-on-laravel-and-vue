<?php

namespace App\Service\API;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use App\Models\ToDoList;
use App\Notifications\NoteCreated;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class FeedbackService extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @param array $data
     * @return Feedback
     */
    public function store(array $data): Feedback {
        return Feedback::firstOrCreate($data);
    }

    public function update($data,$id){
        $feedback = Feedback::find($id);
        $notification = new NoteCreated($data);
        //отправка уведомления на почту
        Notification::route('mail',$data['email'])->notify($notification);
        $feedback->update($data);

    }
}
