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

<?php require_once('DisplayRangs.php'); ?>
<div class="container">

<?php 
    $mysqli = new mysqli('localhost', 'user', '123456', 'Inventory') or die(mysqli_error($mysqli));
    $result = $mysqli->query("SELECT * FROM spisok_dolzhnostey") or die($mysqli->error());

    ?>
    
    <div class="row justify-content-center">
    <h1> СПИСОК ДОЛЖНОСТЕЙ </h1>
        <table class="table">
            <thead>
                <tr>
                    <th>Должность</th>
                    <th colspan="1">Опции</th>
                </tr>
            </thead>    
<?php
    while ($row = $result->fetch_assoc()):
?>

<tr>
<td>
    <?php echo $row ['dolzhnost']?>
</td>

    <td>
        <a href="RangList.php?edit=<?php echo $row['id']; ?>"
        class="btn btn-info">Изменить</a>
        <a href="DisplayRangs.php?delete=<?php echo $row['id']; ?>"
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
    <input type="hidden" name="id" value="<?php echo $id; ?>">
<p2><input type="text" name="area1" value="<?php echo $dolzhnost; ?>" placeholder="Должность"></input></p2>
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

<button onclick="document.location='http://localhost:8000/Index.php'">МЕНЮ</button>