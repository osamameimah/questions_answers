<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

//    Gate::define('tags.view',function(User $user){
//     return false;
//    });

        //
        // Gate::before(function(User $user,$ability){
        //     if ($user->type == 'super-admin') {
        //         return true;
        //     }
        // });
        foreach(config('abilities') as $code=>$label){
        Gate::define($code,function(User $user) use ($code){
            if($user->type == 'super-admin'){
                return true;
            }
            foreach($user->roles as $role){
                if (in_array($code, $role->abilities)){
                    return true;
                }
            }
            return false;
        });
        }
        // Gate::define('tags.edit', function (User $user) {
        //     foreach ($user->roles as $role) {
        //         if (in_array('tags.edit', $role->abilities)) {
        //             return true;
        //         }
        //     }
        //     return false;
        // });
        // Gate::define('tags.delete', function (User $user) {
        //     foreach ($user->roles as $role) {
        //         if (in_array('tags.delete', $role->abilities)) {
        //             return true;
        //         }
        //     }
        //     return false;
        // });
        // Gate::define('tags.create', function (User $user) {
        //     foreach ($user->roles as $role) {
        //         if (in_array('tags.create', $role->abilities)) {
        //             return true;
        //         }
        //     }
        //     return false;
        // });


    }
}
