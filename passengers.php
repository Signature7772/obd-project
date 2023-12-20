<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Інформація про пасажирів</title>
	<link href="css/style.css" media="screen" rel="stylesheet">
  <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
</head>
<body>
    <center>
        <h2>Інформація про пасажирів</h2>
        <!-- Форма для вставки даних -->
        <form method="POST">
            <input type="text" name="pass" placeholder="Паспорт" required>
            <input type="text" name="name" placeholder="Ім'я" required>
            <input type="text" name="phone" placeholder="Номер телефону" required>
            <input type="submit" name="insert" value="Додати">
        </form>

        <!-- Форма для оновлення даних -->
        <form method="POST">
            <input type="text" name="pass" placeholder="Паспорт для оновлення" required>
            <input type="text" name="name" placeholder="Нове ім'я" required>
            <input type="text" name="phone" placeholder="Новий номер телефону" required>
            <input type="submit" name="update" value="Оновити">
        </form>

        <!-- Форма для видалення даних -->
        <form method="POST">
            <input type="text" name="pass" placeholder="Паспорт для видалення" required>
            <input type="submit" name="delete" value="Видалити">
        </form>
        <?php
        // Підключення до бази даних через PDO
        require_once 'connection.php';

        try {
            $dsn = "mysql:host=$db_hostname;dbname=$db_database;charset=utf8mb4";
            $pdo = new PDO($dsn, $db_username, $db_password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Операція INSERT
            if (isset($_POST['insert'])) {
                $pass = $_POST['pass'];
                $name = $_POST['name'];
                $phone = $_POST['phone'];
                $insertQuery = "INSERT INTO passengers (pass, name, phone) VALUES (:pass, :name, :phone)";
                $stmt = $pdo->prepare($insertQuery);
                $stmt->execute(['pass' => $pass, 'name' => $name, 'phone' => $phone]);
            }

            // Операція UPDATE
            if (isset($_POST['update'])) {
                $pass = $_POST['pass'];
                $name = $_POST['name'];
                $phone = $_POST['phone'];
                $updateQuery = "UPDATE passengers SET name=:name, phone=:phone WHERE pass=:pass";
                $stmt = $pdo->prepare($updateQuery);
                $stmt->execute(['name' => $name, 'phone' => $phone, 'pass' => $pass]);
            }

            // Операція DELETE
            if (isset($_POST['delete'])) {
                $pass = $_POST['pass'];
                $deleteQuery = "DELETE FROM passengers WHERE pass=:pass";
                $stmt = $pdo->prepare($deleteQuery);
                $stmt->execute(['pass' => $pass]);
            }

            // Виведення таблиці
            $query = "SELECT * FROM passengers";
            $statement = $pdo->query($query);

            echo "<table border='1'>";
            echo "<tr><th>Passport</th><th>Name</th><th>Phone Number</th></tr>";

            while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>";
                echo "<td>".$row["pass"]."</td><td>".$row["name"]."</td><td>".$row["phone"]."</td>";
                echo "</tr>";
            }

            echo "</table>";

        } catch (PDOException $e) {
            die("Помилка: " . $e->getMessage());
        }

        $pdo = null; // Закриття з'єднання з базою даних
        ?>
    </center>
</body>
</html>
