<?php

namespace App\Http\Controllers;

use App\Models\Partners;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PartnersController extends Controller
{

    public function index()
    {
        // $partners = Partners::where('active', true)->get();
        // return view('home.index', compact('partners'));
    }
    public function adminPanel()
    {
        $news = Partners::query()->paginate(5);
        return view('partner.adminPanel', compact('news'));
    }

    public function create()
    {
        return view('partner.create');

    }


    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|max:255',
            'img' => 'required|mimes:png,jpg|max:2048',
        ]);

        if($request->file('img')->isValid()){
            $file = $request->file('img');
            $fileName = $file->getClientOriginalName();
            $filePath = $file->storeAs('uploads/partner', $fileName, 'public');

            $Qnews = Partners::create([
                'name' => $request->name,
                'img' => $filePath,
            ]);
            if($Qnews){
                return redirect()->back()->with('success', 'Партнер успешно добавлен.');
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
        $news = Partners::findOrFail($id);
        return view('partner.edit', compact('news'));
    }


    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|max:255',
            'img' => 'nullable|mimes:png,jpg|max:2048',
        ]);

        $news = Partners::findOrFail($id);

        // Обновление полей, не зависящих от изображения
        $news->name = $request->name;

        // Проверка на наличие нового изображения и удаление старого
        if ($request->hasFile('img')) {
            if ($news->img && Storage::exists('public/' . $news->img)) {
                Storage::delete('public/' . $news->img);
            }

            $filePath = $request->file('img')->store('uploads/partner', 'public');
            $news->img = $filePath;
        }

        $news->save();

        return redirect()->route('partner.admin')->with('success', 'Партнёр успешно обновлен.');
    }

    public function updateActive(Request $request, $id)
    {
        $request->validate([
            'active' => 'required',
        ]);

        $news = Partners::findOrFail($id);
        $news->active = $request->active;
        $news->save();
        return redirect()->route('partner.admin')->with('success', 'Доступ партнера успешно изменён.');
    }
    public function search(Request $request)
    {
        $query = Partners::query();

        if ($request->has('q')) {
            $query->where('name', 'like', '%' . $request->input('q') . '%');
        }

        $news = $query->paginate(5);;

        return view('partner.adminPanel', ['news' => $news]);
    }
    public function destroy(string $id)
    {
        $news = Partners::findOrFail($id);

        // Проверка и удаление изображения
        if ($news->img && Storage::exists('public/' . $news->img)) {
            Storage::delete('public/' . $news->img);
        }

        $news->delete();

        return redirect()->route('partner.admin')->with('success', 'Партнёр успешно удален.');
    }
}
