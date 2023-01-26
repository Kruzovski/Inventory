<?php

$mysqli = new mysqli('localhost', 'user', '123456', 'Inventory') or die(mysqli_error($mysqli));

$id = 0;
$update = false;
$error1 = false;
$error2 = false;

if(isset($_POST['delivery']))
{
    $lastnameText = $_POST['area1'];
    $FirstnameText = $_POST['area2'];
    $OthernameText = $_POST['area3'];
    $DOBDate = $_POST['area4'];
    $PaymentFloat = $_POST['area5'];

    if(!empty($lastnameText) && !empty($FirstnameText) && !empty($DOBDate) && !empty($PaymentFloat)) {
        $lastnameText = preg_replace('/[^a-zA-Zа-яА-Я]/ui', '',$lastnameText);
        $FirstnameText = preg_replace('/[^a-zA-Zа-яА-Я]/ui', '',$FirstnameText);
        $OthernameText = preg_replace('/[^a-zA-Zа-яА-Я]/ui', '',$OthernameText); 
        $PaymentFloat_validate = filter_var($PaymentFloat, FILTER_VALIDATE_FLOAT);

    if($lastnameText && $FirstnameText && $PaymentFloat_validate) {
        $error1 = false;
        $error2 = false;
        $mysqli->query("INSERT INTO rabotnik (lastname, Firstname,  Othername, DOB, Payment) VALUES('$lastnameText','$FirstnameText', '$OthernameText','$DOBDate', '$PaymentFloat')") or die($mysqli->error());
        $mysqli->query("INSERT INTO RabotnikHistory (lastname, Firstname,  Othername, DOB, Payment) VALUES('$lastnameText','$FirstnameText', '$OthernameText','$DOBDate', '$PaymentFloat')") or die($mysqli->error());
        header("location: Worker.php");
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

    $mysqli->query("DELETE FROM rabotnik WHERE id=$id") or die($mysqli->error());

    header("location: Worker.php");
}

if(isset($_GET['edit']))
{
    $id = $_GET['edit'];
    $update = true;
    $result = $mysqli->query("SELECT * FROM rabotnik WHERE id=$id") or die($mysqli->error());

    if ($result->num_rows){
        $row = $result->fetch_array();
        $lastnameText = $row['lastname'];
        $FirstnameText = $row['Firstname'];
        $OthernameText = $row['Othername'];
        $DOBDate = $row['DOBDate'];
        $PaymentFloat = $row['Payment'];
    }
    
}

if(isset($_POST['save']))
{
    $id = $_POST['id'];
    $lastnameText = $_POST['area1'];
    $FirstnameText = $_POST['area2'];
    $OthernameText = $_POST['area3'];
    $DOBDate = $_POST['area4'];
    $PaymentFloat = $_POST['area5'];

    if(!empty($lastnameText) && !empty($FirstnameText) && !empty($DOBDate) && !empty($PaymentFloat)) {
        $lastnameText = preg_replace('/[^a-zA-Zа-яА-Я]/ui', '',$lastnameText);
        $FirstnameText = preg_replace('/[^a-zA-Zа-яА-Я]/ui', '',$FirstnameText);
        $OthernameText = preg_replace('/[^a-zA-Zа-яА-Я]/ui', '',$OthernameText);
        $PaymentFloat_validate = filter_var($PaymentFloat, FILTER_VALIDATE_FLOAT);

    if($lastnameText && $FirstnameText && $PaymentFloat_validate) {
        $error1 = false;
        $error2 = false;
        $mysqli->query("UPDATE rabotnik SET lastname='$lastnameText' WHERE id=$id") or die($mysqli->error());
        $mysqli->query("UPDATE rabotnik SET Firstname='$FirstnameText' WHERE id=$id") or die($mysqli->error());
        $mysqli->query("UPDATE rabotnik SET Othername='$OthernameText' WHERE id=$id") or die($mysqli->error());
        $mysqli->query("UPDATE rabotnik SET DOB='$DOBDate' WHERE id=$id") or die($mysqli->error());
        $mysqli->query("UPDATE rabotnik SET Payment='$PaymentFloat' WHERE id=$id") or die($mysqli->error());
        header("location: Worker.php");
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