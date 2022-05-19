<?php

namespace App\Http\Controllers;

use App\Models\DailyList;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function store(Request $request)
    {
        $fields = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'deadline' => 'required',
            'done' => 'required',
            'daily_list_id' => 'required'
        ]);

        return Task::create([
            'title' => $fields['title'],
            'description' => $fields['description'],
            'deadline' => $fields['deadline'],
            'date' => $fields['date'],
            'daily_list_id' => $fields['daily_list_id'],
        ]);
    }

    public function update(Request $request, $id)
    {
        $list = Task::find($id);
        $list->update($request->all());
        return $list;
    }

    public function destroy($id)
    {
        return Task::destroy($id);
    }
}
