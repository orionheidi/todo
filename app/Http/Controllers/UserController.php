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

    public function getUsersWithLists()
    {

//        $Products = Users::with('groups')->get();
//        return $Products ;
        return User::find(73)->dailyLists()->sortBy('title', 'asc')->get();

    }

//    public function indexFiltering(Request $request)
//    {
//        $filter = $request->query('filter');
//
//        if (!empty($filter)) {
//            $products = User::sortable()
//                ->where('users.name', 'like', '%'.$filter.'%')
//                ->paginate(5);
//        } else {
//            $products = User::sortable()
//                ->paginate(5);
//        }
//
//        return $products;
//    }
}
