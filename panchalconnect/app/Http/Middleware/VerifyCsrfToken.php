<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * Indicates whether the XSRF-TOKEN cookie should be set on the response.
     *
     * @var bool
     */
    protected $addHttpCookie = true;

    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        'http://localhost:8000/paymentresponse',
        'http://localhost:8000/paymentresponse?*',
        'http://panchalconnect.com/paymentresponse',
        'http://panchalconnect.com/paymentresponse?*',
        'https://panchalconnect.com/paymentresponse',
        'https://panchalconnect.com/paymentresponse?*',
        'http://localhost:8000/FPpaymentresponse',
        'http://localhost:8000/FPpaymentresponse?*',
        'http://panchalconnect.com/FPpaymentresponse',
        'http://panchalconnect.com/FPpaymentresponse?*',
        'https://panchalconnect.com/FPpaymentresponse',
        'https://panchalconnect.com/FPpaymentresponse?*',
    ];
}

