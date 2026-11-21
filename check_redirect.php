<?php
require_once 'config.php';
header('Content-Type: text/html; charset=utf-8');
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Проверка настроек</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background:
        }
        .box {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }
        h1 {
            color:
            border-bottom: 3px solid
            padding-bottom: 10px;
        }
        .info {
            background:
            padding: 15px;
            border-radius: 5px;
            margin: 10px 0;
            border-left: 4px solid
        }
        .success {
            background:
            border-left-color:
        }
        .error {
            background:
            border-left-color:
        }
        .code {
            background:
            padding: 10px;
            border-radius: 5px;
            font-family: 'Courier New', monospace;
            word-break: break-all;
            margin: 10px 0;
        }
        .copy-btn {
            background:
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
        }
        .copy-btn:hover {
            background:
        }
    </style>
</head>
<body>
    <div class="box">
        <h1>🔍 Проверка настроек Google OAuth</h1>
        <div class="info success">
            <strong>✅ Текущий Redirect URI в config.php:</strong>
            <div class="code" id="redirectUri"><?php echo htmlspecialchars(GOOGLE_REDIRECT_URI); ?></div>
            <button class="copy-btn" onclick="copyToClipboard('<?php echo GOOGLE_REDIRECT_URI; ?>')">
                📋 Скопировать
            </button>
        </div>
        <div class="info">
            <strong>📝 Что нужно сделать:</strong>
            <ol>
                <li>Скопируйте URI выше (нажмите кнопку "Скопировать")</li>
                <li>Откройте <a href="https://console.cloud.google.com/apis/credentials" target="_blank">Google Cloud Console</a></li>
                <li>Найдите OAuth Client ID: <code><?php echo GOOGLE_CLIENT_ID; ?></code></li>
                <li>Нажмите на него для редактирования</li>
                <li>В разделе "Authorized redirect URIs" нажмите "ADD URI"</li>
                <li>Вставьте скопированный URI: <code><?php echo GOOGLE_REDIRECT_URI; ?></code></li>
                <li>Сохраните изменения</li>
                <li>Подождите 1-2 минуты</li>
                <li>Попробуйте войти снова</li>
            </ol>
        </div>
        <div class="info">
            <strong>⚠️ Важно проверить:</strong>
            <ul>
                <li>URI должен быть <strong>ТОЧНО</strong> таким же (без пробелов, без слэша в конце)</li>
                <li>Протокол должен совпадать (http:
                <li>После сохранения в Google Console подождите 1-2 минуты</li>
            </ul>
        </div>
        <div class="info">
            <strong>🔗 Быстрые ссылки:</strong>
            <ul>
                <li><a href="https://console.cloud.google.com/apis/credentials" target="_blank">Google Cloud Console - Credentials</a></li>
                <li><a href="index.html">Вернуться на главную</a></li>
            </ul>
        </div>
        <?php
        $callbackPath = __DIR__ . '/callback.php';
        if (file_exists($callbackPath)) {
            echo '<div class="info success">✅ Файл callback.php существует</div>';
        } else {
            echo '<div class="info error">❌ Файл callback.php не найден!</div>';
        }
        ?>
    </div>
    <script>
        function copyToClipboard(text) {
            navigator.clipboard.writeText(text).then(function() {
                alert('✅ Скопировано в буфер обмена!\n\n' + text);
            }, function(err) {
                const textarea = document.createElement('textarea');
                textarea.value = text;
                document.body.appendChild(textarea);
                textarea.select();
                document.execCommand('copy');
                document.body.removeChild(textarea);
                alert('✅ Скопировано в буфер обмена!\n\n' + text);
            });
        }
    </script>
</body>
</html>