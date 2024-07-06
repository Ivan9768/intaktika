<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{


    public function index()
    {
        $service = Service::where('active', true)->paginate(3);;
        return view('service.index', compact('service'));
    }

    public function adminPanel()
    {
        $news = Service::query()->paginate(6);
        return view('service.adminPanel', compact('news'));
    }

    public function create()
    {
        return view('service.create');
    }


    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required|max:255',
            'intro' => 'required|max:500',
            'info' => 'required|max:2000',
            'img' => 'required|mimes:png,jpg|max:2048',
        ]);



        if($request->file('img')->isValid()){
            $file = $request->file('img');
            $fileName = $file->getClientOriginalName();
            $filePath = $file->storeAs('uploads/service', $fileName, 'public');

            $Qnews = Service::create([
                'title' => $request->title,
                'intro' => $request->intro,
                'info' => $request->info,
                'img' => $filePath,
            ]);
            if($Qnews){

                return redirect()->back()->with('success', 'Услуга успешно добавлена.');
            } else {
                return redirect()->back()->with('error', 'Ошибка. Не удалось сохранить.');
            }
        } else {
            return redirect()->back()->with('error', 'Ошибка. Не удалось загрузить файл.');
        }
    }


    public function show($id)
    {
        $news = Service::findOrFail($id);
        if (!$news->active && (!Auth::check() || Auth::user()->role !== 'admin')) {
            abort(403); // Запрещаем доступ, если пост не опубликован и пользователь не админ
        }

        $newsAll = Service::where('active', true)->take(5)->get();
        return view('service.show', compact('news', 'newsAll'));

    }

    public function edit(string $id)
    {
        $news = Service::findOrFail($id);
        return view('service.edit', compact('news'));
    }


    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required|max:255',
            'intro' => 'required|max:300',
            'info' => 'required|max:2000',
            'img' => 'nullable|mimes:png,jpg|max:2048',
        ]);

        $news = Service::findOrFail($id);

        // Обновление полей, не зависящих от изображения
        $news->title = $request->title;
        $news->intro = $request->intro;
        $news->info = $request->info;

        // Проверка на наличие нового изображения и удаление старого
        if ($request->hasFile('img')) {
            if ($news->img && Storage::exists('public/' . $news->img)) {
                Storage::delete('public/' . $news->img);
            }

            $filePath = $request->file('img')->store('uploads/service', 'public');
            $news->img = $filePath;
        }

        $news->save();

        return redirect()->route('service.admin')->with('success', 'Услуга успешно обновлена.');
    }


    public function updateActive(Request $request, $id)
    {
        $request->validate([
            'active' => 'required',
        ]);

        $news = Service::findOrFail($id);
        $news->active = $request->active;
        $news->save();
        return redirect()->route('service.admin')->with('success', 'Доступ услуги успешно изменён.');
    }

//    public function dateSearch(Request $request)
//    {
//        $news = Service::orderBy('datetime_publication', 'desc')->paginate(5);
//        return view('home.adminPanel', ['news' => $news]);
//    }


    public function search(Request $request)
    {
        $query = Service::query();

        if ($request->has('q')) {
            $query->where('title', 'like', '%' . $request->input('q') . '%')
                ->orWhere('info', 'like', '%' . $request->input('q') . '%');
        }

        $news = $query->paginate(4);;

        return view('service.adminPanel', ['news' => $news]);
    }

    public function destroy($id)
    {
        $news = Service::findOrFail($id);

        // Проверка и удаление изображения
        if ($news->img && Storage::exists('public/' . $news->img)) {
            Storage::delete('public/' . $news->img);
        }

        $news->delete();

        return redirect()->route('service.admin')->with('success', 'Новость успешно удалена.');
    }
}
