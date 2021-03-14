<?php

namespace App\Services;

abstract class Service
{
    /**
     * Generate a service respone.
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
