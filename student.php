<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Style2.css" type="text/css">
    <link rel="stylesheet" href="css/bootstrap.css" type="text/css">
    <title>Личный кабинет студента</title>
</head>
<body>
    <?php
    include("studNav.php");
    include("db.php");
    ?>
    
    <?php
    $sql="SELECT * FROM student WHERE id_stud='$idUser'";
    $result=mysqli_query($db,$sql);
    $myrow=mysqli_fetch_array($result);

    $userName=$myrow['username'];
    $passw=$myrow['passw'];
    $lastName=$myrow['lastname'];
    $firstName=$myrow['firstname'];
    $fatherName=$myrow['fathername'];
    $birthDate=$myrow['birthdate'];
    $edu=$myrow['education'];
    $tel=$myrow['tel'];
    $email=$myrow['email'];

    echo "
    <div class='row about'>
    <div class='col-lg-4 col-md-4 col-sm-12'>
        <img align='center' src='img/student.webp' class='img-fluid'>
    </div>
    <div class='col-lg-8 col-md-8 col-sm-12 desc'>
        <form action='#' method='POST' class='form-group' style='margin-bottom: 1%;'>
        <h4>Редактирование профиля</h4>
        <input type='text' name='userName' placeholder='Логин/E-mail' class='form-control' value='$userName' required><br>
        <input type='password' name='passw' placeholder='' class='form-control' value='$passw' required><br>  
        <input type='text' name='lastName' placeholder='Фамилия' class='form-control' value='$lastName'><br>
        <input type='text' name='firstName' placeholder='Имя' class='form-control' value='$firstName'><br>
        <input type='text' name='fatherName' placeholder='Отчество' class='form-control' value='$fatherName'><br> 
        <input type='date' name='birthDate' class='form-control' value='$birthDate'><br>
        <input type='text' name='tel' placeholder='Телефон' class='form-control' value='$tel'><br>
        <input type='email' name='email' placeholder='email' class='form-control' value='$email' required><br>

        <button type='submit' name='submit' class='btn' style='background-color: blue; color: #fff;'>Сохранить изменения</button>

    </form>
    </div>";
    ?>


<?php
if(ISSET($_POST['submit'])){

    $userName=$_POST["userName"];
    $passw=$_POST["passw"];
    $lastName=$_POST["lastName"];
    $firstName=$_POST["firstName"];
    $fatherName=$_POST["fatherName"];
    $birthDate=$_POST["birthDate"];
    $tel=$_POST["tel"];
    $email=$_POST["email"];

    $sql="UPDATE student SET lastname='$lastName',firstname='$firstName',
    fathername='$fatherName',birthdate='$birthDate',
    tel='$tel',email='$email',username='$userName',passw='$passw' WHERE id_stud=$idUser";
    $result=mysqli_query($db,$sql);
    if($result==TRUE)
    {
        echo "Данные успешно сохранены!";
        echo "<script> document.location.href = 'student.php'</script>";
    }
    else{
        echo"Ошибка.";
    }
}
?>


</body>
</html>
