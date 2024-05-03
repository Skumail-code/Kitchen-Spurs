<?php

namespace App\Http\Controllers;
use App\Models\TaskUser; 
use Illuminate\Http\Request;

class TaskUserController extends Controller
{
    public function getAllTaskUser()
    {
        $taskUsers = TaskUser::all();

        return response()->json($taskUsers);
    }

   // Function to store a new task user relation
   public function store(Request $request)
   {
       try {
           // Create a new TaskUser model instance
           $taskUser = new TaskUser();
           $taskUser->user_id = $request->input('user_id');
           $taskUser->task_id = $request->input('task_id');
           
           // Save the new task user relation
           $taskUser->save();
   
           // Return a success response
           return response()->json(['message' => 'Task User relation created successfully'], 201);
       } catch (\Exception $e) {
           // Return an error response if something went wrong
           return response()->json(['message' => 'Failed to create task user relation', 'error' => $e->getMessage()], 500);
       }
   }
   public function deleteTaskUser($taskUserId)
    {
        try {
            // Find the task user relation by ID
            $taskUser = TaskUser::findOrFail($taskUserId);

            // Delete the task user relation
            $taskUser->delete();

            // Return a success response
            return response()->json(['message' => 'Task User relation deleted successfully']);
        } catch (\Throwable $th) {
            // Return an error response if an exception occurs
            return response()->json(['message' => 'Failed to delete task user relation', 'error' => $th->getMessage()], 500);
        }
    }

    
   }
