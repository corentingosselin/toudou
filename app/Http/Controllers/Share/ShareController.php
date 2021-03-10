<?php

namespace App\Http\Controllers\Share;

use App\Http\Controllers\Controller;
use App\Mail\Invitation;
use App\Models\Project;
use App\Models\Share;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;

class ShareController extends Controller
{
    /**
     * Display the share view.
     *
     * @return \Illuminate\View\View
     */
    public function index($project_id)
    {
        $shared = Share::orderBy('created_at', 'asc')
            ->where('project_id', '=', $project_id)
            ->get();
        $project = Project::findOrFail($project_id);
        $this->authorizeForUser(Auth::user(), 'view', $project);
        return view('pages.share', [
            'shared' => $shared,
            'title' => $project->title
        ]);
    }


    public function share(Request $request)
    {

        $request->validate([
            'username' => 'required|string|exists:App\Models\User,username',
            'project_id' => 'required|exists:App\Models\Project,id'
        ]);

        $user_id = User::select('id')->where('username', $request->username)->first()->id;
        $user = User::find($user_id);
        DB::table('shares')->insert([
            'project_id' => $request->project_id,
            'accepted' => false,
            'edit' => true,
            'user_id' => $user_id
        ]);

        $project = Project::select('title')->where('id', $request->project_id)->first()->title;
        $this->authorizeForUser(Auth::user(), 'view', $project);
        $invitation = [
            'project' => $project,
            'author' => Auth::user()->username
        ];
               
    
        Mail::to($user->email)
            ->send(new Invitation($invitation));

        return Redirect::back();
    }

    public function autocomplete(Request $request)
    {
        if ($request->has('term')) {
            $user = Auth::user();
            $data = User::select("username")
                ->where("username", "LIKE", "%{$request->input('term')}%")
                ->where('id', '!=', $user->id)
                ->get();
            return response()->json($data);
        }
    }


    public function delete($id)
    {
        $share = Share::findOrFail($id);
        if (!$share) {
            abort(403, " THIS ACTION IS UNAUTHORIZED.");
        }
        //$this->authorizeForUser(Auth::user(), 'delete', $task);
        $share->delete();
    }


    public function update(Request $request)
    {
        $request->validate([
            'edit' => 'boolean',
            'accepted' => 'boolean',
            'share_id' => 'required|exists:App\Models\Share,id'
        ]);
        $share = Share::findOrFail($request->share_id);
        if ($request->has('accepted')) {
            $share->accepted = $request->accepted;
        }
        if ($request->has('edit')) {
            $share->edit = $request->edit;
        }
        $share->save();
    }
}
