<?php

namespace App\Mail;


use App\Models\Vacancy;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VacancyNotification extends Mailable
{
    use Queueable, SerializesModels;
    public $vacancy;
    public $user;

    public function __construct(Vacancy $vacancy, User $user)
    {
        $this->vacancy = $vacancy;
        $this->user = $user;
    }

    public function build()
    {
        return $this->subject('Новый отклик на вакансию!')
            ->from('i.bezyazykov@yandex.ru', 'intaktika')
            ->view('emails.vacancy_notification');
    }


}
