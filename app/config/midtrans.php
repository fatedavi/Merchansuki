<?php
require_once __DIR__ . '/../vendor/autoload.php';

\Midtrans\Config::$serverKey    = env('MIDTRANS_SERVER_KEY');
\Midtrans\Config::$isProduction = filter_var(env('MIDTRANS_IS_PRODUCTION', false), FILTER_VALIDATE_BOOLEAN);
\Midtrans\Config::$isSanitized  = true;
\Midtrans\Config::$is3ds        = true;
