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

<?php
$id_program=$_POST['idProgram'];
    $sql="SELECT * FROM training WHERE id_program='$id_program'";
    $result=mysqli_query($db,$sql);
    $myrow=mysqli_fetch_array($result);

    $nameProgram=$myrow['name_prog'];
    $hours=$myrow['number_of_hours'];
    $price=$myrow['price'];
    $typeCertification=$myrow['type_of_certification'];
    $typeDoc=$myrow['type_of_doc'];
    $typeProgram=$myrow['type_of_program'];

    $sel1="";$sel2="";$sel3="";$sel4="";$sel5="";$sel6="";$sel7="";$sel8="";$sel9="";$sel10="";
    if($typeProgram=="Повышение квалификации") $sel1="selected";
    else if($typeProgram=="Переподготовка") $sel2="selected";

    if($typeCertification=="Тестирование") $sel3="selected";
    else if($typeCertification=="Экзамен") $sel4="selected";
    else if($typeCertification=="Зачет") $sel5="selected";
    else if($typeCertification=="ВКР") $sel6="selected";
    
    if($typeDoc=="Удостоверение") $sel7="selected";
    else if($typeDoc=="Сертификат") $sel8="selected";
    else if($typeDoc=="Диплом") $sel9="selected";
    else if($typeDoc=="Свидетельство") $sel10="selected";


echo"<div class='row about'>
    <div class='col-lg-4 col-md-4 col-sm-12'>
        <form action='#' method='post' id='#form' style='left:5%;top:0%;width:1wh;'>
        <h4>Программа №$id_program</h4>
        <label>Название программы обучения:</label>
        <input type='text' name='addNameUpd' placeholder='введите...' class='form-control' value='$nameProgram'>
        <label>Кол-во часов:</label>
        <input type='number' name='addHoursUpd' class='form-control' value='$hours'>
        <label>Вид программы обучения:</label>
        <select name='typeProgramUpd' class='form-control'>
            <option value='Повышение квалификации' $sel1>Повышение квалификации</option>
            <option value='Переподготовка' $sel2>Переподготовка</option>
        </select>    
        <label>Вид сертификации:</label>
        <select name='typeSertificationUpd' class='form-control'>
            <option value='Тестирование' $sel3>Итоговое тестирование</option>
            <option value='Экзамен' $sel4>Экзамен</option>
            <option value='Зачет' $sel5>Зачет</option>
            <option value='ВКР' $sel6>ВКР</option>
        </select>  
        <label>Вид документа об окончании:</label>
        <select name='typeDocUpd' class='form-control'>
            <option value='Удостоверение' $sel7>Удостоверение</option>
            <option value='Сертификат' $sel8>Сертификат</option>
            <option value='Диплом' $sel9>Диплом</option>
            <option value='Свидетельство' $sel10>Свидетельство</option>
            </select>
            <label>Стоимость:</label>
            <input type='number' name='addPriceUpd' placeholder='1000' class='form-control' value='$price'>
            <button type='submit' name='submit' class='btn btn-primary'>Изменить</button>
            <input type='hidden' name='idProg' value='$id_program'>
        </form>
        </div>
        <div class='col-lg-8 col-md-8 col-sm-12 desc'>";
        ?>

<?php
if(ISSET($_POST['submit'])){

    $id=$_POST['idProg'];
    $nameProgram1=$_POST['addNameUpd'];
    $hours1=$_POST['addHoursUpd'];
    $price1=$_POST['addPriceUpd'];
    $typeCertification1=$_POST['typeSertificationUpd'];
    $typeDoc1=$_POST['typeDocUpd'];
    $typeProgram1=$_POST['typeProgramUpd'];

    $sql="UPDATE `training` SET `name_prog`='$nameProgram1',
    `number_of_hours`='$hours1',`price`='$price1',`type_of_certification`='$typeCertification1',
    `type_of_doc`='$typeDoc1',`type_of_program`='$typeProgram1'
     WHERE `id_program`='$id'";
     
    $result=mysqli_query($db,$sql);
    if($result==TRUE)
    {
        echo "Данные успешно сохранены!";
        echo "<script> document.location.href = 'manager.php'</script>";
    }
    else{
        echo"Ошибка.";
    }
}
?>


</body>
</html>
