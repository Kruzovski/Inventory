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

<?php require_once('Display.php'); ?>
<div class="container">

<?php 
    $mysqli = new mysqli('localhost', 'user', '123456', 'Inventory') or die(mysqli_error($mysqli));
    $result = $mysqli->query("SELECT * FROM item") or die($mysqli->error());

    ?>
    
    <div class="row justify-content-center">
    <h1> ТОВАРЫ </h1>
        <table class="table">
            <thead>
                <tr>
                    <th>Название</th>
                    <th>Дата изготовления (гггг.мм.дд)</th>
                    <th>Дата истечения срока годности (гггг.мм.дд)</th>
                    <th>Цена за штуку (в рублях)</th>
                    <th>Количество на складе</th>
                    <th colspan="1">Опции</th>
                </tr>
            </thead>    
<?php
    while ($row = $result->fetch_assoc()):
?>

<tr>
<td>
    <?php echo $row ['name']?>
</td>
<td>
    <?php echo $row ['DateCreate']?>
</td>
<td>
    <?php echo $row ['DateOut']?>
</td>
<td>
    <?php echo $row ['costperone']?>
</td>
<td>
    <?php echo $row ['numbers']?>
</td>

    <td>
        <a href="Item.php?edit=<?php echo $row['id']; ?>"
        class="btn btn-info">Изменить</a>
        <a href="Display.php?delete=<?php echo $row['id']; ?>"
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
    <p2><input type="text" name="area1" value="<?php echo $name; ?>" placeholder="Название"></input></p2>
    <br>
    <p2><input type="text" name="area2" value="<?php echo $DateCreate; ?>" placeholder="Дата изготовления"></input></p2>
    <br>
    <p2><input type="text" name="area3" value="<?php echo $DateOut; ?>" placeholder="Срок годности"></input></p2>
    <br>
    <p2><input type="text" name="area4" value="<?php echo $costperone; ?>" placeholder="Цена за единицу"></input></p2>
    <br>
    <p2><input type="text" name="area5" value="<?php echo $numbers; ?>" placeholder="Количество"></input></p2>
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

<button2 onclick="document.location='http://localhost:8000/Worker.php'"><span>ДАЛЕЕ </span></button2>

<br>

<button onclick="document.location='http://localhost:8000/Index.php'">МЕНЮ</button>