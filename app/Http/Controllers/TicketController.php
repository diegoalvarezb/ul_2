<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\TicketService;

class TicketController extends Controller
{
    /**
     * Ticket service.
     *
     * @var \App\Services\TicketService
     */
    protected $ticketService;

    /**
     * Construct function.
     *
     * @return void
     */
    public function __construct(TicketService $ticketService)
    {
        $this->ticketService = $ticketService;
    }

    /**
     * Show the ticket subscription page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('index');
    }

    /**
     * Handle the ticket creation.
     *
     * @param  Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function create(Request $request)
    {
        // validate input data
        $ticketTypes = implode(',', array_keys(config('constants.ticket_types')));

        $this->validate($request, [
            'name'    => 'required|string|max:255',
            'email'   => 'required|string|max:255|email',
            'type'    => "required|string|in:$ticketTypes",
            'street'  => "nullable|string",
            'city'    => "nullable|string",
            'country' => "nullable|string",
            'zip'     => "nullable|string",
        ]);

        // retrieve data from request
        $data = $request->only(['name', 'email', 'type', 'street', 'city', 'country', 'zip']);

        // create ticket
        $result = $this->ticketService->create($data);

        // keep old input when there are errors
        if (!$result['success']) {
            $request->flash();
        }

        // view
        return view('index', [
            'successMessage' =>  $result['success'] ? 'The ticket has been created successfully!' : null,
            'errorMessage'   => !$result['success'] ? $result['message'] : null,
        ]);
    }
}
