<?php

namespace App\Policies;

use App\Models\Message;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class MessagePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Ticket $ticket)
    {
        // Only the organisation or the customer can view messages in the ticket
        return $user->id === $ticket->organisation_id  || $user->id === $ticket->customer_id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user, Ticket $ticket)
    {
        // Only the organisation or the customer can send for the ticket
        return $user->id === $ticket->organisation_id  || $user->id === $ticket->customer_id;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Message $message): bool
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Message $message): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Message $message): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Message $message): bool
    {
        return false;
    }
}
