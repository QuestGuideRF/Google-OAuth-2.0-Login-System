<?php
require_once 'config.php';
if (isset($_SESSION['user_id'])) {
    header('Location: dashboard.php');
    exit();
}
$state = bin2hex(random_bytes(16));
$_SESSION['oauth_state'] = $state;
$params = [
    'client_id' => GOOGLE_CLIENT_ID,
    'redirect_uri' => GOOGLE_REDIRECT_URI,
    'response_type' => 'code',
    'scope' => 'openid email profile',
    'state' => $state,
    'access_type' => 'online',
    'prompt' => 'select_account'
];
$authUrl = GOOGLE_AUTH_URL . '?' . http_build_query($params);
header('Location: ' . $authUrl);
exit();
?>