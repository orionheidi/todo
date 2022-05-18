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

    public function usersFilterLists(Request $request)
    {
        $userQuery = User::with('dailyLists');

        if($request->title){
            $userQuery->with('dailyLists', function($query) use ($request){
                $query->where('title', 'LIKE', '%' . $request->title . '%');
            });
        }

        if($request->date){
            $userQuery->with('dailyLists', function($query) use ($request){
                $query->where('date', $request->date);
            });
        }

        $users = User::with('dailyLists')->paginate($request->get('per_page', 10));
        return response()->json([
            'message' => 'Blog successfully fetched',
            'data' =>$users
        ]);

    }

}
