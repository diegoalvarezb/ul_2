<?php

namespace App\Services;

use App\Models\Ticket;
use App\Notifications\TicketCreated;
use App\Services\Service;

class TicketService extends Service
{
    /**
     * QR service.
     *
     * @var \App\Services\QRService
     */
    protected $QRService;

    /**
     * Construct function.
     *
     * @return void
     */
    public function __construct(QRService $QRService)
    {
        $this->QRService = $QRService;
    }

    /**
     * Create a new ticket.
     *
     * @param  array  $data
     * @return \App\Models\Ticket
     *
     * @throws \PDOException
     */
    public function create(array $data) : array
    {
        // check limits
        $ticketLimits = config('constants.ticket_limits');

        $ticketType   = $data['type'];
        $countTickets = Ticket::where('type', $ticketType)->count();

        if ($countTickets >= $ticketLimits[$ticketType]) {
            return $this->response(null, 'There aren\'t any ticket available for that type.');
        }

        // create ticket
        $ticket = new Ticket();
        $ticket->fill($data);

        $ticket->address = implode(' ', array_filter([
            $data['street'],
            $data['city'],
            $data['country'],
            $data['zip']
        ]));

        $ticket->save();

        if (!$ticket) {
            return $this->response(null, 'There\'s been an error creating the ticket, please try again in a few minutes.');
        }

        // send email
        $ticket->notify(new TicketCreated(
            $this->QRService->create()
        ));

        return $this->response($ticket);
    }
}
