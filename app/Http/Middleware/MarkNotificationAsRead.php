<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MarkNotificationAsRead
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        $notify_id = $request->query('notify_id');
        if($notify_id && Auth::check()){
            $user = Auth::user();
            // $notification = $user->notifications;
            $notification  = $user->notifications()->find($notify_id);
            if($notification && $notification->unread()){
                $notification->markAsRead();
            }
        }
        return $next($request);
    }
}
