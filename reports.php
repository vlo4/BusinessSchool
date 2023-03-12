<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Личный кабинет менеджера</title>
</head>
<body>
    <?php
    include("manNav.php");
    session_start();
    include("db.php");

    echo "<div class='row about'>
    <div class='col-lg-4 col-md-4 col-sm-12 desc'>
        <form method='post' action=''>
            <label for='rb1'>Выбор отчета:</label>
            <div class='form-check'>
                <input class='form-check-input' type='radio' name='rb1' value='1' id='rb1'>
                <label class='form-check-label' for='rb1'>
                    Рейтинг программ обучения</label>
            </div>
            <div class='form-check'>
                <input class='form-check-input' type='radio' name='rb1' value='2' id='rb1'>
                <label class='form-check-label' for='rb1'>
                    Рейтинг слушателей</label>
            </div>
            <button type='submit' name='submit' class='btn btn-primary'>Просмотр</button>
        </form>
    </div>
    <div class='col-lg-8 col-md-8 col-sm-12 desc'>";
    ?>

<?php 
if(ISSET($_POST['submit']))
{
    $n=$_POST['rb1'];

    if($n==1)
    {
        $sql="SELECT training.name_prog, training.type_of_program, training.price,
         COUNT(education.id_edu) AS kol, SUM(training.price) AS summ
        FROM `training` 
        INNER JOIN education ON training.id_program=education.id_program
        GROUP BY training.name_prog, training.type_of_program, training.price
        ORDER BY COUNT(education.id_edu) DESC";

        $result=mysqli_query($db,$sql);
        echo "<h4>Рейтинг программ обучения</h4>";

        echo "<table class='table table-bordered table-sm'>
        <tr class='table-primary'><th>Программа обучения</th><th>Вид программы</th><th>Стоимость за ед.</th>
        <th>Кол-во слушателей</th><th>На сумму</th><th></th>";
        $sum=0;
        $count=0;
        while($myrow=mysqli_fetch_array($result))
        {
            $sum+=$myrow['summ'];
            $count+=$myrow['kol'];

            echo "<tr>";
            echo "<td>".$myrow['name_prog']."</td>";
            echo "<td>".$myrow['type_of_program']."</td>";
            echo "<td>".$myrow['price']."</td>";
            echo "<td>".$myrow['kol']."</td>";
            echo "<td>".$myrow['summ']."</td>";
            echo "<tr>";
        }

        echo "<tr>";
        echo "<td></td><td></td><td><b>Итого:</b></td>
        <td><b>$count</b></td><td><b>$sum</b></td>";
        echo "</tr>";
        echo "</table>";
    }

    if($n==2)
    {
        $sql="SELECT CONCAT(student.lastname,' ',student.firstname) AS FIO,
         COUNT(education.id_edu) AS kol, SUM(training.price) AS summ
        FROM `training` 
        INNER JOIN education ON training.id_program=education.id_program
        INNER JOIN student ON education.id_stud=student.id_stud
        GROUP BY CONCAT(student.lastname,' ',student.firstname)
        ORDER BY COUNT(education.id_edu) DESC";

        $result=mysqli_query($db,$sql);
        echo "<h4>Рейтинг слушателей</h4>";

        echo "<table class='table table-bordered table-sm'>
        <tr class='table-primary'><th>ФИО слушателя</th>
        <th>Кол-во программ</th><th>На сумму</th><th></th>";
        $sum=0;
        $count=0;
        while($myrow=mysqli_fetch_array($result))
        {
            $sum+=$myrow['summ'];
            $count+=$myrow['kol'];

            echo "<tr>";
            echo "<td>".$myrow['FIO']."</td>";
            echo "<td>".$myrow['kol']."</td>";
            echo "<td>".$myrow['summ']."</td>";
            echo "<tr>";
        }

        echo "<tr>";
        echo "<td><b>Итого:</b></td>
        <td><b>$count</b></td><td><b>$sum</b></td>";
        echo "</tr>";
        echo "</table>";
    }
}



?>

</body>
</html>
