<?php

/*
 * This file is part of paytabs.
 *
 * (c) Walaa Elsaeed <w.elsaeed@paytabs.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

return [

    'hyperpay' => [
        'url' => env('HYPERPAY_URL'),
        'auth_key' => env('HYPERPAY_AUTH_KEY'),
        'currency' => env('HAYPERPAY_CURRENCY'),
        'entity_id' => env('HYPERPAY_ENTITY_ID'),
        'production' => env('HYPERPAY_PRODUCTION'),
    ],

];
