<?php
session_start();
include("db.php");
$idProgram=$_POST['idProgram'];
$idStud=$_SESSION['id_stud'];
$ordersDate=date("Y-m-d");
$status=0;

$query="INSERT INTO education(id_stud,id_program,date_of_z,status)
VALUES ($idStud,$idProgram,'$ordersDate',$status)";
$result=mysqli_query($db,$query);
if($result==TRUE)
    {
        echo "Ваша заявка добавлена";
        echo "<script> document.location.href = 'orders.php'</script>";
    }
    else{
        echo"Ошибка!";
    }
?>
