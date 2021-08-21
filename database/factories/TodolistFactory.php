<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Todolist;
use Faker\Generator as Faker;

$factory->define(Todolist::class, function (Faker $faker) {
    return [
        'title' => 'Prima Todolist',
        'user_id' => 15,
    ];
});
