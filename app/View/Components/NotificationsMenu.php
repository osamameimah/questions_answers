<?php

namespace App\View\Components;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class NotificationsMenu extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $notifications;
    public $unreadCount;
    public function __construct()
    {
        //
        $user = Auth::user();
        $notifications = $user->notifications()->take(7)->get();
        $this->notifications = $notifications;
        $this->unreadCount = $user->unreadNotifications()->count(); 
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.notifications-menu');
    }
}
