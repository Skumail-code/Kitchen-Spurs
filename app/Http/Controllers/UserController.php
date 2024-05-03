<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; 

class UserController extends Controller
{
    public function index(){
        $users = User::all();
        return response()->json(['users' => $users], 200);
    }

    public function userTasks($userId) {
        $user = User::findOrFail($userId);
        $tasks = $user->tasks()->get();

        return response()->json(['tasks' => $tasks]);
    }

}
