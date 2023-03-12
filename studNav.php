<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Личный кабинет студента</title>
    <link rel="stylesheet" href="Style2.css" type="text/css">
    <link rel="stylesheet" href="css/bootstrap.css" type="text/css">
</head>
<body>
<nav class="navbar navbar-expand-lg brown_panel">
        <a class="navbar-brand" href="#">Личный кабинет студента</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse"
       data-target="#navbarSupportedContent"
       aria-controls="navbarSupportedContent" aria-expanded="false"
       aria-label="Toggle Navigation">
       <span class="navbar-toggler-icon"></span>
       </button>
       <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-4">
            <li class="nav-item">
                <a class="nav-link" href="student.php">Профиль</a>
            </li>

            <li class="nav-item active">
                <a class="nav-link" href="program.php">Программы обучения<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="orders.php">Мои заявки</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="Index.html">Выход</a>
            </li>
        </ul>
       </div>
       </nav>

       <div>
       <?php
       $idUser=$_SESSION['id_stud'];
       $userName=$_SESSION['username'];
       echo "<h4 class='heading'>Добро пожаловать, пользователь $userName, ID=$idUser</h4>";
       ?>
       </div>
</body>
</html>
