<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;

class TasksController extends Controller
{
    public function store()
    {
        $this->validate(request(), [
            'name'        => 'required',
            'description' => 'required'
        ]);
        Task::create(request()->all());
        return response()->json(['message' => 'Tarea creada'],201);
    }

    public function show($id)
    {
        $task = Task::findOrFail($id);

        return response()->json($task,200);
    }
}
