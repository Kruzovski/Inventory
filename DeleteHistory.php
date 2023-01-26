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

<div class="container">

<?php 
    $mysqli = new mysqli('localhost', 'user', '123456', 'Inventory') or die(mysqli_error($mysqli));
    $result = $mysqli->query("SELECT * FROM addhistory") or die($mysqli->error());
?>

<div class="row justify-content-center">
    <h1> ИСТОРИЯ ПРИНЯТИЯ ТОВАРА </h1>
        <table class="table">
            <thead>
                <tr>
                    <th>Поставщик</th>
                    <th>Товар</th>
                    <th>Принявший работник</th>
                    <th>Дата принятия</th>
                </tr>
            </thead>    

            <?php
                while ($row = $result->fetch_assoc()):
            ?>
<tr>

    <td>
        <?php
            $ResultDolzhnost = $mysqli->query("SELECT Name FROM postavshik WHERE Id =" .$row['postavshikId']) or die($mysqli->error()); 
            $rowDolzhnost = $ResultDolzhnost->fetch_assoc();
            echo $rowDolzhnost['Name'];
        ?>
    </td>

    <td>
        <?php 
            $ResultLastname = $mysqli->query("SELECT name FROM item WHERE id =" .$row['itemId']) or die($mysqli->error()); 
            $rowLastName = $ResultLastname->fetch_assoc();
            echo $rowLastName['name'];
        ?>
    </td>

    <td>
        <?php
            $ResultDolzhnost = $mysqli->query("SELECT lastname FROM rabotnik WHERE id =" .$row['rabotnikId']) or die($mysqli->error()); 
            $rowDolzhnost = $ResultDolzhnost->fetch_assoc();
            echo $rowDolzhnost['lastname'];
        ?>
    </td>

    <td>
        <?php 
            echo $row ['Data'];
        ?>
    </td>
</tr>
<?php endwhile;?>

</table>
</div>

<br>

<?php 
    $result = $mysqli->query("SELECT * FROM updatehistory") or die($mysqli->error());
?>

<div class="row justify-content-center">
    <h1> ИСТОРИЯ ИЗМЕНЕНИЯ ТОВАРА </h1>
        <table class="table">
            <thead>
                <tr>
                    <th>Поставщик</th>
                    <th>Товар</th>
                    <th>Изменивший работник</th>
                    <th>Дата изменения</th>
                </tr>
            </thead>    

            <?php
                while ($row = $result->fetch_assoc()):
            ?>
<tr>

    <td>
        <?php
            $ResultDolzhnost = $mysqli->query("SELECT Name FROM postavshik WHERE Id =" .$row['postavshikId']) or die($mysqli->error()); 
            $rowDolzhnost = $ResultDolzhnost->fetch_assoc();
            echo $rowDolzhnost['Name'];
        ?>
    </td>

    <td>
        <?php 
            $ResultLastname = $mysqli->query("SELECT name FROM item WHERE id =" .$row['itemId']) or die($mysqli->error()); 
            $rowLastName = $ResultLastname->fetch_assoc();
            echo $rowLastName['name'];
        ?>
    </td>

    <td>
        <?php
            $ResultDolzhnost = $mysqli->query("SELECT lastname FROM rabotnik WHERE id =" .$row['rabotnikId']) or die($mysqli->error()); 
            $rowDolzhnost = $ResultDolzhnost->fetch_assoc();
            echo $rowDolzhnost['lastname'];
        ?>
    </td>

    <td>
        <?php 
            echo $row ['Data'];
        ?>
    </td>
</tr>
<?php endwhile;?>

</table>
</div>

<br>

<?php 
    $result = $mysqli->query("SELECT * FROM deletehistory") or die($mysqli->error());
?>
    
    <div class="row justify-content-center">
    <h1> ИСТОРИЯ СПИСАНИЙ ТОВАРА </h1>
        <table class="table">
            <thead>
                <tr>
                    <th>Поставщик</th>
                    <th>Товар</th>
                    <th>Списавший работник</th>
                    <th>Дата списания</th>
                </tr>
            </thead>    

            <?php
                while ($row = $result->fetch_assoc()):
            ?>
<tr>

    <td>
        <?php
            $ResultDolzhnost = $mysqli->query("SELECT Name FROM postavshik WHERE Id =" .$row['postavshikId']) or die($mysqli->error()); 
            $rowDolzhnost = $ResultDolzhnost->fetch_assoc();
            echo $rowDolzhnost['Name'];
        ?>
    </td>

    <td>
        <?php 
            $ResultLastname = $mysqli->query("SELECT name FROM item WHERE id =" .$row['itemId']) or die($mysqli->error()); 
            $rowLastName = $ResultLastname->fetch_assoc();
            echo $rowLastName['name'];
        ?>
    </td>

    <td>
        <?php
            $ResultDolzhnost = $mysqli->query("SELECT lastname FROM rabotnik WHERE id =" .$row['rabotnikId']) or die($mysqli->error()); 
            $rowDolzhnost = $ResultDolzhnost->fetch_assoc();
            echo $rowDolzhnost['lastname'];
        ?>
    </td>

    <td>
        <?php 
            echo $row ['Data'];
        ?>
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

</br>



<button onclick="document.location='http://localhost:8000/Index.php'">МЕНЮ</button>