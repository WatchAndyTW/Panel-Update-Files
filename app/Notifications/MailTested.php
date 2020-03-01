<?php

namespace Pterodactyl\Notifications;

use Pterodactyl\Models\User;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class MailTested extends Notification
{
    /**
     * @var \Pterodactyl\Models\User
     */
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function via()
    {
        return ['mail'];
    }

    public function toMail()
    {
        return (new MailMessage)
            ->subject('翼龍面板測試郵件')
            ->greeting('您好 ' . $this->user->name . '!')
            ->line('此為面板的測試訊息，您收到就代表測試成功囉!');
    }
}
