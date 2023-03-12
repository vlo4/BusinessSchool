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
    include("db.php");
    ?>
<div class="col-lg-8 col-md-8 col-sm-12 desc">

<?php
$sql="SELECT education.id_edu,education.status,education.date_of_z,training.name_prog, CONCAT(lastname,' ',firstname) AS FIO
FROM `education` 
INNER JOIN training ON training.id_program=education.id_program
INNER JOIN student ON student.id_stud=education.id_stud
WHERE education.status=1";

$result=mysqli_query($db,$sql);
echo "<h4><a href=manOrders.php>Необработанные заявки</a> | Принятые заявки | 
<a href=manOrders3.php>Отклоненные заявки</a></h4>";
echo "<table class='table table-bordered table-sm'>
<tr class='table-primary'><th>№</th><th>ФИО студента</th><th>Название программы</th>
<th>Дата заявки</th><th>Статус</th>";

while($myrow=mysqli_fetch_array($result))
{
echo "<tr>";
echo "<td>".$myrow['id_edu']."</td>";
echo "<td>".$myrow['FIO']."</td>";
echo "<td>".$myrow['name_prog']."</td>";
echo "<td>".$myrow['date_of_z']."</td>";
echo "<td>Принято</td>";

echo "<input type='hidden' name='idEduc' value='".$myrow['id_edu']."'></form>";
echo "</tr>";
}
echo "</table>";
?>


</body>
</html>
