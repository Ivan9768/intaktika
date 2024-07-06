<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Vacancy;
use App\Models\UserVacancy;
use Illuminate\Support\Facades\Auth;

class ApplicationController extends Controller
{
    public function apply(Request $request){
        $request->validate([
            'vacancy_id'=>'required|exists:vacancies,id',
            'resume' => 'required|mimes:pdf,doc,docx|max:2048'
        ]);

        $userVacancy = UserVacancy::where('user_id', Auth::user()->id)
                               ->where('vacancy_id', $request->vacancy_id)
                               ->exists();

        if($userVacancy){
            return redirect()->back()->with('error', 'Вы уже отправили заявку на эту вакансию.
            Статус заявки можно узнать в личном кабинете.');
        }

        if($request->file('resume')->isValid()){
            $file = $request->file('resume');
            $fileName = $file->getClientOriginalName();
            $filePath = $file->storeAs('uploads/resume', $fileName, 'public');

            // Создание записи в таблице user_vacancy
            $userVacancy = UserVacancy::create([
                'user_id' => Auth::user()->id,
                'vacancy_id' => $request->vacancy_id,
                'resume' => $filePath,
            ]);

            if($userVacancy){
                $mailController = new mailController();
                $mailController->adminMassageApplication($request->vacancy_id, Auth::user()->id);
                return redirect()->back()->with('success', 'Заявка на вакансию была успешно отправлена.');
            } else {
                return redirect()->back()->with('error', 'Ошибка. Не удалось сохранить заявку.');
            }
        } else {
            return redirect()->back()->with('error', 'Ошибка. Не удалось загрузить файл.');
        }
    }

    public function adminPanel()
    {
        $news = UserVacancy::with(['user', 'vacancy'])->paginate(5);
        return view('application.adminPanel', compact('news'));
    }

    public function updateStatus(Request $request, $id){
        $request->validate([
            'status' => 'required|string|max:50',
            'comment' => 'string|max:1000',
            'date_interview' => 'date',
        ]);

        $news = UserVacancy::findOrFail($id);
        $news->status = $request->status;
        $news->comment = $request->comment;
        $news->date_interview = $request->date_interview;
        $news->save();
        return redirect()->route('application.admin')->with('success', 'Статус отклика успешно изменен.');
    }
    public function updateStatusCreateComment(Request $request)
    {
        // Получение записи по id
        $news = UserVacancy::find($request->id);

        // Проверка, что запись найдена
        if (!$news) {
            return redirect()->back()->with('error', 'Запись не найдена');
        }

        // Возвращение представления с найденной записью
        return view('application.createComment', compact('news'));
    }


    public function dateSearch(Request $request)
    {
        $news = UserVacancy::orderBy('created_at', 'desc')->paginate(5);
        return view('application.adminPanel', ['news' => $news]);
    }

    public function search(Request $request)
    {
        // Инициализируем запрос с подгрузкой отношений 'user' и 'vacancy'
        $query = UserVacancy::with(['user', 'vacancy']);

        // Проверяем наличие параметра 'q'
        if ($request->has('q')) {
            $searchTerm = $request->input('q');

            $query->where(function ($query) use ($searchTerm) {
                $query->whereHas('vacancy', function ($q) use ($searchTerm) {
                    $q->where('vacancy', 'like', '%' . $searchTerm . '%');
                })
                    ->orWhereHas('user', function ($q) use ($searchTerm) {
                        $q->where('telephone', 'like', '%' . $searchTerm . '%')
                            ->orWhere('id', 'like', '%' . $searchTerm . '%');
                    });
            });
        }

        // Проверяем наличие параметра 'vacancy_id'
        if ($request->has('vacancy_id')) {
            $vacancyId = $request->input('vacancy_id');

            $query->whereHas('vacancy', function ($q) use ($vacancyId) {
                $q->where('id', $vacancyId);
            });
        }
        // Проверяем наличие параметра 'user_id'
        if ($request->has('user_id')) {
            $userId = $request->input('user_id');

            $query->whereHas('user', function ($q) use ($userId) {
                $q->where('id', $userId);
            });
        }

        // Пагинация и возврат результата
        $news = $query->paginate(5);

        return view('application.adminPanel', ['news' => $news]);
    }


}
