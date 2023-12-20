<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Інформація про квитки</title>
	<link href="css/style.css" media="screen" rel="stylesheet">
  <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
</head>
<body>
    <center>
        <h2>Інформація про квитки</h2>
        <!-- Форма для вставки даних -->
        <form method="POST">
            <input type="text" name="number" placeholder="Номер квитка" required>
            <input type="text" name="price" placeholder="Ціна" required>
            <input type="text" name="date" placeholder="Дата" required>
            <input type="text" name="pass_id" placeholder="ID пасажира" required>
            <input type="text" name="flight_id" placeholder="ID рейсу" required>
            <input type="submit" name="insert" value="Додати">
        </form>

        <!-- Форма для оновлення даних -->
        <form method="POST">
            <input type="text" name="number" placeholder="Номер квитка для оновлення" required>
            <input type="text" name="price" placeholder="Нова ціна" required>
            <input type="text" name="date" placeholder="Нова дата" required>
            <input type="text" name="pass_id" placeholder="Новий ID пасажира" required>
            <input type="text" name="flight_id" placeholder="Новий ID рейсу" required>
            <input type="submit" name="update" value="Оновити">
        </form>

        <!-- Форма для видалення даних -->
        <form method="POST">
            <input type="text" name="number" placeholder="Номер квитка для видалення" required>
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
                $number = $_POST['number'];
                $price = $_POST['price'];
                $date = $_POST['date'];
                $pass_id = $_POST['pass_id'];
                $flight_id = $_POST['flight_id'];
                $insertQuery = "INSERT INTO tickets (number, price, date, pass_id, flight_id) VALUES (:number, :price, :date, :pass_id, :flight_id)";
                $stmt = $pdo->prepare($insertQuery);
                $stmt->execute(['number' => $number, 'price' => $price, 'date' => $date, 'pass_id' => $pass_id, 'flight_id' => $flight_id]);
            }

            // Операція UPDATE
            if (isset($_POST['update'])) {
                $number = $_POST['number'];
                $price = $_POST['price'];
                $date = $_POST['date'];
                $pass_id = $_POST['pass_id'];
                $flight_id = $_POST['flight_id'];
                $updateQuery = "UPDATE tickets SET price=:price, date=:date, pass_id=:pass_id, flight_id=:flight_id WHERE number=:number";
                $stmt = $pdo->prepare($updateQuery);
                $stmt->execute(['price' => $price, 'date' => $date, 'pass_id' => $pass_id, 'flight_id' => $flight_id, 'number' => $number]);
            }

            // Операція DELETE
            if (isset($_POST['delete'])) {
                $number = $_POST['number'];
                $deleteQuery = "DELETE FROM tickets WHERE number=:number";
                $stmt = $pdo->prepare($deleteQuery);
                $stmt->execute(['number' => $number]);
            }

            // Виведення таблиці
            $query = "SELECT * FROM tickets";
            $statement = $pdo->query($query);

            echo "<table border='1'>";
            echo "<tr><th>Tickets Number ID</th><th>Price</th><th>Date</th><th>Pass_ID</th><th>Flight_ID</th></tr>";

            while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>";
                echo "<td>".$row["number"]."</td><td>".$row["price"]."</td><td>".$row["date"]."</td><td>".$row["pass_id"]."</td><td>".$row["flight_id"]."</td>";
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