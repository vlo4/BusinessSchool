<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Программы обучения</title>
</head>
<body>
<?php
include("studNav.php");
include("db.php");
?>
<div class="row about">
    <div class="col-lg-4 col-md-4 col-sm-12">
        <form action="" method="POST" id="#form" style="left:5%;top:0%;width:1wh;">
        <h4>Фильтрация данных</h4>
        <input type="checkbox" name="chb1" value="1">По названию
        <input type="text" name="searchName" placeholder="Название программы" class="form-control"> 
        <input type="checkbox" name="chb2" value="2">Вид
        <select name="typeProgram" value="Вид" class="form-control">
            <option value="Повышение квалификации">Повышение квалификации</option>
            <option value="Переподготовка">Переподготовка</option>
        </select>
        <input type="checkbox" name="chb3" value="3">  Макс.стоимость
        <input type="number" name="searchPrice" placeholder="1000" class="form-control"> 
        <button type="submit" class="btn btn-primary">Search</button>
        <button type="submit" class="btn btn-primary">Clear</button>
    </form>
    </div>
    <div class="col-lg-8 col-md-8 col-sm-12 desc">


<?php
$sql="SELECT * FROM training";
$result=mysqli_query($db,$sql);
echo "<h4>Выбор программы обучения</h4>";
echo "<table class='table table-bordered table-sm'>
<tr class='table-primary'><th>Номер</th><th>Название</th><th>Кол-во час</th><th>Вид программы</th>
<th>Цена</th><th></th>";

function show($row){
    echo "<tr>";
        echo "<td>".$row['id_program']."</td>";
        echo "<td>".$row['name_prog']."</td>";
        echo "<td>".$row['number_of_hours']."</td>";
        echo "<td>".$row['type_of_program']."</td>";
        echo "<td>".$row['price']."</td>";
        echo"<td> <form method='post'>
    <button type='submit' class='btn btn-primary' formaction='submitOrders.php'>Записаться</button>
    </td>";
    echo "<input type='hidden' name='idProgram' value='".$row['id_program']."'></form>";
    echo "</tr>";
}

while($myrow=mysqli_fetch_array($result))
{
    
    if(ISSET($_POST['chb1'])|| ISSET($_POST['chb2'])||ISSET($_POST['chb3']))
    {
        $name=$_POST['searchName'];
        $type=explode("_",$_POST['typeProgram']);
        $type1=$type[0];
        $price=$_POST['searchPrice'];

    if(ISSET($_POST['chb1']) && ISSET($_POST['chb2'])&& IS_NULL($_POST['chb3']))
    {
    if($myrow['name_prog']==$name){
        if($myrow['type_of_program']==$type1){
            show($myrow);
        }
    }}

    if(ISSET($_POST['chb1'])&& ISSET($_POST['chb3'])&& IS_NULL($_POST['chb2'])){
        if($myrow['name_prog']==$name){
            if($myrow['price']<$price){
                show($myrow);
            }
        }
        }
        if(ISSET($_POST['chb1'])&& IS_NULL($_POST['chb2'])&& IS_NULL($_POST['chb3']))
        {
            if($myrow['name_prog']==$name){
                show($myrow);} } 

if(ISSET($_POST['chb2'])&& IS_NULL($_POST['chb1'])&& IS_NULL($_POST['chb3'])){
    if($myrow['type_of_program']==$type1){
        show($myrow);}
}

if(ISSET($_POST['chb3'])&& IS_NULL($_POST['chb1'])&& IS_NULL($_POST['chb2'])){
    if($myrow['price']<$price){
        show($myrow);
        }
}

if(ISSET($_POST['chb2'])&& ISSET($_POST['chb3'])&& IS_NULL($_POST['chb1'])){
    if($myrow['type_of_program']==$type1){
        if($myrow['price']<$price){
            show($myrow);
    }
}
}

if(ISSET($_POST['chb1'])&& ISSET($_POST['chb2'])&& ISSET($_POST['chb3'])){
    
    if($myrow['type_of_program']==$type1){
        if($myrow['price']<$price){
        if($myrow['name_prog']==$name){
            show($myrow);
    }
}
}
}

    }
    else{
        echo "<tr>";
        echo "<td>".$myrow['id_program']."</td>";
        echo "<td>".$myrow['name_prog']."</td>";
        echo "<td>".$myrow['number_of_hours']."</td>";
        echo "<td>".$myrow['type_of_program']."</td>";
        echo "<td>".$myrow['price']."</td>";
        echo"<td> <form method='post'>
    <button type='submit' class='btn btn-primary' formaction='submitOrders.php'>Записаться</button>
    </td>";
    echo "<input type='hidden' name='idProgram' value='".$myrow['id_program']."'></form>";
    echo "</tr>";
    }
}
echo "</table>";

?>
</div>
</div>
</body>
</html>
