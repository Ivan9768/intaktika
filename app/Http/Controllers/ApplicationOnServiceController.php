<?php

namespace App\Http\Controllers;

use App\Models\UserService;
use Illuminate\Http\Request;

class ApplicationOnServiceController extends Controller
{
    public function apply(Request $request){
        $data = $request->validate([
            'service_id'=>'required|exists:services,id',
            'user_id' => 'required|exists:users,id',
            'comment' => 'required|max:1000'
        ]);

            // Создание записи в таблице
            $userVacancy = UserService::query()->create($data);
            $uv = $userVacancy->id;
            if($userVacancy){
                $mailController = new mailController();
                $mailController->adminMassageService($request->service_id, $request->user_id, $request->comment, $uv);
                return redirect()->back()->with('success', 'Заявка на услугу была успешно отправлена.');
            } else {
                return redirect()->back()->with('error', 'Ошибка. Не удалось сохранить заявку.');
            }

    }
    public function adminPanel()
    {
        $news = UserService::with(['user', 'service'])->paginate(5);
        return view('application-service.adminPanel', compact('news'));
    }
    public function updateStatus(Request $request, $id){
        $request->validate([
            'status' => 'required|string|max:50',
        ]);

        $news = UserService::findOrFail($id);
        $news->status = $request->status;
        $news->save();
        return redirect()->route('application-service.admin')->with('success', 'Статус заявки успешно изменен.');
    }

    public function dateSearch(Request $request)
    {
        $news = UserService::orderBy('created_at', 'desc')->paginate(5);
        return view('application-service.adminPanel', ['news' => $news]);
    }
    public function search(Request $request)
    {
        // Инициализируем запрос с подгрузкой отношений 'user' и 'vacancy'
        $query = UserService::with(['user', 'service']);

        if ($request->has('q')) {
            $searchTerm = $request->input('q');

            $query->where(function ($query) use ($searchTerm) {
                $query->whereHas('service', function ($q) use ($searchTerm) {
                    $q->where('title', 'like', '%' . $searchTerm . '%');
                })
                    ->orWhereHas('user', function ($q) use ($searchTerm) {
                        $q->where(function($query) use ($searchTerm) {
                            $query->where('telephone', 'like', '%' . $searchTerm . '%')
                                ->orWhere('email', 'like', '%' . $searchTerm . '%');
                        });
                    })
                    ->orWhere('status', 'like', '%' . $searchTerm . '%');
            });

        }
        if ($request->has('id')) {
            $vacancyId = $request->input('id');

            $query->whereHas('user_services', function ($q) use ($vacancyId) {
                $q->where('id', $vacancyId);
            });
        }

        $news = $query->paginate(5);

        return view('application-service.adminPanel', ['news' => $news]);
    }
}
