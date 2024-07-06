<?php

namespace App\Mail;

use App\Models\Service;
use App\Models\User;
use App\Models\UserService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ServiceNotification extends Mailable
{
    use Queueable, SerializesModels;

    use Queueable, SerializesModels;
    public $service;
    public $user;
    public $comment;
    public $uv;

    public function __construct(Service $service, User $user, $comment, $uv)
    {
        $this->service = $service;
        $this->user = $user;
        $this->comment = $comment;
        $this->uv=$uv;
   }

    public function build()
    {
        return $this->subject('Новая заявка на услугу!')
            ->from('i.bezyazykov@yandex.ru', 'intaktika')
            ->view('emails.service_notification');
    }
}
