<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    
    
    
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];
    public function boot(){
        $this->registerPolicies();
        Gate::define('delete-project', function($user, $project){
            // has to return true of false
            return $user->id == $project->user_id;
        });
    }

}
