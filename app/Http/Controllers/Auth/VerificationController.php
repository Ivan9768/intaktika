<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class VerificationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Email Verification Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling email verification for any
    | user that recently registered with the application. Emails may also
    | be re-sent if the user didn't receive the original email message.
    |
    */

    use VerifiesEmails;

    /**
     * Where to redirect users after verification.
     *
     * @var string
     */
    // protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }

    public function showVerificationForm()
    {
        return view('auth.verification');
    }

    public function verifye(Request $request)
{
    $request->validate([
        'code' => 'required|array|min:6', // Проверка, что код представлен как массив из 6 элементов
        'code.*' => 'required|digits:1', // Проверка, что каждый элемент массива - одна цифра
    ]);

    // Получаем массив кодов и объединяем их в строку
    $enteredCode = (int)implode('', $request->code);

    // Получаем пользователя по электронной почте
    $user = User::where('email', Auth::user()->email)->first();

    if ($user) { // Проверяем, что пользователь существует
        if ($user->code === $enteredCode) { // Сравниваем строку кода пользователя с введенным кодом
            $user->code = 0;
            $user->email_verified_at = now();
            $user->role = 'user';
            $user->save();

            return redirect()->route('home')->with('success', 'Почтовый адрес успешно подтвержден и пользователь аутентифицирован.');
        } else {
            return back()->with('error', 'Неверный код подтверждения.');
        }
    } else {
        return back()->with('error', 'Пользователь не найден.');
    }


}
}
