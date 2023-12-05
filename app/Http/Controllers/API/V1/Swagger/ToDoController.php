<?php

namespace App\Http\Controllers\API\V1\Swagger;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\ToDoRequest;
use App\Models\ToDoList;
use App\Notifications\NoteCreated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;


/**
 * @OA\Post(
 *     path="/api/todo",
 *     summary="Создание заметок",
 *     tags={"ToDo"},
 *
 *     @OA\RequestBody(
 *           @OA\JsonContent(
 *              allOf={
 *                  @OA\Schema(
 *                      @OA\Property(property="case", type="string" , example="Название дела"),
 *                      @OA\Property(property="description", type="string" , example="Описание дела"),
 *                      @OA\Property(property="is_completed", type="integer" , example=2),
 *                      @OA\Property(property="users_id", type="integer" , example="2"),
 *                  )
 *              }
 *          )
 *     ),
 *
 *     @OA\Response(
 *          response=200,
 *          description="OK",
 *          @OA\JsonContent(
 *             @OA\Property(property="data", type="object",
 *                 @OA\Property(property="case", type="string" , example="Название дела"),
 *                 @OA\Property(property="description", type="string" , example="Описание дела"),
 *                 @OA\Property(property="is_completed", type="integer" , example=0),
 *                 @OA\Property(property="users_id", type="integer" , example="2"),
 *             ),
 *          ),
 *     ),
 * ),
 *
 *  * @OA\Get(
 *     path="/api/todo",
 *     summary="Получение списка заметок",
 *     tags={"ToDo"},
 *
 *
 *     @OA\Response(
 *          response=200,
 *          description="OK",
 *          @OA\JsonContent(
 *                 @OA\Property(property="id", type="integer" , example="2"),
 *                 @OA\Property(property="case", type="string" , example="Название дела"),
 *                 @OA\Property(property="description", type="string" , example="Описание дела"),
 *                 @OA\Property(property="is_completed", type="integer" , example=0),
 *                 @OA\Property(property="users_id", type="integer" , example="2"),
 *                 @OA\Property(property="created_at", type="datetime" , example="2023-12-04T14:41:17.000000Z"),
 *                 @OA\Property(property="updated_at", type="datetime" , example="2023-12-04T14:41:17.000000Z"),
 *          ),
 *     ),
 * ),
 *
 * * @OA\Get(
 *     path="/api/todo/{todo}",
 *     summary="Получение списка заметок по users_id",
 *     tags={"ToDo"},
 *     @OA\Parameter(
 *         description="id пользователя добавляющего заметку",
 *         in="path",
 *         name="users_id",
 *         required=true,
 *         example="1",
 *     ),
 *
 *
 *     @OA\Response(
 *          response=200,
 *          description="OK",
 *          @OA\JsonContent(
 *                 @OA\Property(property="id", type="integer" , example="2"),
 *                 @OA\Property(property="case", type="string" , example="Название дела"),
 *                 @OA\Property(property="description", type="string" , example="Описание дела"),
 *                 @OA\Property(property="is_completed", type="integer" , example=1),
 *                 @OA\Property(property="users_id", type="integer" , example="2"),
 *                 @OA\Property(property="created_at", type="datetime" , example="2023-12-04T14:41:17.000000Z"),
 *                 @OA\Property(property="updated_at", type="datetime" , example="2023-12-04T14:41:17.000000Z"),
 *          ),
 *     ),
 * ),
 *
 * * @OA\Patch(
 *     path="/api/todo/{todo}",
 *     summary="Обновление заметки",
 *     tags={"ToDo"},
 *     @OA\Parameter(
 *         description="id заметки",
 *         in="path",
 *         name="todo",
 *         required=true,
 *         example="35",
 *     ),
 *
 *      @OA\RequestBody(
 *           @OA\JsonContent(
 *              allOf={
 *                  @OA\Schema(
 *                      @OA\Property(property="case", type="string" , example="Название дела"),
 *                      @OA\Property(property="description", type="string" , example="Описание дела"),
 *                      @OA\Property(property="is_completed", type="integer" , example=1),
 *                      @OA\Property(property="users_id", type="integer" , example="2"),
 *                  )
 *              }
 *          )
 *     ),
 *
 *
 *     @OA\Response(
 *          response=200,
 *          description="OK",
 *          @OA\JsonContent(
 *                 @OA\Property(property="id", type="integer" , example="2"),
 *                 @OA\Property(property="case", type="string" , example="Название дела"),
 *                 @OA\Property(property="description", type="string" , example="Описание дела"),
 *                 @OA\Property(property="is_completed", type="integer" , example=2),
 *                 @OA\Property(property="users_id", type="integer" , example="2"),
 *                 @OA\Property(property="created_at", type="datetime" , example="2023-12-04T14:41:17.000000Z"),
 *                 @OA\Property(property="updated_at", type="datetime" , example="2023-12-04T14:41:17.000000Z"),
 *          ),
 *     ),
 * ),
 * @OA\Delete(
 *     path="/api/todo/{todo}",
 *     summary="Удаление заметки",
 *     tags={"ToDo"},
 *     @OA\Parameter(
 *         description="id заметки",
 *         in="path",
 *         name="todo",
 *         required=true,
 *         example="1",
 *     ),
 *
 *
 *     @OA\Response(
 *          response=200,
 *          description="OK",
 *          @OA\JsonContent(
 *                 @OA\Property(property="message", type="string" ,example="done"),
 *
 *          ),
 *     ),
 * ),
 *
 */
class ToDoController extends Controller
{


}
