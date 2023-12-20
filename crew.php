<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Інформація про екіпаж</title>
	<link href="css/style.css" media="screen" rel="stylesheet">
  <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
</head>
<body>
    <center>
        <h2>Інформація про екіпаж</h2>
        <!-- Форма для вставки даних -->
        <form method="POST">
            <input type="text" name="position" placeholder="Посада" required>
            <input type="number" name="airline_id" placeholder="ID авіакомпанії" required>
            <input type="number" name="flight_id" placeholder="ID рейсу" required>
            <input type="submit" name="insert" value="Додати">
        </form>

        <!-- Форма для оновлення даних -->
        <form method="POST">
            <input type="number" name="id" placeholder="ID для оновлення" required>
            <input type="text" name="position" placeholder="Нова посада" required>
            <input type="number" name="airline_id" placeholder="Новий ID авіакомпанії" required>
            <input type="number" name="flight_id" placeholder="Новий ID рейсу" required>
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
                $position = $_POST['position'];
                $airline_id = $_POST['airline_id'];
                $flight_id = $_POST['flight_id'];
                $insertQuery = "INSERT INTO crew (position, airline_id, flight_id) VALUES (:position, :airline_id, :flight_id)";
                $stmt = $pdo->prepare($insertQuery);
                $stmt->execute(['position' => $position, 'airline_id' => $airline_id, 'flight_id' => $flight_id]);
            }

            // Операція UPDATE
            if (isset($_POST['update'])) {
                $id = $_POST['id'];
                $position = $_POST['position'];
                $airline_id = $_POST['airline_id'];
                $flight_id = $_POST['flight_id'];
                $updateQuery = "UPDATE crew SET position=:position, airline_id=:airline_id, flight_id=:flight_id WHERE id=:id";
                $stmt = $pdo->prepare($updateQuery);
                $stmt->execute(['position' => $position, 'airline_id' => $airline_id, 'flight_id' => $flight_id, 'id' => $id]);
            }

            // Операція DELETE
            if (isset($_POST['delete'])) {
                $id = $_POST['id'];
                $deleteQuery = "DELETE FROM crew WHERE id=:id";
                $stmt = $pdo->prepare($deleteQuery);
                $stmt->execute(['id' => $id]);
            }

            // Виведення таблиці
            $query = "SELECT * FROM crew";
            $statement = $pdo->query($query);

            echo "<table border='1'>";
            echo "<tr><th>Crew ID</th><th>Crew Position</th><th>Crew Airline_ID</th><th>Crew Flight_ID</th></tr>";

            while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>";
                echo "<td>".$row["id"]."</td><td>".$row["position"]."</td><td>".$row["airline_id"]."</td><td>".$row["flight_id"]."</td>";
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