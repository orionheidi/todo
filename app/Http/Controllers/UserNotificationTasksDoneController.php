<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Notifications\UserNotificationTasksDone;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserNotificationTasksDoneController extends Controller
{
    public function taskDoneToday(Request $request, $listId)
    {
        $tasks = Task::where('daily_list_id', $listId)->where('updated_at',  '>=',  Carbon::today()->toDateString())->
        where('done',  true)->get();

        return $tasks;
    }

    public function sendUserNotification (Request $request, $listId){

        $user = Auth::user();

        $tasksDone = $this->taskDoneToday($request, $listId);

        foreach ($tasksDone as $task) {
            $taskInfo[] = 'Task title: ' . $task->title . ', task Id: ' .$task->id .' date: ' . $task->updated_at->setTimezone($user['timezone'])->format('Y-m-d H:i:s') . '.';
        }


        $userData = [
            'body' => 'This are your finished task for today. ' . implode(" ",$taskInfo),
            'userText' => 'User name: ' . $user['name'] . ' User email: ' . $user['email'],
            'url' => url('/'),
            'thankYou' => 'Thank you ' . $user['name']
        ];

        $user->notify(new UserNotificationTasksDone($userData));

        return response()->json([
            'message' => 'Send Email Notification.',
            'notification' => $userData,
        ]);
    }
}
