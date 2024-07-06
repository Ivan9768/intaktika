<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;


class NewsController extends Controller
{

    public function index()
    {

        // Для обычных пользователей
        $news = News::where('active', true)->paginate(2);
        return view('news.index', compact('news'));

    }


    public function create()
    {
        return view('news.create');
    }


    public function store(Request $request)
{
    $request->validate([
        'title' => 'required|max:255',
        'intro' => 'required|max:300',
        'info' => 'required|max:2000',
        'img' => 'required|mimes:png,jpg|max:2048',
        'datetime_publication' => 'required',
    ]);

    if($request->file('img')->isValid()){
        $file = $request->file('img');
        $fileName = $file->getClientOriginalName();
        $filePath = $file->storeAs('uploads/news', $fileName, 'public');

        $Qnews = News::create([
            'title' => $request->title,
            'intro' => $request->intro,
            'info' => $request->info,
            'img' => $filePath,
            'datetime_publication' => $request->datetime_publication,
        ]);
        if($Qnews){
            return redirect()->back()->with('success', 'Новость успешно добавлена.');
        } else {
            return redirect()->back()->with('error', 'Ошибка. Не удалось сохранить.');
        }
    } else {
        return redirect()->back()->with('error', 'Ошибка. Не удалось загрузить файл.');
    }
}


    public function show($id)
    {
        $news = News::findOrFail($id);
        if (!$news->active && (!Auth::check() || Auth::user()->role !== 'admin')) {
            abort(403); // Запрещаем доступ, если пост не опубликован и пользователь не админ
        }

        $newsAll = News::where('active', true)->take(4)->get();

        // Форматирование даты для каждой новости
        foreach ($newsAll as $newsItem) {
            $newsItem->formattedDate = Carbon::parse($newsItem->datetime_publication)->isoFormat('D MMMM YYYY');
        }

        return view('news.show', compact('news', 'newsAll'));
    }



    public function edit($id)
    {
        $news = News::findOrFail($id);
        return view('news.edit', compact('news'));
    }


    public function update(Request $request, $id)
{
    $request->validate([
        'title' => 'required|max:255',
        'intro' => 'required|max:300',
        'info' => 'required|max:2000',
        'img' => 'nullable|mimes:png,jpg|max:2048', // Изображение может быть nullable
        'datetime_publication' => 'required',
    ]);

    $news = News::findOrFail($id);

    // Обновление полей, не зависящих от изображения
    $news->title = $request->title;
    $news->intro = $request->intro;
    $news->info = $request->info;
    $news->datetime_publication = $request->datetime_publication;

    // Проверка на наличие нового изображения и удаление старого
    if ($request->hasFile('img')) {
        if ($news->img && Storage::exists('public/' . $news->img)) {
            Storage::delete('public/' . $news->img);
        }

        $filePath = $request->file('img')->store('uploads/news', 'public');
        $news->img = $filePath;
    }

    $news->save();

    return redirect()->route('news.admin')->with('success', 'Новость успешно обновлена.');
}

public function updateActive(Request $request, $id)
{
    $request->validate([
        'active' => 'required',
    ]);

    $news = News::findOrFail($id);
    $news->active = $request->active;
    $news->save();
    return redirect()->route('news.admin')->with('success', 'Доступ новости успешно изменён.');
}

    public function dateSearch(Request $request)
    {
        $news = News::orderBy('datetime_publication', 'desc')->paginate(5);
        return view('home.adminPanel', ['news' => $news]);
    }


    public function search(Request $request)
    {
        $query = News::query();

        if ($request->has('q')) {
            $query->where('title', 'like', '%' . $request->input('q') . '%')
                  ->orWhere('info', 'like', '%' . $request->input('q') . '%');
        }

        $news = $query->paginate(5);;

        return view('home.adminPanel', ['news' => $news]);
    }

    public function destroy($id)
{
    $news = News::findOrFail($id);

    // Проверка и удаление изображения
    if ($news->img && Storage::exists('public/' . $news->img)) {
        Storage::delete('public/' . $news->img);
    }

    $news->delete();

    return redirect()->route('news.admin')->with('success', 'Новость успешно удалена.');
}

}
