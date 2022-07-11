<?php

namespace App\Notifications;

use App\Models\Question;
 use App\Models\User;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
 

use Illuminate\Notifications\Messages\VonageMessage;

class AnswerNotification extends Notification
{
    use Queueable;
    protected $question;
    protected $user;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Question $question, User $user)
    {
        //
        $this->question = $question;
        $this->user = $user;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        $channels = ['database','mail','broadcast'];
        // if(in_array('mail',$notifiable->notification_options)){
        //     $channels[] = 'mail';
        // }
        // if (in_array('sms', $notifiable->notification_options)) {
            // $channels[]= 'sms';
            
        // }
        return $channels;
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
                    ->subject('New Answer')
                    ->greeting("Hello {$notifiable->name},")
                    ->line(__(':user added answer to your question ":question"', [
            'user' => $this->user->name,
            'question' => $this->question->title,
        ]),)
                    ->action('View Answer', url(route('questions.show', $this->question->id)))
                    ->line('Thank you for using our application!');
    }

public function toDatabase($notifiable){
    return[
'title' => 'New Answer' ,
'body' =>__(':user added answer to your question ":question"',[
    'user'=>$this->user->name,
    'question'=>$this->question->title,
]),
'image' => '' ,
'url'=>route('questions.show',$this->question->id),

    ];
}
    public function toVonage($notifiable)
    {
        return (new VonageMessage)
            ->content(__('new answer on ":question"',[
        'question'=>$this->question->title,
        ]));

    //     return (new VonageMessage)
    //         ->content('Your SMS message content');
    } 

    public function toBroadcast($notifiable){
        return [
            'title' => 'New Answer',
            'body' => __(':user added answer to your question ":question"', [
                'user' => $this->user->name,
                'question' => $this->question->title,
            ]),
            'image' => '',
            'url' => route('questions.show', $this->question->id),

        ];
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
