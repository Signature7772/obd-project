<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html;
charset=utf-8" />
</head>
<body>
<?php // connection.php
$db_hostname = "localhost";
$db_database = "lab1";
$db_username = "root";
$db_password = "";

try {
    // Параметри підключення до бази даних
    $dsn = "mysql:host=$db_hostname;dbname=$db_database;charset=utf8mb4";
    $pdo = new PDO($dsn, $db_username, $db_password);

    // Налаштування UTF-8 для з'єднання
    $pdo->exec("set names utf8mb4");

    // Виконання запиту до бази даних (якщо потрібно)

} catch (PDOException $e) {
    // Обробка помилок під час підключення до бази даних
    die("Помилка підключення до бази даних: " . $e->getMessage());
}
?>
</body>
</html>