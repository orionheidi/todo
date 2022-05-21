<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserCollection;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class UserController extends Controller
{
    public function index()
    {
        return new UserCollection(User::all());
    }

    public function sendUserEmailNotification(Request $request, $listId)
    {
        $user = $request->user();

        $tasks[] = Task::where('daily_list_id', $listId)->where('updated_at',  '>=',  Carbon::today()->toDateString())->
            where('done',  true)->get();

        return response()->json([
            'message' => 'Tasks done today.',
            'filtered tasks' => $tasks,
        ]);
    }
}
