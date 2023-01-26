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

<?php require_once('DisplayInventoryDoc.php'); ?>
<div class="container">

<?php 
    $mysqli = new mysqli('localhost', 'user', '123456', 'Inventory') or die(mysqli_error($mysqli));
    $result = $mysqli->query("SELECT * FROM InventoryDoc") or die($mysqli->error());
?>

<?php 
if ($add == true):
?>
    <div class="row justify-content-center">

    <h1> ИНВЕНТАРНАЯ ВЕДОМОСТЬ </h1>
        <table class="table">
            <thead>
                <tr>
                    <th>Поставщик</th>
                    <th>Товар</th>
                    <th>Принимающий работник</th>
                    <th>Артикул</th>
                    <th>Дата поставки</th>
                    <th colspan="1">Опции</th>
                </tr>
            </thead>    

            <?php
                while ($row = $result->fetch_assoc()):
            ?>
<tr>

    <td>
        <?php
            $ResultDolzhnost = $mysqli->query("SELECT Name FROM postavshikhistory WHERE id =" .$row['PostavshikHistoryId']) or die($mysqli->error()); 
            $rowDolzhnost = $ResultDolzhnost->fetch_assoc();
            echo $rowDolzhnost['Name'];
        ?>
    </td>

    <td>
        <?php 
            $ResultItem = $mysqli->query("SELECT name FROM itemhistory WHERE id =" .$row['ItemHistoryId']) or die($mysqli->error()); 
            $rowItem = $ResultItem->fetch_assoc();
            echo $rowItem['name'];
        ?>
    </td>

    <td>
        <?php
            $ResultRabotnik = $mysqli->query("SELECT lastname FROM rabotnikhistory WHERE id =" .$row['RabotnikHistoryId']) or die($mysqli->error()); 
            $rowRabotnik = $ResultRabotnik->fetch_assoc();
            echo $rowRabotnik['lastname'];
        ?>
    </td>

    <td>
        <?php 
            echo $row ['Article'];
        ?>
    </td>

    <td>
        <?php 
            echo $row ['Data'];
        ?>
    </td>

        <td>
            <a href="InventoryDoc.php?edit=<?php echo $row['Id']; ?>"
            class="btn btn-info">Изменить</a>

            <a href="InventoryDoc.php?delete=<?php echo $row['Id']; ?>"
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

------------------------------

<form method="POST">
    <input type="hidden" name="Id" value="<?php echo $id; ?>">

    <?php
    $result = $mysqli->query("SELECT * FROM postavshikhistory") or die($mysqli->error());
    ?>

<p1>Поставщик:</p1>
<br>
<select name = 'postavshik'>
    
      <?php 
  		while($row = $result->fetch_assoc()):?>
  <option value = <?php echo $row ['id'] ?>> <?php echo $row ['Name'] ?> </option>
  <?php endwhile;?>
  	</select>

    <?php
    $result = $mysqli->query("SELECT * FROM itemhistory") or die($mysqli->error());
    ?>

    <br>

<p1>Товар:</p1>
<br>
<select name = 'item'>
      <?php 
  		while($row = $result->fetch_assoc()):?>
  <option value = <?php echo $row ['id'] ?>> <?php echo $row ['name'] ?> </option>
  <?php endwhile;?>
  	</select>

      <?php
    $result = $mysqli->query("SELECT * FROM rabotnikhistory") or die($mysqli->error());
    ?>

    <br>

<p1>Принимающий работник:</p1>
<br>
<select name = 'rabotnik'>
      <?php 
  		while($row = $result->fetch_assoc()):?>
  <option value = <?php echo $row ['id'] ?>> <?php echo $row ['lastname'] ?> </option>
  <?php endwhile;?>
  	</select>

      <br>
      <p1>Артикул:</p1>
      <br>

      <p2><input type="text" name="Article" value="<?php echo $Article; ?>" placeholder="Введите артикул"></input></p2>

      <br>
      <br>

    <td>
        <?php echo $row ['Date']?>
    </td>

    <input name="delivery" type="submit" value="Добавить" class="button1"></input>

    </form>    

    -----------------------------------
    <?php endif; 
?>

    <br>

<?php 
if ($delete == true):
?>

<form method="POST">
    <input type="hidden" name="id" value="<?php echo $id; ?>">

<?php
    $result = $mysqli->query("SELECT * FROM rabotnikhistory") or die($mysqli->error());
?>

<p1>Списывающий работник:</p1>
<br>
<select name = 'rabotnik2'>
      <?php 
  		while($row = $result->fetch_assoc()):?>
  <option value = <?php echo $row ['id'] ?>> <?php echo $row ['lastname'] ?> </option>
  <?php endwhile;?>
  	</select>

      <br>

    <input name="Delete2" type="submit" value="Подтвердить" class="button1"></input>

    </form>

<?php
else: 
?>

<?php endif; 
?>

<?php 
if ($update == true):
?>

<div class="row justify-content-center">

<h1> ИЗМЕНЯЕМЫЙ ПУНКТ ВЕДОМОСТИ </h1>
        <table class="table">
            <thead>
                <tr>
                    <th>Поставщик</th>
                    <th>Товар</th>
                    <th>Принимавший работник</th>
                    <th>Артикул</th>
                    <th>Дата поставки</th>
                </tr>
            </thead>

            <br>
            <br>

<?php 
$result = $mysqli->query("SELECT * FROM InventoryDoc WHERE Id='$id'") or die($mysqli->error());
?>

<tr>

    <td>
        <?php
            $ResultDolzhnost = $mysqli->query("SELECT Name FROM postavshikhistory WHERE id =" .$row['PostavshikHistoryId']) or die($mysqli->error()); 
            $rowDolzhnost = $ResultDolzhnost->fetch_assoc();
            echo $rowDolzhnost['Name'];
        ?>
    </td>

    <td>
        <?php 
            $ResultItem = $mysqli->query("SELECT name FROM itemhistory WHERE id =" .$row['ItemHistoryId']) or die($mysqli->error()); 
            $rowItem = $ResultItem->fetch_assoc();
            echo $rowItem['name'];
        ?>
    </td>

    <td>
        <?php
            $ResultRabotnik = $mysqli->query("SELECT lastname FROM rabotnikhistory WHERE id =" .$row['RabotnikHistoryId']) or die($mysqli->error()); 
            $rowRabotnik = $ResultRabotnik->fetch_assoc();
            echo $rowRabotnik['lastname'];
        ?>
    </td>

    <td>
        <?php 
            echo $row ['Article'];
        ?>
    </td>

    <td>
        <?php 
            echo $row ['Data'];
        ?>
    </td>  
</tr>

</table>
</div>

<br>
<br>

<form method="POST">
    <input type="hidden" name="id" value="<?php echo $id; ?>">

    <?php
    $result = $mysqli->query("SELECT * FROM postavshikhistory") or die($mysqli->error());
    ?>

<p1>Поставщик:</p1>
<br>
<select name = 'postavshik'>
    
      <?php 
  		while($row = $result->fetch_assoc()):?>
  <option value = <?php echo $row ['id'] ?>> <?php echo $row ['Name'] ?> </option>
  <?php endwhile;?>
  	</select>

    <?php
    $result = $mysqli->query("SELECT * FROM itemhistory") or die($mysqli->error());
    ?>

    <br>
    <br>

<p1>Товар:</p1>
<br>
<select name = 'item'>
      <?php 
  		while($row = $result->fetch_assoc()):?>
  <option value = <?php echo $row ['id'] ?>> <?php echo $row ['name'] ?> </option>
  <?php endwhile;?>
  	</select>

      <?php
    $result = $mysqli->query("SELECT * FROM rabotnikhistory") or die($mysqli->error());
    ?>

    <br>
    <br>

<p1>Принявший работник:</p1>
<br>
<select name = 'rabotnik'>
      <?php 
  		while($row = $result->fetch_assoc()):?>
  <option value = <?php echo $row ['id'] ?>> <?php echo $row ['lastname'] ?> </option>
  <?php endwhile;?>
  	</select>

      <br>
      <br>

    <?php
    $result = $mysqli->query("SELECT * FROM rabotnikhistory") or die($mysqli->error());
    ?>

<p1>Отредактировавший работник:</p1>
<br>
<select name = 'rabotnik2'>
      <?php 
  		while($row = $result->fetch_assoc()):?>
  <option value = <?php echo $row ['id'] ?>> <?php echo $row ['lastname'] ?> </option>
  <?php endwhile;?>
  	</select>

      <br>
      <br>

    <td>
        <?php echo $row ['Article']?>
    </td>

    <br>
    <br>

    <td>
        <?php echo $row ['Date']?>
    </td>

    <br>
    <br>

    <input name="save" type="submit" value="Сохранить" class="button1"></input>

    </form>    

<?php endif; 
?>

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