<?php

$mysqli = new mysqli('localhost', 'user', '123456', 'Inventory') or die(mysqli_error($mysqli));

$id = 0;
$add = true;
$delete = false;
$update = false;
$error1 = false;
$error2 = false;

if(isset($_POST['delivery']))
{
    $postavshik = $_POST['postavshik'];
    $item = $_POST['item'];
    $rabotnik = $_POST['rabotnik'];
    $article = $_POST['Article'];
    $DataDate = date('Y-m-d');

    $mysqli->query("INSERT INTO addhistory (PostavshikHistoryId, ItemHistoryId, RabotnikHistoryId, Article, Data) VALUES($postavshik, $item, $rabotnik, $article, '$DataDate')") or die($mysqli->error());
    $mysqli->query("INSERT INTO inventorydoc (PostavshikHistoryId, ItemHistoryId, RabotnikHistoryId, Article, Data) VALUES($postavshik, $item, $rabotnik, $article, '$DataDate')") or die($mysqli->error());
    header("location: InventoryDoc.php");

}

if(isset($_GET['delete']))
{
    $id = $_GET['delete'];

    $mysqli->query("SELECT PostavshikHistoryId, ItemHistoryId FROM inventorydoc");

    $add = false;
    $delete = true;
}

if(isset($_POST['Delete2']))
{
    $id = $_POST['id'];
    $rabotnik2 = $_POST['rabotnik2'];
    $DataDate = date('Y-m-d');

    $mysqli->query("INSERT INTO deletehistory (PostavshikHistoryId, ItemHistoryId, RabotnikHistoryId, Article, Data) SELECT PostavshikHistoryId, ItemHistoryId, RabotnikHistoryId, Article, Data FROM inventorydoc WHERE Id=$id");
    $result = $mysqli->query("SELECT Id FROM deletehistory ORDER BY Id DESC LIMIT 1");
    $result = $result->fetch_array();

    $IdDelete = $result['Id'];

    $mysqli->query("UPDATE deletehistory SET RabotnikHistoryId='$rabotnik2', Data='$DataDate' WHERE Id=$IdDelete") or die($mysqli->error());
    $mysqli->query("DELETE FROM InventoryDoc WHERE Id=$id") or die($mysqli->error());

    header("location: InventoryDoc.php");

}

if(isset($_GET['edit']))
{
    $id = $_GET['edit'];
    $add = false;
    $update = true;
    $result = $mysqli->query("SELECT * FROM InventoryDoc WHERE Id=$id") or die($mysqli->error());

    if ($result->num_rows){
        $row = $result->fetch_array();
        $postavshik = $_POST['postavshik'];
        $item = $_POST['item'];
        $rabotnik = $_POST['rabotnik'];
        $article = $_POST['Article'];
    }

}

if(isset($_POST['save']))
{
    $id = $_POST['id'];
    $postavshik = $_POST['postavshik'];
    $item = $_POST['item'];
    $rabotnik = $_POST['rabotnik'];
    $article = $_POST['Article'];
    $rabotnik2 = $_POST['rabotnik2'];
    $DataDate = date('Y-m-d');

    $mysqli->query("UPDATE InventoryDoc SET PostavshikHistoryId='$postavshik' WHERE Id=$id") or die($mysqli->error());
    $mysqli->query("UPDATE InventoryDoc SET ItemHistoryId='$item' WHERE Id=$id") or die($mysqli->error());
    $mysqli->query("UPDATE InventoryDoc SET RabotnikHistoryId='$rabotnik' WHERE Id=$id") or die($mysqli->error());

    $mysqli->query("INSERT INTO UpdateHistory (PostavshikHistoryId, ItemHistoryId, RabotnikHistoryId, Article, Data) SELECT PostavshikHistoryId, ItemHistoryId, RabotnikHistoryId, Article, Data FROM InventoryDoc WHERE id=$id");

    $result = $mysqli->query("SELECT Id FROM UpdateHistory ORDER BY Id DESC LIMIT 1");
    $result = $result->fetch_array();

    $IdUpdate = $result['Id'];

    $mysqli->query("UPDATE UpdateHistory SET RabotnikHistoryId='$rabotnik2', Data='$DataDate' WHERE Id=$IdUpdate") or die($mysqli->error());

    header("location: InventoryDoc.php");

}

?>