<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;

class VerifyCsrfToken extends BaseVerifier
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        '/payments/system/yandex/check',
        '/payments/system/yandex/aviso',
        '/payments/system/yandex/demo/check',
        '/payments/system/yandex/demo/aviso',
    ];
}
