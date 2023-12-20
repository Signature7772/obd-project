<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Інформація про авіакомпанії</title>
	<link href="css/style.css" media="screen" rel="stylesheet">
  <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
</head>
<body>
    <center>
        <h2>Інформація про авіакомпанії</h2>
        <!-- Форма для вставки даних -->
        <form method="POST">
            <input type="text" name="country" placeholder="Країна" required>
            <input type="text" name="address" placeholder="Адреса" required>
            <input type="submit" name="insert" value="Додати">
        </form>

        <!-- Форма для оновлення даних -->
        <form method="POST">
            <input type="number" name="id" placeholder="ID для оновлення" required>
            <input type="text" name="country" placeholder="Нова країна" required>
            <input type="text" name="address" placeholder="Нова адреса" required>
            <input type="submit" name="update" value="Оновити">
        </form>

        <!-- Форма для видалення даних -->
        <form method="POST">
            <input type="number" name="id" placeholder="ID для видалення" required>
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
                $country = $_POST['country'];
                $address = $_POST['address'];
                $insertQuery = "INSERT INTO airline (country, address) VALUES (:country, :address)";
                $stmt = $pdo->prepare($insertQuery);
                $stmt->execute(['country' => $country, 'address' => $address]);
            }

            // Операція UPDATE
            if (isset($_POST['update'])) {
                $id = $_POST['id'];
                $country = $_POST['country'];
                $address = $_POST['address'];
                $updateQuery = "UPDATE airline SET country=:country, address=:address WHERE id=:id";
                $stmt = $pdo->prepare($updateQuery);
                $stmt->execute(['country' => $country, 'address' => $address, 'id' => $id]);
            }

            // Операція DELETE
            if (isset($_POST['delete'])) {
                $id = $_POST['id'];
                $deleteQuery = "DELETE FROM airline WHERE id=:id";
                $stmt = $pdo->prepare($deleteQuery);
                $stmt->execute(['id' => $id]);
            }

            // Виведення таблиці
            $query = "SELECT * FROM airline";
            $statement = $pdo->query($query);

            echo "<table border='1'>";
            echo "<tr><th>Airline ID</th><th>Airline Country</th><th>Airline Address</th></tr>";

            while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>";
                echo "<td>".$row["id"]."</td><td>".$row["country"]."</td><td>".$row["address"]."</td>";
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