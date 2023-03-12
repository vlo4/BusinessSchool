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
    
    <div class="row about">
    <div class="col-lg-4 col-md-4 col-sm-12">
        <form action="" method="post" id="#form" style="left:5%;top:0%;width:1wh;">
        <h4>Новая запись</h4>
        <label>Название программы обучения:</label>
        <input type="text" name="addName" placeholder="введите..." class="form-control">
        <label>Кол-во часов:</label>
        <input type="number" name="addHours" value="0" class="form-control">
        <label>Вид программы обучения:</label>
        <select name="typeProgram" vlaue="Вид" class="form-control">
            <option value="Повышение квалификации">Повышение квалификации</option>
            <option value="Переподготовка">Переподготовка</option>
        </select>    
        <label>Вид сертификации:</label>
        <select name="typeSertification" vlaue="Вид" class="form-control">
            <option value="Тестирование">Итоговое тестирование</option>
            <option value="Экзамен">Экзамен</option>
            <option value="Зачет">Зачет</option>
            <option value="ВКР">ВКР</option>
        </select>  
        <label>Вид документа об окончании:</label>
        <select name="typeDoc" vlaue="Вид" class="form-control">
            <option value="Удостоверение">Удостоверение</option>
            <option value="Сертификат">Сертификат</option>
            <option value="Диплом">Диплом</option>
            <option value="Свидетельство">Свидетельство</option>
            </select>
            <label>Стоимость:</label>
            <input type="number" name="addPrice" placeholder="1000" class="form-control">
            <button type="submit" name="submit" class="btn btn-primary">Добавить</button>
        </form>
        </div>
        <div class="col-lg-8 col-md-8 col-sm-12 desc">


        <?php
        $page=1;
        $kol=5;
        $first=0;
        if(isset($_GET['page']))
        {
            $page=$_GET['page'];
        } else {$page=1;}
        $first=($page*$kol)-$kol;
        $sql="SELECT COUNT(*) FROM training";
        $result=mysqli_query($db,$sql);
        $row=mysqli_fetch_row($result);
        $total=$row[0];
        $str_page=ceil($total/$kol);

$sql="SELECT * FROM training LIMIT $first, $kol";
$result=mysqli_query($db,$sql);
echo "<h4>Программы обучения</h4>";
echo "<table class='table table-bordered table-sm'>
<tr class='table-primary'><th>Номер</th><th>Название</th><th>Кол-во час</th><th>Вид программы</th>
<th>Цена</th><th></th>";

for($i=1; $i<=$str_page;$i++)
echo "<a href=manager.php?page=".$i.">Страница ".$i."</a>"."|";

while($myrow=mysqli_fetch_array($result))
{
echo "<tr>";
echo "<td>".$myrow['id_program']."</td>";
echo "<td>".$myrow['name_prog']."</td>";
echo "<td>".$myrow['number_of_hours']."</td>";
echo "<td>".$myrow['type_of_program']."</td>";
echo "<td>".$myrow['price']."</td>";
echo"<td> <form method='post'>
<button type='submit' class='btn btn-primary' formaction='submitUpd.php'>Изменить</button>
</td>";
echo "<input type='hidden' name='idProgram' value='".$myrow['id_program']."'></form>";
echo "</tr>";

}
echo "</table>";
?>


        <?php
        if(ISSET($_POST['submit']))
        {
            $nameProgram=$_POST['addName'];
            $hours=$_POST['addHours'];
            $price=$_POST['addPrice'];
            $typeCertification=$_POST['typeSertification'];
            $typeDoc=$_POST['typeDoc'];
            $typeProgram=$_POST['typeProgram'];

            $sql="INSERT INTO `training`(`name_prog`,
             `number_of_hours`, `price`, `type_of_certification`, `type_of_doc`, `type_of_program`)
              VALUES ('$nameProgram','$hours','$price','$typeCertification','$typeDoc','$typeProgram')";
              $result=mysqli_query($db,$sql);
              if($result==TRUE)
              {
                echo "Данные успешно сохранены!";
                echo "<script> document.location.href='manager.php'</script>";
              }
              else{
                echo "Ошибка";
              }
        }
        ?>

        


      
</body>
</html>
