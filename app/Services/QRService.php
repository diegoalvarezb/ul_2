<?php

namespace App\Services;

use App\Services\Service;
use chillerlan\QRCode\QRCode;
use chillerlan\QRCode\QROptions;
use Faker\Factory as Faker;

class QRService extends Service
{
    /**
     * Create a new QR code.
     *
     * @return null|string
     */
    public function create() : string
    {
        $fakeUrl = (Faker::create())->url();
        $qrCode  = $this->getQRInstance()->render($fakeUrl);

        return $qrCode;
    }

    /**
     * Create a new QR instance.
     *
     * @return chillerlan\QRCode\QRCode
     */
    protected function getQRInstance() : QRCode
    {
        $qrOptions = new QROptions([
            'outputType'  => QRCode::OUTPUT_IMAGE_PNG,
            'imageBase64' => false,
        ]);

        return new QRCode($qrOptions);
    }
}
