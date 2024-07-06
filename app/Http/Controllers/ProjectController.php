<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{

    public function index()
    {
        $project = Project::where('active', true)->get();
        return view('home.index', compact('project'));
    }

    public function adminPanel()
    {
        $news = Project::query()->paginate(5);
        return view('project.adminPanel', compact('news'));
    }

    public function create()
    {
        return view('project.create');
    }


    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required|max:255',
            'intro' => 'required|max:300',
            'img' => 'required|mimes:png,jpg|max:2048',
        ]);

        if($request->file('img')->isValid()){
            $file = $request->file('img');
            $fileName = $file->getClientOriginalName();
            $filePath = $file->storeAs('uploads/project', $fileName, 'public');

            $Qnews = Project::create([
                'title' => $request->title,
                'intro' => $request->intro,
                'img' => $filePath,
            ]);
            if($Qnews){
                return redirect()->back()->with('success', 'Проект успешно добавлен.');
            } else {
                return redirect()->back()->with('error', 'Ошибка. Не удалось сохранить.');
            }
        } else {
            return redirect()->back()->with('error', 'Ошибка. Не удалось загрузить файл.');
        }
    }


    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $news = Project::findOrFail($id);
        return view('project.edit', compact('news'));
    }


    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required|max:255',
            'intro' => 'required|max:300',
            'img' => 'nullable|mimes:png,jpg|max:2048',
        ]);

        $news = Project::findOrFail($id);

        // Обновление полей, не зависящих от изображения
        $news->title = $request->title;
        $news->intro = $request->intro;

        // Проверка на наличие нового изображения и удаление старого
        if ($request->hasFile('img')) {
            if ($news->img && Storage::exists('public/' . $news->img)) {
                Storage::delete('public/' . $news->img);
            }

            $filePath = $request->file('img')->store('uploads/project', 'public');
            $news->img = $filePath;
        }

        $news->save();

        return redirect()->route('project.admin')->with('success', 'Проект успешно обновлен.');
    }

    public function updateActive(Request $request, $id)
    {
        $request->validate([
            'active' => 'required',
        ]);

        $news = Project::findOrFail($id);
        $news->active = $request->active;
        $news->save();
        return redirect()->route('project.admin')->with('success', 'Доступ проекта успешно изменён.');
    }

    public function dateSearch(Request $request)
    {
        $news = Project::orderBy('created_at', 'desc')->paginate(5);
        return view('project.adminPanel', ['news' => $news]);
    }

    public function search(Request $request)
    {
        $query = Project::query();

        if ($request->has('q')) {
            $query->where('title', 'like', '%' . $request->input('q') . '%')
                ->orWhere('intro', 'like', '%' . $request->input('q') . '%');
        }

        $news = $query->paginate(5);;

        return view('project.adminPanel', ['news' => $news]);
    }

    public function destroy($id)
    {
        $news = Project::findOrFail($id);

        // Проверка и удаление изображения
        if ($news->img && Storage::exists('public/' . $news->img)) {
            Storage::delete('public/' . $news->img);
        }

        $news->delete();

        return redirect()->route('project.admin')->with('success', 'Проект успешно удален.');
    }
}
