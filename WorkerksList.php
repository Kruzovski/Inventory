<!DOCTYPE html>
<html>
<head>
<title>ID</title>
<meta charset="utf-8">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> 
<link rel="stylesheet" href="ProjectStyle.css" type="text/css"/>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>

<?php require_once('DisplayWorkerList.php'); ?>
<div class="container">

<?php 
    $mysqli = new mysqli('localhost', 'user', '123456', 'Inventory') or die(mysqli_error($mysqli));
    $result = $mysqli->query("SELECT * FROM workerlist") or die($mysqli->error());
?>
    
    <div class="row justify-content-center">
    <h1> СПИСОК РАБОТНИКОВ </h1>
        <table class="table">
            <thead>
                <tr>
                    <th>Работник</th>
                    <th>Должность</th>
                    <th>Стаж (в годах)</th>
                    <th colspan="1">Опции</th>
                </tr>
            </thead>    

            <?php
                while ($row = $result->fetch_assoc()):
            ?>
<tr>
    <td>
        <?php 
            $ResultLastname = $mysqli->query("SELECT lastname FROM rabotnik WHERE id =" .$row['rabotnikId']) or die($mysqli->error()); 
            $rowLastName = $ResultLastname->fetch_assoc();
            echo $rowLastName['lastname'];
        ?>
    </td>

    <td>
        <?php
            $ResultDolzhnost = $mysqli->query("SELECT dolzhnost FROM spisok_dolzhnostey WHERE id =" .$row['spisok_dolzhnosteyId']) or die($mysqli->error()); 
            $rowDolzhnost = $ResultDolzhnost->fetch_assoc();
            echo $rowDolzhnost['dolzhnost'];
        ?>
    </td>

    <td>
        <?php 
            echo $row ['stazh'];
        ?>
    </td>

        <td>
            <a href="WorkerksList.php?edit=<?php echo $row['Id']; ?>"
            class="btn btn-info">Изменить</a>

            <a href="DisplayWorkerList.php?delete=<?php echo $row['Id']; ?>"
            class="btn btn-danger">Удалить</a>
        </td>   
</tr>
<?php endwhile;?>

</table>
</div>

<?php     
    function pre_r( $array ) {
        echo '<pre>';
        print_r($array);
        echo '</pre>';
    }

?>

<form method="POST">
    <input type="hidden" name="Id" value="<?php echo $id; ?>">

    <?php
    $result = $mysqli->query("SELECT * FROM rabotnik") or die($mysqli->error());
    ?>

<p1>Работник:</p1>
<br>
<select name = 'rabotnik'>
    
      <?php 
  		while($row = $result->fetch_assoc()):?>
  <option value = <?php echo $row ['id'] ?>> <?php echo $row ['lastname'] ?> </option>
  <?php endwhile;?>
  	</select>

    <?php
    $result = $mysqli->query("SELECT * FROM spisok_dolzhnostey") or die($mysqli->error());
    ?>

    <br>

<p1>Должность:</p1>
<br>
<select name = 'spisok_dolzhnostey'>
      <?php 
  		while($row = $result->fetch_assoc()):?>
  <option value = <?php echo $row ['id'] ?>> <?php echo $row ['dolzhnost'] ?> </option>
  <?php endwhile;?>
  	</select>

      <br>
      <br>

<p2><input type="text" name="area1" value="<?php echo $stazh; ?>" placeholder="Стаж (в годах)"></input></p2>

    <br>
      <br>

<?php 
if ($update == true):
?>
    <input name="save" type="submit" value="Сохранить" class="button1"></input>

<?php
else: ?>

<input name="delivery" type="submit" value="Добавить" class="button1"></input>
<?php endif; ?>
</form>

<?php 
if ($error1 == true):
?>
<div class="status alert alert-success">Нужно заполнить все поля для ввода </div>
<?php endif; ?>
<?php 
if ($error2 == true):
?>
<div class="status alert alert-success">Нужно ввести данные в корректном формате </div>
<?php endif; ?>

</br>

<button onclick="document.location='http://localhost:8000/Index.php'">МЕНЮ</button>