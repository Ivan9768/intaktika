<?php

namespace App\Http\Controllers;

use App\Models\Vacancy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VacancyController extends Controller
{

    public function index()
    {
        $vacancy = Vacancy::where('active', true)->get();
        return view('vacancy.index', compact('vacancy'));
    }

    public function adminPanel()
    {
        $news = Vacancy::query()->paginate(5);
        return view('vacancy.adminPanel', compact('news'));
    }

    public function create()
    {
        return view('vacancy.create');
    }


    public function store(Request $request)
    {

        $data = $request->validate([
            'vacancy' => 'required|max:255',
            'intro' => 'required|max:500',
            'duties' => 'required|max:2000',
            'requirements' => 'required|max:2000',
            'conditions' => 'required|max:2000',
        ]);

        Vacancy::query()->create($data);
        return redirect()->back()->with('success', 'Вакансия успешно добавлена.');
    }


    public function show($id)
    {
        $vacancy = Vacancy::findOrFail($id);
        if (!$vacancy->active && (!Auth::check() || Auth::user()->role !== 'admin')) {
            abort(403); // Запрещаем доступ, если пост не опубликован и пользователь не админ
        }
        return view('vacancy.show', compact('vacancy'));
    }


    public function edit(string $id)
    {
        $news = Vacancy::findOrFail($id);
        return view('vacancy.edit', compact('news'));
    }

    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'vacancy' => 'required|max:255',
            'intro' => 'required|max:500',
            'duties' => 'required|max:2000',
            'requirements' => 'required|max:2000',
            'conditions' => 'required|max:2000',
        ]);
        Vacancy::query()->where('id', $id)->update($data);
        return redirect()->back()->with('success', 'Вакансия успешно обновлена.');
    }
    public function updateActive(Request $request, $id)
    {
        $request->validate([
            'active' => 'required',
        ]);

        $news = Vacancy::findOrFail($id);
        $news->active = $request->active;
        $news->save();
        return redirect()->route('vacancy.admin')->with('success', 'Доступ вакансии успешно изменён.');
    }

    public function search(Request $request)
    {
        $query = Vacancy::query();

        if ($request->has('q')) {
            $query->where('vacancy', 'like', '%' . $request->input('q') . '%')
                ->orWhere('intro', 'like', '%' . $request->input('q') . '%');
        }

        $news = $query->paginate(5);;

        return view('vacancy.adminPanel', ['news' => $news]);
    }

    public function destroy($id)
    {
        $news = Vacancy::findOrFail($id);
        $news->delete();

        return redirect()->route('vacancy.admin')->with('success', 'Вакансия успешно удалена.');
    }
}
