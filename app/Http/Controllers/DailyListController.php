<?php

namespace App\Http\Controllers;

use App\Models\DailyList;
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

    public function userFilterLists(Request $request)
    {
        $user = $request->user();

        $filterUserDailyLists = $user->dailyLists();

        if (isset($request->query()['title']) && $request->query()['title']) {
            $filterUserDailyLists->where('title', 'LIKE', '%' . $request->query()['title'] . '%');
        }

        if (isset($request->query()['date']) && $request->query()['date']) {
            $filterUserDailyLists->where('date', $request->query()['date']);
        }

        $dailyLists = $filterUserDailyLists->paginate($request->get('per_page', 10));

        return response()->json([
            'message' => 'Lists successfully fetched',
            'data' => $dailyLists
        ]);
    }
}
