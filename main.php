<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Головна сторінка</title>
    <link href="css/style.css" media="screen" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
</head>
<body>
    <center>
        <h1>Головна сторінка</h1>
        <?php
        session_start();
        if(isset($_SESSION["session_username"])){
            echo '<a href="airline.php">Перейти на сторінку з інформацією про авіакомпанії</a><br>';
            echo '<a href="crew.php">Перейти на сторінку з інформацією про екіпаж</a><br>';
            echo '<a href="flight.php">Перейти на сторінку з інформацією про політ</a><br>';
            echo '<a href="passengers.php">Перейти на сторінку з інформацією про пасажирів</a><br>';
            echo '<a href="tickets.php">Перейти на сторінку з інформацією про квитки</a><br>';
        } else {
            echo '<p>Будь ласка, <a href="login.php">увійдіть</a>, щоб переглянути вміст.</p>';
        }
        ?>
    </center>
</body>
</html>