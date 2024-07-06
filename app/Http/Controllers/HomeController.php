<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use App\Models\Partners;
use App\Models\Project;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $project = Project::where('active', true)->paginate(4);

        $partners = Partners::where('active', true)->get();

        return view('home.index', compact('project', 'partners'));
    }

    public function contacts()
    {
        return view('home.contacts');
    }

    public function privacyPolicy()
    {
        return view('home.privacyPolicy');
    }

    public function adminPanel()
    {

        $news = News::query()->paginate(5);
        return view('home.adminPanel', compact('news'));
    }
    public function analyticAccidentAdminPanel()
    {
        return view('analytic.accident.adminPanel');
    }
    public function analyticObjectsAdminPanel()
    {
        return view('analytic.objects.adminPanel');
    }
     public function paginate(Request $request)
    {
        if ($request->ajax()) {
            return view('home.partials.projects', ['project' => $request->project])->render();

        }
        return redirect()->back();
    }

    public function verification()
    {
        return view('auth.verification');
    }
}
