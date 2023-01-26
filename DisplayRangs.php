<?php

$mysqli = new mysqli('localhost', 'user', '123456', 'Inventory') or die(mysqli_error($mysqli));

$id = 0;
$update = false;
$error1 = false;
$error2 = false;

if(isset($_POST['delivery']))
{
    $dolzhnostText = $_POST['area1'];

    if(!empty($dolzhnostText)) {
        $dolzhnostText = preg_replace('/[^a-zA-Zа-яА-Я]/ui', '',$dolzhnostText);

    if($dolzhnostText) {
        $error1 = false;
        $error2 = false;
        $mysqli->query("INSERT INTO spisok_dolzhnostey (dolzhnost) VALUES('$dolzhnostText')") or die($mysqli->error());
        header("location: RangList.php");
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

    $mysqli->query("DELETE FROM spisok_dolzhnostey WHERE id=$id") or die($mysqli->error());

    header("location: RangList.php");
}

if(isset($_GET['edit']))
{
    $id = $_GET['edit'];
    $update = true;
    $result = $mysqli->query("SELECT * FROM spisok_dolzhnostey WHERE id=$id") or die($mysqli->error());

    if ($result->num_rows){
        $row = $result->fetch_array();
        $dolzhnostText = $row['dolzhnost'];
    }
    
}

if(isset($_POST['save']))
{
    $id = $_POST['id'];
    $dolzhnostText = $_POST['area1'];

    if(!empty($dolzhnostText)) {
        $dolzhnostText = preg_replace('/[^a-zA-Zа-яА-Я]/ui', '',$dolzhnostText);

    if($dolzhnostText) {
        $error1 = false;
        $error2 = false;
        $mysqli->query("UPDATE spisok_dolzhnostey SET dolzhnost='$dolzhnostText' WHERE id=$id") or die($mysqli->error());
        header("location: RangList.php");
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