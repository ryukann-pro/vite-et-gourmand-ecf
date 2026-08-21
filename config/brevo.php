<?php

use Brevo\Brevo;

$envPath = __DIR__ . '/../.env';

$envFile = file_exists($envPath)
    ? (parse_ini_file($envPath, false, INI_SCANNER_RAW) ?: [])
    : [];

$getEnvValue = static function (
    string $key,
    ?string $default = null
) use ($envFile): ?string {
    $systemValue = getenv($key);

    if ($systemValue !== false) {
        return $systemValue;
    }

    return $envFile[$key] ?? $default;
};

$brevoApiKey = $getEnvValue('BREVO_API_KEY');
$mailFrom = $getEnvValue('MAIL_FROM');
$mailFromName = $getEnvValue('MAIL_FROM_NAME');
$contactEmail = $getEnvValue('CONTACT_EMAIL');

if (
    !$brevoApiKey
    || !$mailFrom
    || !$mailFromName
    || !$contactEmail
) {
    throw new RuntimeException(
        'La configuration Brevo est incomplète.'
    );
}

$brevoClient = new Brevo(
    apiKey: $brevoApiKey,
    options: [
        'timeout' => 15,
        'maxRetries' => 1,
    ]
);

return [
    'client' => $brevoClient,
    'sender_email' => $mailFrom,
    'sender_name' => $mailFromName,
    'contact_email' => $contactEmail,
];
