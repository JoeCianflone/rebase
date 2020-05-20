<?php

/**
 * These are needed ONLY in the cases where you're allowing users to have their own custom domain
 * Certbot needs a support email address, that will default to US
 * Root is the root domain, and that's just where the site is running, needed in nginx
 * IP addresses are OUR IPs (if you have more than 2 you'll need to adjust the code), this is needed to set the SSL.
 */
return [
    'support' => env('DOMAIN_SUPPORT'),
    'url' => env('DOMAIN_URL'),
    'root' => env('DOMAIN_PRODUCTION_ROOT'),
    'ip1' => env('DOMAIN_IP1'),
];
