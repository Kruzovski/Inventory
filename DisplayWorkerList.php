<?php

$mysqli = new mysqli('localhost', 'user', '123456', 'Inventory') or die(mysqli_error($mysqli));

$id = 0;
$update = false;
$error1 = false;
$error2 = false;

if(isset($_POST['delivery']))
{
    $rabotnik = $_POST['rabotnik'];
    $dolzhnost = $_POST['spisok_dolzhnostey'];
    $stazhInt = $_POST['area1'];

    if(!empty($stazhInt)) {
        $stazhInt_validate = filter_var($stazhInt, FILTER_VALIDATE_FLOAT);

    if($stazhInt_validate) {
        $error1 = false;
        $error2 = false;
        $mysqli->query("INSERT INTO workerlist (rabotnikId, spisok_dolzhnosteyId, stazh) VALUES($rabotnik, $dolzhnost, '$stazhInt')") or die($mysqli->error());
        header("location: WorkerksList.php");
    }
    
    else{
        $error2 = true;
    }

}

else{
    $error1 = true;
}

}

if(isset($_GET['delete']))
{
    $id = $_GET['delete'];

    $mysqli->query("DELETE FROM workerlist WHERE Id=$id") or die($mysqli->error());

    header("location: WorkerksList.php");
}

if(isset($_GET['edit']))
{
    $id = $_GET['edit'];
    $update = true;
    $result = $mysqli->query("SELECT * FROM workerlist WHERE Id=$id") or die($mysqli->error());

    if ($result->num_rows){
        $row = $result->fetch_array();
        $rabotnik = $_POST['rabotnik'];
        $dolzhnost = $_POST['spisok_dolzhnostey'];
        $stazhInt = $_POST['area1'];
    }
    
}

if(isset($_POST['save']))
{
    $id = $_POST['Id'];
    $rabotnik = $_POST['rabotnik'];
    $dolzhnost = $_POST['spisok_dolzhnostey'];
    $stazhInt = $_POST['area1'];

    if(!empty($stazhInt)) {
        $stazhInt_validate = filter_var($stazhInt, FILTER_VALIDATE_FLOAT);

    if($stazhInt_validate) {
        $error1 = false;
        $error2 = false;
        $mysqli->query("UPDATE workerlist SET rabotnikId='$rabotnik' WHERE Id=$id") or die($mysqli->error());
        $mysqli->query("UPDATE workerlist SET spisok_dolzhnosteyId='$dolzhnost' WHERE Id=$id") or die($mysqli->error());
        $mysqli->query("UPDATE workerlist SET stazh='$stazhInt' WHERE Id=$id") or die($mysqli->error());
        header("location: WorkerksList.php");
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