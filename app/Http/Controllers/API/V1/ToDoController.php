<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\ToDoRequest;
use App\Models\ToDoList;
use App\Notifications\NoteCreated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class ToDoController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    protected $todo;

    public function __construct(){
        $this->todo = new ToDoList();

    }

    public function index(): \Illuminate\Database\Eloquent\Collection
    {
        return $this->todo->all();
    }

    public function store(ToDoRequest $request): \Illuminate\Http\JsonResponse
    {
        $data = $request->validated();
        $notification = new NoteCreated($data);
        Notification::route('mail',env('MAIL_TO'))->notify($notification);
        ToDoList::create($data);
        return response()->json(['data'=>$data]);
    }

    public function show(string $id)
    {
       return $this->todo->where('users_id',$id)->get();
    }

    public function update(Request $request, string $id)
    {
        $todo = $this->todo->find($id);
        $todo->update($request->all());
        return $todo;
    }

    public function destroy(string $id)
    {
        $todo = $this->todo->find($id);
        $todo->delete();
        return response()->json(['message'=>'done']);
    }
}
