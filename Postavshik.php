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

<?php require_once('DisplayPostavshik.php'); ?>
<div class="container">

<?php 
    $mysqli = new mysqli('localhost', 'user', '123456', 'Inventory') or die(mysqli_error($mysqli));
    $result = $mysqli->query("SELECT * FROM postavshik") or die($mysqli->error());

    ?>
    
    <div class="row justify-content-center">
    <h1> ПОСТАВЩИКИ </h1>
        <table class="table">
            <thead>
                <tr>
                    <th>Имя компании</th>
                    <th>Адресс</th>
                    <th colspan="1">Опции</th>
                </tr>
            </thead>    
            <?php
                while ($row = $result->fetch_assoc()):
            ?>

            <tr>
            <td>
                <?php echo $row ['Name']?>
            </td>
            <td>
                <?php echo $row ['adress']?>
            </td>

                <td>
                    <a href="Postavshik.php?edit=<?php echo $row['Id']; ?>"
                    class="btn btn-info">Изменить</a>
                    <a href="DisplayPostavshik.php?delete=<?php echo $row['Id']; ?>"
                    class="btn btn-danger">Удалить</a>
                </td>   
            </tr>

            <?php endwhile;
            ?>
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
<p2><input type="text" name="area1" value="<?php echo $Name; ?>" placeholder="Название поставщика"></input></p2>
<br>
<p2><input type="text" name="area2" value="<?php echo $adress; ?>" placeholder="Адрес поставщика"></input></p2>
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

<br>

<button2 onclick="document.location='http://localhost:8000/Item.php'"><span>ДАЛЕЕ </span></button2>

<br>

<button onclick="document.location='http://localhost:8000/Index.php'">МЕНЮ</button>