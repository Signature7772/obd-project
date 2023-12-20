<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Система реєстрації та авторизації користувачів з PHP і MySQL</title>
  <link href="css/style.css" media="screen" rel="stylesheet">
  <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
</head>
<body>
  <div class="container mlogin">
    <div id="login">
      <h2>Вхід</h2>
      <form action="" id="loginform" method="post" name="loginform">
        <p><label for="username">Ім'я користувача</label></p>
        <input class="input" id="username" name="username" size="20" type="text" value="">
        <p><label for="password">Пароль</label></p>
        <input class="input" id="password" name="password" size="20" type="password" value="">
        <input class="button" name="login" type="submit" value="Войти">
        <p class="regtext">Ще не зареєстровані? <a href="register.php">Реєстрація</a></p>
      </form>
    </div>

    <?php
    session_start();
    require_once("connection.php");

    if(isset($_SESSION["session_username"])){
      header("Location: intropage.php");
    }

    if(isset($_POST["login"])){
      if(!empty($_POST['username']) && !empty($_POST['password'])) {
        $username = htmlspecialchars($_POST['username']);
        $password = htmlspecialchars($_POST['password']);
        $query = $pdo->prepare("SELECT * FROM usertbl WHERE username=:username AND password=:password");
        $query->bindParam(':username', $username);
        $query->bindParam(':password', $password);
        $query->execute();
        $numrows = $query->rowCount();

        if($numrows != 0) {
          while($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $dbusername = $row['username'];
            $dbpassword = $row['password'];
          }
          if($username == $dbusername && $password == $dbpassword) {
            $_SESSION['session_username'] = $username;
            header("Location: intropage.php");
          }
        } else {
          echo "Неправильне ім'я користувача або пароль!";
        }
      } else {
        $message = "Всі поля обов'язкові!";
      }
    }
    ?>

    <footer>
      <p>Copyright &copy; 2023</p>
    </footer>
  </div>
</body>
</html>