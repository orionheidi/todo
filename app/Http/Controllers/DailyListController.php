<?php

namespace App\Http\Controllers;

use App\Models\DailyList;
use App\Models\User;
use Illuminate\Http\Request;

class DailyListController extends Controller
{
    public function store(Request $request)
    {
        $fields = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'date' => 'required',
            'user_id' => 'required'
        ]);

        return DailyList::create([
            'title' => $fields['title'],
            'description' => $fields['description'],
            'date' => $fields['date'],
            'user_id' => $fields['user_id'],
        ]);
    }

    public function update(Request $request, $id)
    {
        $list = DailyList::find($id);
        $list->update($request->all());
        return $list;
    }

    public function destroy($id)
    {
        return DailyList::destroy($id);
    }
}
