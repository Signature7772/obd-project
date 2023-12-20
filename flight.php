<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Інформація про політ</title>
	<link href="css/style.css" media="screen" rel="stylesheet">
  <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
</head>
<body>
    <center>
        <h2>Інформація про політ</h2>
        <!-- Форма для вставки даних -->
        <form method="POST">
            <input type="text" name="place_departure" placeholder="Місце відправлення" required>
            <input type="text" name="place_arrival" placeholder="Місце прибуття" required>
            <input type="datetime-local" name="date_departure" required>
            <input type="datetime-local" name="date_arrival" required>
            <input type="submit" name="insert" value="Додати">
        </form>

        <!-- Форма для оновлення даних -->
        <form method="POST">
            <input type="number" name="id" placeholder="ID для оновлення" required>
            <input type="text" name="place_departure" placeholder="Нове місце відправлення" required>
            <input type="text" name="place_arrival" placeholder="Нове місце прибуття" required>
            <input type="datetime-local" name="date_departure" required>
            <input type="datetime-local" name="date_arrival" required>
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
                $place_departure = $_POST['place_departure'];
                $place_arrival = $_POST['place_arrival'];
                $date_departure = $_POST['date_departure'];
                $date_arrival = $_POST['date_arrival'];
                $insertQuery = "INSERT INTO flight (place_departure, place_arrival, date_departure, date_arrival) VALUES (:place_departure, :place_arrival, :date_departure, :date_arrival)";
                $stmt = $pdo->prepare($insertQuery);
                $stmt->execute(['place_departure' => $place_departure, 'place_arrival' => $place_arrival, 'date_departure' => $date_departure, 'date_arrival' => $date_arrival]);
            }

            // Операція UPDATE
            if (isset($_POST['update'])) {
                $id = $_POST['id'];
                $place_departure = $_POST['place_departure'];
                $place_arrival = $_POST['place_arrival'];
                $date_departure = $_POST['date_departure'];
                $date_arrival = $_POST['date_arrival'];
                $updateQuery = "UPDATE flight SET place_departure=:place_departure, place_arrival=:place_arrival, date_departure=:date_departure, date_arrival=:date_arrival WHERE id=:id";
                $stmt = $pdo->prepare($updateQuery);
                $stmt->execute(['place_departure' => $place_departure, 'place_arrival' => $place_arrival, 'date_departure' => $date_departure, 'date_arrival' => $date_arrival, 'id' => $id]);
            }

            // Операція DELETE
            if (isset($_POST['delete'])) {
                $id = $_POST['id'];
                $deleteQuery = "DELETE FROM flight WHERE id=:id";
                $stmt = $pdo->prepare($deleteQuery);
                $stmt->execute(['id' => $id]);
            }

            // Виведення таблиці
            $query = "SELECT * FROM flight";
            $statement = $pdo->query($query);

            echo "<table border='1'>";
            echo "<tr><th>Flight ID</th><th>Place Departure</th><th>Place Arrival</th><th>Date Departure</th><th>Date Departure</th></tr>";

            while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>";
                echo "<td>".$row["id"]."</td><td>".$row["place_departure"]."</td><td>".$row["place_arrival"]."</td><td>".$row["date_departure"]."</td><td>".$row["date_arrival"]."</td>";
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