<?php

namespace App\Notifications\Company;

use App\Models\Company;
use App\Models\Job;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class MailApply extends Notification
{
    use Queueable;

    /**
     * @var Company
     */
    protected $company;

    /**
     * @var Job
     */
    protected $job;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Company $company, Job $job)
    {
        $this->company = $company;
        $this->job = $job;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->from(config('mail.from.address'), config('mail.from.name'))
            ->subject('Curriculum Vitae has been approved')
            ->markdown(
                'emails.company.apply',
                [
                    'candidate' => $notifiable,
                    'company' => $this->company,
                    'job' => $this->job,
                ]
            );
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
