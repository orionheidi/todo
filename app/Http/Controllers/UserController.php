<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserCollection;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        return new UserCollection(User::all());
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
