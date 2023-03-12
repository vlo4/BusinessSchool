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
WHERE education.status=0";

$result=mysqli_query($db,$sql);
echo "<h4>Необработанные заявки | 
<a href=manOrders2.php>Принятые заявки</a> | 
<a href=manOrders3.php>Отклоненные заявки</a></h4>";
echo "<table class='table table-bordered table-sm'>
<tr class='table-primary'><th>№</th><th>ФИО студента</th><th>Название программы</th>
<th>Дата заявки</th><th>Статус</th><th></th>";

while($myrow=mysqli_fetch_array($result))
{
echo "<tr>";
echo "<td>".$myrow['id_edu']."</td>";
echo "<td>".$myrow['FIO']."</td>";
echo "<td>".$myrow['name_prog']."</td>";
echo "<td>".$myrow['date_of_z']."</td>";
echo "<td>Рассматривается</td>";

echo "<td><button type='button' name='submit' value=' '  class='btn btn-danger ' data-toggle='modal' data-target='#myModal' 
data-order='".$myrow['id_edu']."'  data-fio='".$myrow['FIO']."' data-name='".$myrow['name_prog']."' >Обработать</button></td>";

echo "<input type='hidden' name='idEduc' value='".$myrow['id_edu']."'></form>";
echo "</tr>";
}
echo "</table>";
?>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!-- Вызов модального окна -->

 <div id="myModal" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <!-- Заголовок модального окна -->
      <div class="modal-header">
        <h4 class="modal-title">Изменить статус заявки</h4>
      </div>
      <!-- Основное содержимое модального окна -->
       <div class="modal-body">  
         <form  method="post"  action="">
      
<?php

  echo '<div class="form-group"><label for="fio">Студент:</label><br><input type="text" id="fio" name="fio" readonly class="form-control"></div>';
  echo '<div class="form-group"><label for="name">Программа обучения:<input type="text" id="name" name="name" readonly class="form-control"></div>'; 
  echo '<div class="form-check">
  <input class="form-check-input" type="radio" name="rb1" value="1" id="rb1">
  <label class="form-check-label" for="rb1">
   Принять заявку
  </label>
</div>
<div class="form-check">
  <input class="form-check-input" type="radio" name="rb1" value="2" id="rb1">
  <label class="form-check-label" for="rb1">
  Отклонить заявку
  </label>
</div>';
//скрытое поле для хранения id заявки
echo '<br><input type="hidden" id="idEdu" name="idEducation">'; 

?>
</div>
<!-- Футер модального окна -->
 <div class="modal-footer">
 <button type="button" class="close" data-dismiss="modal" 
aria-hidden="true"> Закрыть</button>
 <button type="submit" name="change" class="btn btn-primary"> Изменить статус</button>
</form>
 </div>
</div>
</div>

<script>
$(document).ready(function(){
  $('#myModal').on('show.bs.modal', function (event) {
// кнопка, которая вызывает модаль
 var button = $(event.relatedTarget);
// получим  data-idEdu атрибут
  var idEdu = button.data('order');
// получим  data-fio атрибут
  var fio = button.data('fio');
  var name = button.data('name');
   // Здесь изменяем содержимое модали
  var modal = $(this);
 modal.find('.modal-title').text('Заявка на обучение № '+idEdu);
 modal.find('.modal-body #idEdu').val(idEdu);
 modal.find('.modal-body #fio').val(fio);
 modal.find('.modal-body #name').val(name);
})
});
</script>


<?php
if(ISSET($_POST['change']))
{
$status=$_POST['rb1'];
$idEducation=$_POST['idEducation'];

$sql2="UPDATE `education` SET `status`=$status WHERE `id_edu`=$idEducation";

$result=mysqli_query($db,$sql2);
if($result==TRUE)
{
  echo "Данные успешно сохранены!";
  echo "<script> document.location.href='manOrders.php'</script>";
}
else{
echo "Ошибка";
}
}
?>


</body>
</html>
