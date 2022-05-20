<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserCollection;
use App\Models\DailyList;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function store(Request $request)
    {
        $fields = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'deadline' => 'required',
            'done' => 'required',
            'daily_list_id' => 'required',
        ]);

        $taskCreated = Task::create([
            'title' => $fields['title'],
            'description' => $fields['description'],
            'deadline' => $fields['deadline'],
            'done' => $fields['done'],
            'daily_list_id' => $fields['daily_list_id']
        ]);

        return response()->json([
            'message' => 'Task successfully created.',
            'data' => $taskCreated
        ]);
    }

    public function update(Request $request, $id)
    {
        $list = Task::find($id);

        $list->update($request->all());

        return response()->json([
            'message' => 'Task successfully updated.',
            'data' => $list
        ]);
    }

    public function destroy($id)
    {
        return response()->json([
            'message' => 'Task successfully deleted.',
            'data' => Task::destroy($id)
        ]);
    }

    public function listFilterTasks(Request $request)
    {
        $list = DailyList::findOrFail($request->query()['daily_list_id']);

        $filterListDailyTasks = $list->tasks();


        if (isset($request->query()['done'])) {
            $filterListDailyTasks->where('done', (bool)$request->query()['done']);
        }

        if (isset($request->query()['deadline'])) {
            $filterListDailyTasks->where('deadline', $request->query()['deadline']);
        }

        $tasks = $filterListDailyTasks->get();

        return response()->json([
            'message' => 'Tasks successfully fetched',
            'data' => $tasks
        ]);
    }

    public function updateTimeZone(Request $request, $id)
    {

        $user = User::find($id);

        $user->timezone = $request->get('timezone');
        $user->save();

        $usersDailyList = $user->dailyLists();

        $tasks = [];
        foreach ($usersDailyList as $list) {
            $tasks[] = $list->tasks();
        }

        $taskUpdateDateTime = [];
       foreach ($tasks as $task) {
           //$task->deadline = $date_timezone_set;
           $taskUpdateDateTime[] = $task->save();
       }

        return response()->json([
            'message' => 'User Timezone updated successfully.',
            'data' => $taskUpdateDateTime
        ]);
    }
}
