<?php
include("studNav.php");
include("db.php");
$sql="SELECT `id_edu`, `id_program.name_prog`, `date_of_z`, `date_of_begin`, 
`date_of_close`, `payment`, `n_doc`, `status` FROM `education` WHERE id_stud=$idUser";
$sql="SELECT * FROM education WHERE id_stud=$idUser";



$result=mysqli_query($db,$sql);
echo "<h4>Мои заявки</h4>";
echo "<table class='table table-bordered table-sm'>
<tr class='table-primary'><th>ID</th><th>Название</th><th>Дата заявки</th><th>Статус заявки</th>
<th>Начало обучения</th><th>Дата окончания</th><th>№ документа</th>";
while($myrow=mysqli_fetch_array($result))
{
    echo "<tr>";
    echo "<td>".$myrow['id_stud']."</td>";

    $prog=$myrow['id_program'];
    $sql2="SELECT `name_prog` FROM `training` WHERE `id_program`=$prog";
    $result2=mysqli_query($db,$sql2);
    $myrow2=mysqli_fetch_array($result2);
    echo "<td>".$myrow2['name_prog']."</td>";
    echo "<td>".$myrow['date_of_z']."</td>";
    echo "<td>".$myrow['status']."</td>";
    echo "<td>".$myrow['date_of_begin']."</td>";
    echo "<td>".$myrow['date_of_close']."</td>";
    echo "<td>".$myrow['n_doc']."</td>";
    echo "</tr>";
}
echo "</table>";
?>
