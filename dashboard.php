<?php
require_once 'config.php';
if (!isset($_SESSION['user_id'])) {
    header('Location: index.html');
    exit();
}
try {
    $pdo = getDBConnection();
    $stmt = $pdo->prepare("
        SELECT id, email, name, given_name, family_name, picture, created_at, last_login
        FROM users
        WHERE id = ?
    ");
    $stmt->execute([$_SESSION['user_id']]);
    $user = $stmt->fetch();
    if (!$user) {
        session_destroy();
        header('Location: index.html');
        exit();
    }
    $stmt = $pdo->prepare("SELECT COUNT(*) as login_count FROM login_logs WHERE user_id = ?");
    $stmt->execute([$user['id']]);
    $loginStats = $stmt->fetch();
    $stmt = $pdo->query("SELECT COUNT(*) as total_users FROM users");
    $totalUsers = $stmt->fetch();
} catch (PDOException $e) {
    die("Ошибка: " . $e->getMessage());
}
$sessionDuration = time() - $_SESSION['logged_in_at'];
$sessionMinutes = floor($sessionDuration / 60);
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Личный кабинет</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <div class="dashboard">
            <div class="welcome-message">
                <p>✨ Добро пожаловать в систему! Вы успешно вошли через Google OAuth 2.0</p>
            </div>
            <div class="user-info">
                <img src="<?php echo htmlspecialchars($user['picture'] ?? 'https://via.placeholder.com/80'); ?>"
                     alt="Avatar"
                     class="user-avatar">
                <div class="user-details">
                    <h2><?php echo htmlspecialchars($user['name']); ?></h2>
                    <p><?php echo htmlspecialchars($user['email']); ?></p>
                    <p style="font-size: 12px; margin-top: 5px;">
                        Регистрация: <?php echo date('d.m.Y', strtotime($user['created_at'])); ?>
                    </p>
                </div>
            </div>
            <div class="stats">
                <div class="stat-card">
                    <h3><?php echo $loginStats['login_count']; ?></h3>
                    <p>Всего входов</p>
                </div>
                <div class="stat-card">
                    <h3><?php echo $sessionMinutes; ?> мин</h3>
                    <p>Текущая сессия</p>
                </div>
                <div class="stat-card">
                    <h3><?php echo $totalUsers['total_users']; ?></h3>
                    <p>Всего пользователей</p>
                </div>
            </div>
            <div style="background: #f9fafb; padding: 20px; border-radius: 12px; margin: 20px 0;">
                <h3 style="margin-bottom: 15px; color: #333;">Информация о профиле</h3>
                <table style="width: 100%; border-collapse: collapse;">
                    <tr style="border-bottom: 1px solid #e5e7eb;">
                        <td style="padding: 10px 0; color: #666; width: 40%;">ID пользователя:</td>
                        <td style="padding: 10px 0; color: #333; font-weight: 500;"><?php echo $user['id']; ?></td>
                    </tr>
                    <tr style="border-bottom: 1px solid #e5e7eb;">
                        <td style="padding: 10px 0; color: #666;">Email:</td>
                        <td style="padding: 10px 0; color: #333; font-weight: 500;"><?php echo htmlspecialchars($user['email']); ?></td>
                    </tr>
                    <tr style="border-bottom: 1px solid #e5e7eb;">
                        <td style="padding: 10px 0; color: #666;">Имя:</td>
                        <td style="padding: 10px 0; color: #333; font-weight: 500;"><?php echo htmlspecialchars($user['given_name']); ?></td>
                    </tr>
                    <tr style="border-bottom: 1px solid #e5e7eb;">
                        <td style="padding: 10px 0; color: #666;">Фамилия:</td>
                        <td style="padding: 10px 0; color: #333; font-weight: 500;"><?php echo htmlspecialchars($user['family_name']); ?></td>
                    </tr>
                    <tr>
                        <td style="padding: 10px 0; color: #666;">Последний вход:</td>
                        <td style="padding: 10px 0; color: #333; font-weight: 500;"><?php echo date('d.m.Y H:i', strtotime($user['last_login'])); ?></td>
                    </tr>
                </table>
            </div>
            <div class="actions">
                <a href="#" class="btn btn-primary" onclick="alert('Это демонстрация. Здесь может быть любой функционал!'); return false;">
                    Редактировать профиль
                </a>
                <a href="#" class="btn btn-secondary" onclick="alert('Настройки в разработке'); return false;">
                    Настройки
                </a>
                <a href="logout.php" class="btn btn-danger">
                    Выйти
                </a>
            </div>
        </div>
        <div class="footer">
            <p>Защищено Google OAuth 2.0 | Сессия активна</p>
        </div>
    </div>
    <script src="script.js"></script>
</body>
</html>