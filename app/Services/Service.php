<?php

namespace App\Services;

abstract class Service
{
    /**
     * Generate a service response.
     * This provides an interface to check the result of a service execution.
     *
     * @param  mixed  $data
     * @return mixed|null
     */
    protected function response($data, $message = 'Ok')
    {
        return [
            'success' => $data ? true : false,
            'data'    => $data,
            'message' => $message,
        ];
    }
}
