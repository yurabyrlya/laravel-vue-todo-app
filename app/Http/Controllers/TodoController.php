<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function index()
    {
        // retrieve a list of todos from the database
        $todos = Todo::all();

        // return the list of todos as a JSON response
        return response()->json($todos);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        // validate the request data
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable',
        ]);

        // create a new Todo instance
        $todo = new Todo;
        $todo->title = $validatedData['title'];
        $todo->description = $validatedData['description'];

        // save the new todo to the database
        $todo->save();

        // return a JSON response with the new todo
        return response()->json($todo);
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(int $id)
    {
        // Find the todo item with the given ID
        $todo = Todo::find($id);

        // Update the todo item with the new data from the request
        $todo->update(request()->all());

        // Return a response indicating that the todo item was updated successfully
        return response()->json([
            'success' => true
        ]);
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(int $id)
    {
        // Find the todo item with the given ID
        $todo = Todo::find($id);

        // Delete the todo item
        $todo->delete();

        // Return a response indicating that the todo item was deleted successfully
        return response()->json([
            'success' => true
        ]);
    }



}
