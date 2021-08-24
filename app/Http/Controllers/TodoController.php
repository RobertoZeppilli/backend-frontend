<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Todo;
use App\Todolist;
use App\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TodoController extends Controller
{

    public function store(Request $request, Todolist $todolist)
    {
        $todo = $request->all();

        $validator = Validator::make($todo, [
            'title' => 'required'
        ]);
        
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ]);
        } else {
            $newTodo = Todo::create([
                'title' => $request->title,
                'user_id' => Auth::id(),
                'todolist_id' => $todolist->id
            ]);
        }


        return response()->json($newTodo);
    }

    public function destroy(Todo $todo)
    {
        $todo->delete();
    }
}
