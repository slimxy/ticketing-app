<?php

namespace App\Providers;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\Ticket;
use App\Models\Message;
use App\Policies\TicketPolicy;
use App\Policies\MessagePolicy;

class AuthServiceProvider extends ServiceProvider
{
/**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
protected $policies = [
    Ticket::class => TicketPolicy::class,
    Message::class => MessagePolicy::class
];
/**
     * Register any application services.
     */
    public function boot(): void
    {
        $this->registerPolicies();
    }
}