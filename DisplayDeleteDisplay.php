<?php

$mysqli = new mysqli('localhost', 'user', '123456', 'Inventory') or die(mysqli_error($mysqli));

$id = 0;
$update = false;
$error1 = false;
$error2 = false;

if(isset($_POST['delivery']))
{
    $postavshik = $_POST['postavshik'];
    $item = $_POST['item'];
    $rabotnik = $_POST['rabotnik'];
    $DataDate = date('Y-m-d');

    $mysqli->query("INSERT INTO inventorydoc (postavshikId, itemId, rabotnikId, Data) VALUES($postavshik, $item, $rabotnik, $DataDate)") or die($mysqli->error());
    header("location: InventoryDoc.php");

}

if(isset($_GET['delete']))
{
    $id = $_GET['delete'];

    $mysqli->query("DELETE FROM inventorydoc WHERE id=$id") or die($mysqli->error());

    header("location: InventoryDoc.php");
}

if(isset($_GET['edit']))
{
    $id = $_GET['edit'];
    $update = true;
    $result = $mysqli->query("SELECT * FROM inventorydoc WHERE Id=$id") or die($mysqli->error());

    if ($result->num_rows){
        $row = $result->fetch_array();
        $postavshik = $_POST['postavshik'];
        $item = $_POST['item'];
        $rabotnik = $_POST['rabotnik'];
    }
    
}

if(isset($_POST['save']))
{
    $id = $_POST['Id'];
    $postavshik = $_POST['postavshik'];
    $item = $_POST['item'];
    $rabotnik = $_POST['rabotnik'];

    $mysqli->query("UPDATE inventorydoc SET postavshikId='$postavshik' WHERE Id=$id") or die($mysqli->error());
    $mysqli->query("UPDATE inventorydoc SET itemId='$item' WHERE Id=$id") or die($mysqli->error());
    $mysqli->query("UPDATE inventorydoc SET rabotnikId='$rabotnik' WHERE Id=$id") or die($mysqli->error());
    header("location: InventoryDoc.php");

}

?>