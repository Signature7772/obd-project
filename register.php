<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
  <title>Реєстрація користувача</title>
  <link href="css/style.css" media="screen" rel="stylesheet">
  <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
</head>
<body>
  <div class="container">
    <div class="header">
      <h1>Реєстрація</h1>
    </div>
    <form action="register.php" method="post" name="registerform">
      <p><label for="full_name">Повне ім'я:</label><input class="input" id="full_name" name="full_name" size="20" type="text" value=""></p>
      <p><label for="email">E-mail:</label><input class="input" id="email" name="email" size="32" type="email" value=""></p>
      <p><label for="username">Ім'я користувача:</label><input class="input" id="username" name="username" size="20" type="text" value=""></p>
      <p><label for="password">Пароль:</label><input class="input" id="password" name="password" size="32" type="password" value=""></p>
      <p><input class="button" id="register" name="register" type="submit" value="Зареєструватися"></p>
    </form>
    <div class="footer">
      <p class="regtext">Вже зареєстровані? <a href="login.php">Увійдіть</a></p>
    </div>
  </div>

  <?php
    if(isset($_POST["register"])){
      if(!empty($_POST['full_name']) && !empty($_POST['email']) && !empty($_POST['username']) && !empty($_POST['password'])) {
        // Параметри підключення до бази даних
        $db_hostname = "localhost";
        $db_database = "lab1";
        $db_username = "root";
        $db_password = "";

        try {
          $dsn = "mysql:host=$db_hostname;dbname=$db_database;charset=utf8mb4";
          $pdo = new PDO($dsn, $db_username, $db_password);
          $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

          $full_name = htmlspecialchars($_POST['full_name']);
          $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
          $username = htmlspecialchars($_POST['username']);
          $password = htmlspecialchars($_POST['password']);

          $query = $pdo->prepare("SELECT * FROM usertbl WHERE username=:username");
          $query->bindParam(':username', $username);
          $query->execute();
          $numrows = $query->rowCount();

          if ($numrows == 0) {
            $sql = "INSERT INTO usertbl (full_name, email, username, password) VALUES(:full_name, :email, :username, :password)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':full_name', $full_name);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':password', $password);

            if ($stmt->execute()) {
              $message = "Аккаунт успішно створено";
            } else {
              $message = "Не вдалося вставити дані!";
            }
          } else {
            $message = "Такий користувач вже існує. Будь ласка, спробуйте інше ім'я!";
          }
        } catch (PDOException $e) {
          die("Помилка: " . $e->getMessage());
        }
      } else {
        $message = "Всі поля обов'язкові для заповнення!";
      }
    }
  ?>

  <?php if (!empty($message)) { echo "<p class='error'>Повідомлення: " . $message . "</p>"; } ?>

</body>
</html>