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

<?php require_once('DisplayWorker.php'); ?>
<div class="container">

<?php 
    $mysqli = new mysqli('localhost', 'user', '123456', 'Inventory') or die(mysqli_error($mysqli));
    $result = $mysqli->query("SELECT * FROM rabotnik") or die($mysqli->error());

    ?>
    
<div class="row justify-content-center">
    <h1> РАБОТНИК </h1>
        <table class="table">
            <thead>
                <tr>
                    <th>Фамилия</th>
                    <th>Имя</th>
                    <th>Отчество</th>
                    <th>Дата Рождения</th>
                    <th>Зарплата</th>
                    <th colspan="1">Опции</th>
                </tr>
            </thead>    
        <?php
            while ($row = $result->fetch_assoc()):
        ?>

        <tr>
            <td>
                <?php echo $row ['lastname']?>
            </td>

            <td>
                <?php echo $row ['Firstname']?>
            </td>

            <td>
                <?php echo $row ['Othername']?>
            </td>

            <td>
                <?php echo $row ['DOB']?>
            </td>
            
            <td>
                <?php echo $row ['Payment']?>
            </td>

            <td>
                <a href="Worker.php?edit=<?php echo $row['id']; ?>"
                class="btn btn-info">Изменить</a>
                <a href="DisplayWorker.php?delete=<?php echo $row['id']; ?>"
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
    <p2><input type="text" name="area1" value="<?php echo $lastname; ?>" placeholder="Фамилия"></input></p2>
    <br>
    <p2><input type="text" name="area2" value="<?php echo $Firstname; ?>" placeholder="Имя"></input></p2>
    <br>
    <p2><input type="text" name="area3" value="<?php echo $Othername; ?>" placeholder="Отчество"></input></p2>
    <br>
    <p2><input type="text" name="area4" value="<?php echo $DOB; ?>" placeholder="ДР (гггг.мм.дд)"></input></p2>
    <br>
    <p2><input type="text" name="area5" value="<?php echo $Payment; ?>" placeholder="Зарплата"></input></p2>
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

<button2 onclick="document.location='http://localhost:8000/InventoryDoc.php'"><span>ДАЛЕЕ </span></button2>

</br>

<button onclick="document.location='http://localhost:8000/Index.php'">МЕНЮ</button>