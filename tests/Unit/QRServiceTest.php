<?php

namespace Tests\Unit;

use App\Services\QRService;
use Tests\TestCase;

class QRServiceTest extends TestCase
{
    /**
     * Tag service.
     *
     * @var \App\Services\QRService
     */
    protected $qrService;

    /**
     * {@inherit}
     */
    protected function setUp() : void
    {
        parent::setUp();

        $this->qrService = $this->app->make(QRService::class);
    }

    /**
     * QRService test.
     *
     * @return void
     */
    public function test_qrcode_is_succesfully_created()
    {
        // ACTION
        $output = $this->qrService->create();

        // OUTPUT ASSERTIONS
        $this->assertIsString($output);
    }
}
