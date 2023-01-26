<?php

$mysqli = new mysqli('localhost', 'user', '123456', 'Inventory') or die(mysqli_error($mysqli));

$id = 0;
$update = false;
$error1 = false;
$error2 = false;

if(isset($_POST['delivery']))
{
    $NameText = $_POST['area1'];
    $adressText = $_POST['area2'];

    $mysqli->query("INSERT INTO postavshik (Name, adress) VALUES('$NameText','$adressText')") or die($mysqli->error());
    $mysqli->query("INSERT INTO postavshikhistory (Name, adress) VALUES('$NameText','$adressText')") or die($mysqli->error());
    header("location: Postavshik.php");

}

if(isset($_GET['delete']))
{
    $id = $_GET['delete'];

    $mysqli->query("DELETE FROM postavshik WHERE Id=$id") or die($mysqli->error());

    header("location: Postavshik.php");
}

if(isset($_GET['edit']))
{
    $id = $_GET['edit'];
    $update = true;
    $result = $mysqli->query("SELECT * FROM postavshik WHERE Id=$id") or die($mysqli->error());

    if ($result->num_rows){
        $row = $result->fetch_array();
        $NameText = $_POST['area1'];
        $adressText = $_POST['area2'];
    }
    
}

if(isset($_POST['save']))
{
    $id = $_POST['Id'];
    $NameText = $_POST['area1'];
    $adressText = $_POST['area2'];

    if(!empty($NameText) && !empty($adressText)) {
        $NameText = preg_replace('/[^a-zA-Zа-яА-Я]/ui', '',$NameText);
        $adressText = preg_replace('/[^a-zA-Zа-яА-Я]/ui', '',$adressText);

    if($NameText && $adressText) {
        $error1 = false;
        $error2 = false;
        $mysqli->query("UPDATE postavshik SET Name='$NameText' WHERE Id=$id") or die($mysqli->error());
        $mysqli->query("UPDATE postavshik SET adress='$adressText' WHERE Id=$id") or die($mysqli->error());
        header("location: Postavshik.php");
    }
    
    else{
        $error2 = true;
    }

}

else{
    $error1 = true;
}
    
}

?>