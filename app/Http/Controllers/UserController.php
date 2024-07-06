<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserService;
use App\Models\UserVacancy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function adminPanel()
    {
        $news = User::query()->paginate(5);
        return view('user.adminPanel', compact('news'));
    }

    public function userPanel()
    {
        $user = auth()->user();
        return view('user.userPanel', compact('user'));
    }
    public function userPanelApplication()
    {
        $user_id = auth()->user()->id;
        $applications = UserVacancy::query()->where('user_id', $user_id)->with(['user', 'vacancy'])->get();

        return view('user.application', compact('applications'));
    }
    public function userPanelApplicationService()
    {
        $user_id = auth()->user()->id;
        $applications = UserService::query()->where('user_id', $user_id)->paginate(2);

        return view('user.applicationService', compact('applications'));
    }
    public function userPanelAnalytic()
    {
        return view('user.analytic');
    }
    public function userPanelSave(Request $request)
    {
        // Получаем данные из запроса
        $fieldName = $request->input('field_name');
        $newValue = $request->input('new_value');
        $user = Auth::user();

        // Проверка доступных для изменения полей
        $allowedFields = ['name', 'email', 'telephone', 'password'];

        if (!in_array($fieldName, $allowedFields)) {
            return response()->json(['success' => false, 'message' => 'Invalid field'], 400);
        }

        // Валидация данных
        $rules = [
            'name' => 'string|max:255',
            'email' => 'string|email|max:255|unique:users,email,' . $user->id,
            'telephone' => 'numeric|min:11',
            'password' => 'string|min:8|'
        ];

        $validator = Validator::make([$fieldName => $newValue], [$fieldName => $rules[$fieldName]]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 400);
        }

        // Обновление данных пользователя
        if ($fieldName === 'password') {
            $newValue = bcrypt($newValue);
        }

        $user->update([$fieldName => $newValue]);

        // Возвращаем ответ об успешном сохранении
        return response()->json(['success' => true]);
    }



    public function updateActive(Request $request, $id)
    {
        $request->validate([
            'active' => 'required',
        ]);

        $news = User::findOrFail($id);
        $news->active = $request->active;
        $news->save();
        return redirect()->route('user.admin')->with('success', 'Доступ пользователя успешно изменён.');
    }

    public function updateRole(Request $request, $id)
    {
        $request->validate([
            'role' => 'required',
        ]);

        $news = User::findOrFail($id);
        $news->role = $request->role;
        $news->save();
        return redirect()->route('user.admin')->with('success', 'Роль пользователя успешно изменена.');
    }

    public function dateSearch(Request $request)
    {
        $news = User::orderBy('created_at', 'desc')->paginate(5);
        return view('user.adminPanel', ['news' => $news]);
    }

    public function search(Request $request)
    {
        $query = User::query();

        if ($request->has('q')) {
            $query->where('name', 'like', '%' . $request->input('q') . '%')
                ->orWhere('email', 'like', '%' . $request->input('q') . '%')
                ->orWhere('telephone', 'like', '%' . $request->input('q') . '%')
                ->Where('role', 'like', '%' . $request->input('q') . '%');
        }

        $news = $query->paginate(5);

        return view('user.adminPanel', ['news' => $news]);
    }

}
