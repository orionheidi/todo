<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserCollection;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        return new UserCollection(User::all());
    }
}
