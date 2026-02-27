<?php

namespace App\Http\Controllers;

use App\Models\User;

class userController extends Controller
{
    public function getAllUsers()
    {
        $users = User::all();

        return response()->json($users,200);
    }

    public function getOneUser(int $id)
    {
        $user = User::findOrFail($id);

        return response()->json($user,200);
    }


  public function getProfile(int $id)
    {
      
    $profile = User::findOrFail($id)->profile ;


        return response()->json($profile,200);
    }

    public function getUserTasks(int $id)
    {
      
    $tasks = User::findOrFail($id)->tasks;

       

        return response()->json($tasks ,200);
    }
}
