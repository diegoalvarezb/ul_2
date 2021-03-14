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
    protected $qrService;

    /**
     * Construct function.
     *
     * @return void
     */
    public function __construct(QRService $qrService)
    {
        $this->qrService = $qrService;
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
        // check limit
        if (!$this->checkLimit($data['type'])) {
            return $this->response(null, 'There aren\'t any ticket available for that type.');
        }

        // create ticket
        $ticket = new Ticket();
        $ticket->fill($data);

        $ticket->address = implode(' ', array_filter([
            $data['street']  ?? null,
            $data['city']    ?? null,
            $data['country'] ?? null,
            $data['zip']     ?? null
        ]));

        $ticket->save();

        // check result
        if (!$ticket) {
            return $this->response(null, 'There\'s been an error creating the ticket, please try again in a few minutes.');
        }

        // send email with QR code attached
        $ticket->notify(new TicketCreated(
            $this->qrService->create()
        ));

        return $this->response($ticket);
    }

    /**
     * Check if the limit of a ticket type has been reached.
     *
     * @param  string $ticketType
     * @return boolean
     */
    protected function checkLimit(string $ticketType) : bool
    {
        $ticketLimits = config('constants.ticket_limits');
        $countTickets = Ticket::where('type', $ticketType)->count();

        return $countTickets < $ticketLimits[$ticketType];
    }
}
