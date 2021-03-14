<?php

namespace Tests\Unit;

use App\Notifications\TicketCreated;
use App\Services\TicketService;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class TicketServiceTest extends TestCase
{
    /**
     * Tag service.
     *
     * @var \App\Services\TicketService
     */
    protected $ticketService;

    /**
     * {@inherit}
     */
    protected function setUp() : void
    {
        parent::setUp();

        $this->ticketService = $this->app->make(TicketService::class);
    }

    /**
     * TicketService test.
     *
     * @return void
     */
    public function test_general_ticket_is_succesfully_created()
    {
        Notification::fake();

        // DATA
        $input = [
            'type'  => 'GENERAL',
            'name'  => 'Fake name',
            'email' => 'fake@email.email',
        ];

        // ACTION
        $output = $this->ticketService->create($input);

        // OUTPUT ASSERTIONS
        $this->assertTrue($output['success']);
        $this->assertDatabaseHas('tickets', $input);

        Notification::assertSentTo([ $output['data'] ], TicketCreated::class);
    }

    /**
     * TicketService test.
     *
     * @return void
     */
    public function test_preference_ticket_is_succesfully_created()
    {
        Notification::fake();

        // DATA
        $input = [
            'type'  => 'PREFERENCE',
            'name'  => 'Fake name',
            'email' => 'fake@email.email',
        ];

        // ACTION
        $output = $this->ticketService->create($input);

        // OUTPUT ASSERTIONS
        $this->assertTrue($output['success']);
        $this->assertDatabaseHas('tickets', $input);

        Notification::assertSentTo([ $output['data'] ], TicketCreated::class);
    }

     /**
     * TicketService test.
     *
     * @return void
     */
    public function test_vip_ticket_is_succesfully_created()
    {
        Notification::fake();

        // DATA
        $input = [
            'type'  => 'VIP',
            'name'  => 'Fake name',
            'email' => 'fake@email.email',
        ];

        // ACTION
        $output = $this->ticketService->create($input);

        // OUTPUT ASSERTIONS
        $this->assertTrue($output['success']);
        $this->assertDatabaseHas('tickets', $input);

        Notification::assertSentTo([ $output['data'] ], TicketCreated::class);
    }

    /**
     * TicketService test.
     *
     * @return void
     */
    public function test_general_ticket_cannot_be_created_if_limit_is_reached()
    {
        Notification::fake();

        $limit = config('constants.ticket_limits')['GENERAL'];

        for ($i = 1; $i <= $limit + 5; $i++) {
            // DATA
            $input = [
                'type'  => 'GENERAL',
                'name'  => 'Fake name',
                'email' => 'fake@email.email',
            ];

            // ACTION
            $output = $this->ticketService->create($input);

            // OUTPUT ASSERTIONS
            if ($i <= $limit) {
                $this->assertTrue($output['success']);
            } else {
                $this->assertFalse($output['success']);
            }
        }
    }

    /**
     * TicketService test.
     *
     * @return void
     */
    public function test_preference_ticket_cannot_be_created_if_limit_is_reached()
    {
        Notification::fake();

        $limit = config('constants.ticket_limits')['PREFERENCE'];

        for ($i = 1; $i <= $limit + 5; $i++) {
            // DATA
            $input = [
                'type'  => 'PREFERENCE',
                'name'  => 'Fake name',
                'email' => 'fake@email.email',
            ];

            // ACTION
            $output = $this->ticketService->create($input);

            // OUTPUT ASSERTIONS
            if ($i <= $limit) {
                $this->assertTrue($output['success']);
            } else {
                $this->assertFalse($output['success']);
            }
        }
    }

    /**
     * TicketService test.
     *
     * @return void
     */
    public function test_vip_ticket_cannot_be_created_if_limit_is_reached()
    {
        Notification::fake();

        $limit = config('constants.ticket_limits')['VIP'];

        for ($i = 1; $i <= $limit + 5; $i++) {
            // DATA
            $input = [
                'type'  => 'VIP',
                'name'  => 'Fake name',
                'email' => 'fake@email.email',
            ];

            // ACTION
            $output = $this->ticketService->create($input);

            // OUTPUT ASSERTIONS
            if ($i <= $limit) {
                $this->assertTrue($output['success']);
            } else {
                $this->assertFalse($output['success']);
            }
        }
    }
}
