# 🔐 Google OAuth 2.0 - Система Авторизации

> Современная, безопасная и элегантная система авторизации через Google аккаунт

---

## ✨ Возможности системы

<table>
<tr>
<td width="50%">

### 🎯 Основное
- ✅ **OAuth 2.0** - Безопасный вход через Google
- ✅ **CSRF Protection** - Защита от атак
- ✅ **Session Management** - Управление сессиями
- ✅ **SQL Injection Protection** - Prepared statements

</td>
<td width="50%">

### 🎨 Интерфейс
- ✅ **Современный дизайн** - Градиенты и анимации
- ✅ **Адаптивная верстка** - Работает на всех устройствах
- ✅ **Статистика** - История входов и аналитика
- ✅ **Личный кабинет** - Dashboard с данными пользователя

</td>
</tr>
</table>

---

## 📁 Структура проекта

```
google-auth/
│
├── 🎨 Frontend
│   ├── index.html          # Главная страница с Google Sign-In
│   ├── dashboard.php       # Личный кабинет пользователя
│   ├── styles.css          # Современные стили с градиентами
│   └── script.js           # Интерактивная логика
│
├── ⚙️ Backend
│   ├── login.php           # Инициация OAuth 2.0
│   ├── callback.php        # Обработка Google response
│   ├── logout.php          # Завершение сессии
│   └── config.php          # Конфигурация и credentials
│
└── 💾 Database
    └── database.sql        # Схема БД (users, sessions, logs)
```

---

## 📖 Пошаговая настройка

### 🌟 Шаг 1: Google Cloud Console

<details>
<summary><b>Нажмите для раскрытия инструкций</b></summary>

1️⃣ **Создание проекта**
   - Откройте [Google Cloud Console](https://console.cloud.google.com/)
   - Нажмите **"New Project"**
   - Имя проекта: `Google Auth System`
   - Нажмите **"Create"**

2️⃣ **Активация API**
   - Меню → **"APIs & Services"** → **"Library"**
   - Найдите **"Google+ API"**
   - Нажмите **"Enable"**

3️⃣ **OAuth 2.0 Credentials**
   - Перейдите в **"Credentials"**
   - **"Create Credentials"** → **"OAuth client ID"**

4️⃣ **Consent Screen** (если требуется)
   ```
   App name:           Google Auth System
   User support:       ваш@email.com
   Developer contact:  ваш@email.com
   Type:              External
   ```

5️⃣ **Настройка Client ID**
   ```
   Application type:   Web application
   Name:              Google Auth Web Client

   Authorized JavaScript origins:
   ✓ http://localhost
   ✓ http://localhost:80

   Authorized redirect URIs:
   ✓ http://localhost/callback.php
   ✓ http://localhost:80/callback.php
   ```

6️⃣ **Сохраните credentials**
   - 📋 Client ID: `XXXXXXXXX.apps.googleusercontent.com`
   - 🔑 Client Secret: `XXXXXXXXXXXXXX`

</details>

---

### 💾 Шаг 2: База данных MySQL

<details>
<summary><b>Нажмите для раскрытия инструкций</b></summary>

**Вариант A: Командная строка**
```bash
# Войдите в MySQL
mysql -u root -p

# Импортируйте схему
mysql -u root -p < database.sql
```

**Вариант B: phpMyAdmin**
```
1. Откройте http://localhost/phpmyadmin
2. Вкладка "Import"
3. Выберите файл database.sql
4. Нажмите "Go"
```

**Проверка создания таблиц:**
```sql
USE google_auth;
SHOW TABLES;

-- Ожидаемый результат:
-- ✓ users
-- ✓ user_sessions
-- ✓ login_logs
```

</details>

---

### ⚙️ Шаг 3: Конфигурация config.php

<details>
<summary><b>Нажмите для раскрытия инструкций</b></summary>

Откройте **config.php** и заполните:

```php
// 🔑 Google OAuth Credentials
define('GOOGLE_CLIENT_ID', 'ВАШ_CLIENT_ID_ЗДЕСЬ');
define('GOOGLE_CLIENT_SECRET', 'ВАШ_CLIENT_SECRET_ЗДЕСЬ');
define('GOOGLE_REDIRECT_URI', 'http://localhost/callback.php');

// 💾 Настройки базы данных
define('DB_HOST', 'localhost');      // или '127.0.0.1'
define('DB_NAME', 'google_auth');
define('DB_USER', 'root');
define('DB_PASS', '');               // Ваш пароль MySQL

// 🔒 Безопасность
define('SESSION_LIFETIME', 3600);    // 1 час
```

</details>

---

### 🚀 Шаг 4: Запуск приложения

<details>
<summary><b>Вариант A: XAMPP/WAMP</b></summary>

```bash
# 1. Скопируйте файлы в:
C:\xampp\htdocs\google-auth\

# 2. Запустите в XAMPP Control Panel:
✓ Apache
✓ MySQL

# 3. Откройте браузер:
http://localhost/google-auth/
```

</details>

<details>
<summary><b>Вариант B: Встроенный PHP сервер</b></summary>

```bash
# 1. Перейдите в папку проекта
cd путь/к/проекту

# 2. Запустите сервер
php -S localhost:80

# 3. Откройте браузер:
http://localhost/
```

</details>

---

### ✅ Шаг 5: Тестирование

1. 🌐 Откройте `http://localhost/`
2. 🔘 Нажмите **"Войти через Google"**
3. 👤 Выберите Google аккаунт
4. ✔️ Разрешите доступ к данным
5. 🎉 Вы перенаправлены в **dashboard.php**!

---

## 🔧 Решение проблем

### ❌ Ошибка: `redirect_uri_mismatch`

```diff
Проблема: URI в config.php не совпадает с Google Console

Решение:
+ Проверьте точное совпадение URI
+ Убедитесь в правильности протокола (http/https)
+ Проверьте наличие/отсутствие слэша в конце
+ Используйте правильный порт (80, 8080, 3000)
```

---

### ❌ Ошибка: Подключение к БД

```php
// Проверьте настройки в config.php
define('DB_HOST', 'localhost');  // попробуйте '127.0.0.1'
define('DB_NAME', 'google_auth');
define('DB_USER', 'root');
define('DB_PASS', '');          // ваш пароль

// Проверьте запуск MySQL
// Windows: Диспетчер задач → Службы → MySQL
// Linux: sudo systemctl status mysql
```

---

### ❌ Ошибка: `curl_init` not found

```ini
# Откройте php.ini и раскомментируйте:
extension=curl
extension=openssl
extension=mysqli

# Перезапустите веб-сервер
```

---

### ❌ CORS Policy Error

```diff
Проблема: Блокировка браузером

Решение:
- Используйте http://localhost (не 127.0.0.1)
+ Добавьте localhost в Google Console:
  Authorized JavaScript origins
```

---

### 🐛 Белый экран на callback.php

```php
// Добавьте в начало callback.php для отладки:
<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Проверьте логи PHP:
// XAMPP: C:\xampp\apache\logs\error.log
// Linux: /var/log/apache2/error.log
```

---

## 🌐 Деплой на продакшен

### 📋 Checklist для продакшена

- [ ] ✅ Получен SSL сертификат (Let's Encrypt)
- [ ] ✅ Настроен HTTPS редирект
- [ ] ✅ Обновлен REDIRECT_URI в Google Console
- [ ] ✅ Обновлен config.php с продакшен URL
- [ ] ✅ Настроены права доступа к файлам
- [ ] ✅ Отключен display_errors в php.ini
- [ ] ✅ Включено логирование ошибок

### 🔐 Настройка в Google Console

```
Authorized JavaScript origins:
✓ https://yourdomain.com
✓ https://www.yourdomain.com

Authorized redirect URIs:
✓ https://yourdomain.com/callback.php
✓ https://www.yourdomain.com/callback.php
```

### ⚙️ Обновление config.php

```php
define('GOOGLE_REDIRECT_URI', 'https://yourdomain.com/callback.php');
define('DB_HOST', 'localhost');      // или IP вашего DB сервера
define('DB_PASS', 'СИЛЬНЫЙ_ПАРОЛЬ'); // обязательно установите пароль!
```

---

## 💾 Структура базы данных

### 📊 Таблица: `users`
Основная информация о пользователях
```sql
id              INT AUTO_INCREMENT PRIMARY KEY
google_id       VARCHAR(255) UNIQUE
email           VARCHAR(255) UNIQUE
name            VARCHAR(255)
given_name      VARCHAR(100)
family_name     VARCHAR(100)
picture         VARCHAR(500)
created_at      TIMESTAMP DEFAULT CURRENT_TIMESTAMP
last_login      TIMESTAMP
```

### 📊 Таблица: `user_sessions`
Управление активными сессиями
```sql
id              INT AUTO_INCREMENT PRIMARY KEY
user_id         INT
session_token   VARCHAR(255) UNIQUE
ip_address      VARCHAR(45)
user_agent      TEXT
created_at      TIMESTAMP
expires_at      TIMESTAMP
```

### 📊 Таблица: `login_logs`
История входов пользователей
```sql
id              INT AUTO_INCREMENT PRIMARY KEY
user_id         INT
ip_address      VARCHAR(45)
user_agent      TEXT
login_time      TIMESTAMP DEFAULT CURRENT_TIMESTAMP
```

---

## 🎨 Кастомизация интерфейса

### 🌈 Изменение цветовой схемы

```css
/* Основной градиент фона */
.gradient-background {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

/* Градиент кнопки входа */
.btn-google {
    background: linear-gradient(135deg, #4285f4 0%, #34a853 100%);
}

/* Цвет акцентов */
:root {
    --primary-color: #667eea;
    --secondary-color: #764ba2;
    --success-color: #34a853;
}
```

### 🔧 Добавление функционала в dashboard

```php
// Примеры расширения функционала:

// 1. Редактирование профиля
// 2. Загрузка аватара
// 3. Двухфакторная аутентификация
// 4. Интеграция с другими сервисами
// 5. История активности
// 6. Настройки приватности
```

---

## 🔒 Безопасность

| Защита | Реализация | Статус |
|--------|-----------|--------|
| CSRF | State parameter в OAuth | ✅ |
| SQL Injection | Prepared Statements (PDO) | ✅ |
| XSS | htmlspecialchars() | ✅ |
| Session Hijacking | IP + User-Agent validation | ✅ |
| Password Storage | N/A (OAuth only) | ✅ |

---

## 📚 Технологии

<div align="center">

![PHP](https://img.shields.io/badge/PHP-7.4+-777BB4?style=for-the-badge&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-5.7+-4479A1?style=for-the-badge&logo=mysql&logoColor=white)
![HTML5](https://img.shields.io/badge/HTML5-E34F26?style=for-the-badge&logo=html5&logoColor=white)
![CSS3](https://img.shields.io/badge/CSS3-1572B6?style=for-the-badge&logo=css3&logoColor=white)
![JavaScript](https://img.shields.io/badge/JavaScript-F7DF1E?style=for-the-badge&logo=javascript&logoColor=black)

</div>

---

## ✅ Финальный чеклист

Перед запуском убедитесь:

- [ ] 🌐 Google Cloud проект создан
- [ ] 🔑 OAuth Client ID получен
- [ ] 📋 Client ID и Secret скопированы в config.php
- [ ] 🔄 Redirect URI добавлен в Google Console
- [ ] 💾 MySQL запущен
- [ ] 🗄️ База данных `google_auth` создана
- [ ] 📊 Таблицы созданы (users, sessions, logs)
- [ ] ⚙️ config.php настроен корректно
- [ ] 🚀 Apache/PHP сервер запущен
- [ ] 🌐 Приложение открывается в браузере
- [ ] ✨ Кнопка "Войти через Google" работает

## Настройка конфигурации

Перед запуском создайте локальный `config.php` из шаблона `config.example.php`.

1. Скопируйте `config.example.php` в `config.php`.
2. Заполните доступ к БД.
3. Укажите `GOOGLE_CLIENT_ID`, `GOOGLE_CLIENT_SECRET` и `GOOGLE_REDIRECT_URI`.
4. Не коммитьте `config.php` с реальными значениями.

---

Автор: legenda  
Telegram: [@LEGENDA_SD](https://t.me/LEGENDA_SD)
