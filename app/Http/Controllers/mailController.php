<?php

namespace App\Http\Controllers;

use App\Mail\ServiceNotification;
use App\Mail\VacancyNotification;
use App\Models\Service;
use App\Models\User;
use App\Models\UserService;
use App\Models\Vacancy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class mailController extends Controller
{
    public function verification($email, $randomCode){
        Mail::send(
            ['text'=>'mail'],
            ['name','intaktika'],
            function($message) use ($email, $randomCode){
                $message->to($email, 'intaktika')->subject('Код подтверждения почты:'. $randomCode);
                $message->from('i.bezyazykov@yandex.ru', 'intaktika');
            });
    }
    public function adminMassageApplication($vacancy, $user){
        $vacancy = Vacancy::find($vacancy);
        $user = User::find($user);

        Mail::to('ivan_bez08@vk.com')
            ->send(new VacancyNotification($vacancy, $user));

    }
    public function adminMassageService($service, $user_id, $comment, $uv){
        $service = Service::find($service);
        $user = User::find($user_id);

        Mail::to('ivan_bez08@vk.com')
            ->send(new ServiceNotification($service, $user, $comment, $uv));

    }
}
