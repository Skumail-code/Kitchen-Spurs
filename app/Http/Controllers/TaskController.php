<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task; 
use App\Models\User;
use App\Models\TaskUser;
use Illuminate\Support\Facades\Auth;



class TaskController extends Controller
{
    public function add(Request $request) {
        $items=new Task();
        $items->title=$request->title;
        $items->description=$request->description;
        $items->status=$request->status;
        $items->due_date=$request->due_date;

        $items->save();

      
        return response()->json('Task Added successfully', 200);
    }

    public function get_tasks(Request $request) {
       
        $items = Task::all();
        return response()->json(['items' => $items], 200);
    }

    public function getTasksByStatus(Request $request)
    {
      
            // Validate the incoming request data
            $request->validate([
                'status' => 'required', // Status parameter is mandatory
            ]);
    
            // Retrieve the status from the request
            $status = $request->input('status');
    
            // Retrieve tasks with the specified status
            $tasks = Task::where('status', $status)->get();
    
            // Return the list of tasks with the specified status
            return response()->json($tasks);
        
    }

    public function getTasksByDate(Request $request)
    {
        try {
            // Validate the incoming request data
            $request->validate([
                'date' => 'required|date', // Date parameter is mandatory and must be a valid date
            ]);

            // Retrieve the date from the request
            $date = $request->input('date');

            // Retrieve tasks with the specified date
            $tasks = Task::whereDate('created_at', $date)->get();

            // Return the list of tasks with the specified date
            return response()->json($tasks);
        } catch (\Throwable $th) {
            // Return an error response if an exception occurs
            return response()->json(['message' => 'Failed to retrieve tasks by date', 'error' => $th->getMessage()], 500);
        }
    }
    

    
    public function assignUsersToTask(Request $request, $taskId) {
        $task = Task::findOrFail($taskId);
        $userIds = $request->input('user_ids');
        $task->users()->sync($userIds);

        return response()->json(['message' => 'Users assigned successfully']);
    }

    public function unassignUserFromTask($taskId, $userId)
    {
        try {
            // Find the task by ID
            $task = Task::findOrFail($taskId);

            // Detach the user from the task
            $task->users()->detach($userId);

            return response()->json(['message' => 'User unassigned successfully']);
        } catch (\Throwable $th) {
            // Return an error response if an exception occurs
            return response()->json(['message' => 'Failed to unassign user from task', 'error' => $th->getMessage()], 500);
        }
    }

    public function changeTaskStatus(Request $request, $taskId){
        $task = Task::findOrFail($taskId);
         $task->update(['status' => $request->input('status')]);

        return response()->json(['message' => 'Task status updated successfully']);
    }

    public function updateTask(Request $request, $taskId)
    {
        try {
            // Find the task by ID
            $task = Task::findOrFail($taskId);

            // Validate the incoming request data
            $request->validate([
                'title' => 'string',
                'description' => 'string',
                'status' => 'string',
                // Add more validation rules as needed
            ]);

            // Update task attributes
            $task->fill($request->all());
            $task->save();

            // Return a success response
            return response()->json(['message' => 'Task updated successfully', 'task' => $task]);
        } catch (\Throwable $th) {
            // Return an error response if an exception occurs
            return response()->json(['message' => 'Failed to update task', 'error' => $th->getMessage()], 500);
        }
    }

    public function deleteTask($taskId)
{
    try {
        // Find the task by ID
        $task = Task::findOrFail($taskId);

        // Delete the task
        $task->delete();

        // Return a success response
        return response()->json(['message' => 'Task deleted successfully']);
    } catch (\Throwable $th) {
        // Return an error response if an exception occurs
        return response()->json(['message' => 'Failed to delete task', 'error' => $th->getMessage()], 500);
    }
}


    public function getTasksByAssignedUser(Request $request)
    {
        try {
            // Validate the incoming request data
            $request->validate([
                'user_id' => 'required|integer', // user_id parameter is mandatory and must be an integer
            ]);

            // Retrieve the user_id from the request
            $userId = $request->input('user_id');

            // Retrieve task ids assigned to the specified user from the task_user table
            $taskIds = TaskUser::where('user_id', $userId)->pluck('task_id');

            // Retrieve tasks with the specified task ids
            $tasks = Task::whereIn('id', $taskIds)->get();

            // Return the list of tasks assigned to the specified user
            return response()->json($tasks);
        } catch (\Throwable $th) {
            // Return an error response if an exception occurs
            return response()->json(['message' => 'Failed to retrieve tasks by assigned user', 'error' => $th->getMessage()], 500);
        }
    }

    public function getLoggedinUserTask()
    {
        // Debugging: Check if the user is authenticated
        if (!Auth::check()) {
            return response()->json(['error' => 'User is not authenticated'], 401);
        }
    
        try {
            // Retrieve the currently authenticated user
            $user = Auth::user();
    
            // Debugging: Check if the user object is null
            if (!$user) {
                return response()->json(['error' => 'Authenticated user is null'], 500);
            }
    
            // Continue with your code to retrieve tasks assigned to the user...
        } catch (\Throwable $th) {
            // Handle other exceptions
            return response()->json(['message' => 'Failed to retrieve tasks by assigned user', 'error' => $th->getMessage()], 500);
        }
    }
    


}