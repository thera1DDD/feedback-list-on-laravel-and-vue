<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Models\ToDoList;
use App\Notifications\NoteCreated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Notification;

class NotifyController extends Controller
{
    public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $todos = ToDoList::with('user')->get();

        return view('notes.index', compact('todos'));
    }

    public function sendNotification(Request $request): \Illuminate\Http\JsonResponse
    {
        // Отправка уведомления администратору
        Notification::route('mail', 'tagir566666@gmail.com')
            ->notify(new NoteCreated());

        return response()->json(['message' => 'Уведомление отправлено успешно.']);
    }
}
