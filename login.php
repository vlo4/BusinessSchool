<?php
session_start();
?>

<?php
        if(ISSET($_POST['submit']))
       {
    $email=$_POST['email'];
    $passw=$_POST['pass'];
    if(empty($email) or empty($passw))
    {
        exit("Вы ввели не всю информацию");
    }
    include("db.php");
    if($_POST['action']=="signup")
    {
        $query="SELECT * FROM student WHERE username='$email' OR email='$email'";
        $result=mysqli_query($db,$query);
        $myrow=mysqli_fetch_array($result);
        if(!empty($myrow['id_stud']))
        {
            exit("Извините, пользователь с таким email уже существует");
        }
        $query="INSERT INTO student(email,username,passw) VALUES ('$email','$email','$passw')";
        $result=mysqli_query($db,$query);

        if($result==TRUE)
        {
            echo "Вы успешно зарегистрированы. Теперь Вы можете авторизироваться и перейти в личный кабинет";
            $_SESSION['username']=$email;
            $query="SELECT max(id_stud) AS id_stud FROM student";
            $result=mysqli_query($db,$query);
            $myrow=mysqli_fetch_array($result);
            $_SESSION['id_stud']=$myrow['id_stud'];
            echo "<script> document.location.href = 'student.php'</script>";
        }
        else {echo ("Ошибка регистрации");}
    }

    if($_POST['action']=="signin"){
        $query="SELECT * FROM student WHERE username='$email' OR email='$email'";
        $result=mysqli_query($db,$query);
        $myrow=mysqli_fetch_array($result);
        if(empty($myrow['username']))
        {
            exit("Извините, пользователь с таким email/логином не зарегистирован");
        }
        else{
            if($myrow['passw']==$passw)
            {
                echo "Вы успешно вошли";
                $_SESSION['username']=$myrow['username'];
                $_SESSION['id_stud']=$myrow['id_stud'];
                if($_SESSION['username']=="manager"){
                    echo "<script> document.location.href = 'manager.php'</script>";
                }
                else{echo "<script> document.location.href = 'student.php'</script>";}
            }else{exit("Пароль неверный");}
        }
    }
}


?>
