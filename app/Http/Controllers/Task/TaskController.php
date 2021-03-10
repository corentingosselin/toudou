<?php

namespace App\Http\Controllers\Task;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{

    

    public function delete($id)
    {
        $task = Task::findOrFail($id);
        if (!$task) {
            abort(403, " THIS ACTION IS UNAUTHORIZED.");
        }
        //$this->authorizeForUser(Auth::user(), 'delete', $task);
        $task->delete();
    }

    public function create(Request $request)
    {
        $request->validate([
            'description' => 'required|string|max:25',
            'project_id' => 'required|exists:App\Models\Project,id'
        ]);
        DB::table('tasks')->insert([
            'description' => $request->description,
            'done' => false,
            'project_id' => $request->project_id
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'done' => 'required|boolean',
            'task_id' => 'required|exists:App\Models\Task,id'
        ]);
        $task = Task::findOrFail($request->task_id);
        $task->done = $request->done;
        $task->save();
    }
}
