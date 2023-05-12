<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTodoRequest;
use App\Http\Requests\UpdateTodoRequest;
use Illuminate\Support\Facades\Validator;
use App\Models\Todo;
use App\Models\User;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        return $user->todos->all();
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTodoRequest $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'due_date' => 'date',
        ]);
        $obj = $request->all();
        $obj['user_id'] = auth()->user()->id;
        return Todo::create($obj);
    }

    /**
     * Display the specified resource.
     */
    public function show(Todo $todo)
    {
        return $todo;
    }
    

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTodoRequest $request, Todo $todo)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'due_date' => 'date',
        ]);
        
        $todo->name = $request->name;
        $todo->description = $request->description;
        $todo->due_date = $request->due_date;
        $todo->completed_date = NULL;
        $todo->save();
        
        return $todo;
    }
    
    /**
     * Update the specified resource in storage.
     */
    public function completed(Todo $todo)
    {
        $todo->completed_date = now();
        $todo->save();
        
        return $todo;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Todo $todo)
    {
        //
        return $todo->delete();
    }
}
