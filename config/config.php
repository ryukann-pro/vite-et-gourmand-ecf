<?php

$appBaseUrl = getenv('APP_BASE_URL');

define(
    'BASE_URL',
    $appBaseUrl !== false
        ? $appBaseUrl
        : '/vite-et-gourmand-ecf/public'
);

define(
    'APP_URL',
    getenv('APP_URL') ?: 'http://localhost/vite-et-gourmand-ecf/public'
);
