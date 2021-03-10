<?php

namespace App\Http\Controllers\Project;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Share;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;

class ProjectController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $user = auth()->user();

        $projects = Project::orderBy('created_at', 'asc')
            ->where('user_id', '=', $user->id)
            ->get();

        $invitations = Share::orderBy('created_at', 'asc')
            ->where('user_id', '=', $user->id)
            ->get();


        $accepted = $invitations->filter(function ($inv) {
            return $inv->accepted;
        })->values();

        $invitations = $invitations->filter(function ($inv) {
            return !$inv->accepted;
        })->values();


        $final = collect();
        foreach ($accepted as $inv) {
            $final->add($inv->project);
        }

        $result = $final->merge($projects);

        return view('pages.projects', [
            'projects' => $result,
            'invitations' => $invitations
        ]);
    }


    public function store(Request $request)
    {
        switch ($request->input('action')) {
            case 'create':
                $request->validate([
                    'title' => 'required|string|max:25',
                ]);
                DB::table('projects')->insert([
                    'title' => $request->title,
                    'user_id' => Auth::user()->id
                ]);
                break;
        }
        return Redirect::back();
    }

    public function show($id)
    {
        // make not found or unauthorized throw 403
        // to pre
        $project = Project::find($id);
        if (!$project) {
            abort(403, " THIS ACTION IS UNAUTHORIZED.");
        }
        
        $this->authorizeForUser(Auth::user(), 'view', $project);


        $tasks = Task::orderBy('created_at', 'asc')
            ->where('project_id', '=', $id)
            ->where('done', '=', false)
            ->get();

        $finished_tasks = Task::orderBy('created_at', 'asc')
            ->where('project_id', '=', $id)
            ->where('done', '=', true)
            ->get();

        return view('pages.project', [
            'project' => $project,
            'tasks' => $tasks,
            'finished_tasks' => $finished_tasks
        ]);
    }

    public function delete($id)
    {
        $project = Project::find($id);
        if (!$project) {
            abort(403, " THIS ACTION IS UNAUTHORIZED.");
        }
        $this->authorizeForUser(Auth::user(), 'delete', $project);
        DB::table('tasks')->where('project_id', '=', $project->id)->delete();
        DB::table('shares')->where('project_id', '=', $project->id)->delete();
        $project->delete();
        return redirect(Route('projects'));
    }


    public function share(Request $request)
    {
        $id = $request->id;
        $share = Share::findOrFail($request->invitation_id);
        if ($request->input('action') == "accept") {
            $share->accepted = true;
            $share->save();
        } else if ($request->input('action') == "decline") {
            $share->delete();
        }
        return redirect(Route('projects'));

        //return Redirect::back();
    }
}
