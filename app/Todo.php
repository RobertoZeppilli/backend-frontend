<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    protected $fillable = ['title', 'todolist_id', 'user_id'];

    public function todolist() {
        return $this->belongsTo('App\Todolist');
    }

    public function user() {
        return $this->belongsTo('App\User');
    }
}
