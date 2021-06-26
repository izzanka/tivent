<?php

namespace App\Providers;

use App\Models\User;
use App\Models\Event;
use App\Models\Order;
use App\Models\Ticket;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
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

        Gate::define('edit-event',function(User $user,Event $event){
            return $user->id == $event->user_id;
        });

        Gate::define('edit-ticket',function(User $user,Ticket $ticket){
            return $user->id == $ticket->event->user_id;
        });

        Gate::define('edit-order',function(User $user,Order $order){
            return $user->id == $order->user_id;
        });

        Gate::define('isAdmin', function(User $user) {
            return $user->role == 'admin';
        });
        
        Gate::define('isUser', function(User $user) {
            return $user->role == 'user';
        });
    }
}
