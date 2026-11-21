<?php
require_once 'config.php';
session_destroy();
if (isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', time() - 3600, '/');
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Выход выполнен</title>
    <link rel="stylesheet" href="styles.css">
    <meta http-equiv="refresh" content="3;url=index.html">
</head>
<body>
    <div class="container">
        <div class="login-box">
            <div class="logo">
                <svg width="60" height="60" viewBox="0 0 24 24" fill="none">
                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" stroke="#10b981" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <polyline points="16 17 21 12 16 7" stroke="#10b981" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <line x1="21" y1="12" x2="9" y2="12" stroke="#10b981" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
            <h1 style="color: #10b981;">Выход выполнен успешно!</h1>
            <p class="subtitle">Спасибо, что использовали нашу систему</p>
            <p style="color: #666; margin-top: 20px;">Вы будете перенаправлены на главную страницу через 3 секунды...</p>
            <div style="margin-top: 30px;">
                <a href="index.html" class="btn btn-primary">Вернуться сейчас</a>
            </div>
        </div>
    </div>
</body>
</html>