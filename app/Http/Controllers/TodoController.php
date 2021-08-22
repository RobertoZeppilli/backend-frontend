<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Todo;
use App\Todolist;
use App\User;

use Illuminate\Support\Facades\Auth;

class TodoController extends Controller
{

    // public function index() {
    //     return Todo::where('user_id', Auth::id())->with('todolist')->get();
    // }

    public function store(Request $request, Todolist $todolist) {
        $newTodo = Todo::create([
            'title' => $request->title,
            'user_id' => Auth::id(),
            'todolist_id' => $todolist->id
        ]);
        
        return $newTodo;
    }

    public function destroy(Todo $todo) {
        $todo->delete();
    }
}
