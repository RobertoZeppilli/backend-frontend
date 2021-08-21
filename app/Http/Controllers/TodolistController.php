<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Todolist;
use Illuminate\Support\Facades\Auth;
use App\User;

class TodolistController extends Controller
{
    public function index() {

        $userTodolist = Todolist::where('user_id', Auth::id())->orderBy('id', 'DESC')->get();
        
        return response()->json($userTodolist);
    }

    public function store(Request $request) {

        $todolist = Todolist::create([
            'title' => $request->title,
            'user_id' => Auth::id()
        ]);

        return $todolist;
    }

    public function destroy(Todolist $todolist) {

        return $todolist->delete();
    }
}
