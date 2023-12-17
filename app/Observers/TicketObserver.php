<?php

namespace App\Observers;

use App\Models\Ticket;
use Filament\Notifications\Notification;

class TicketObserver
{
    /**
     * Handle the Ticket "created" event.
     */
    public function created(Ticket $ticket): void
    {
        $agent = $ticket->assignedTo;

        Notification::make()
            ->title('A Ticket has been assigned to you')
            ->sendToDatabase($agent);
    }

    /**
     * Handle the Ticket "updated" event.
     */
    public function updated(Ticket $ticket): void
    {
        //
    }
}
