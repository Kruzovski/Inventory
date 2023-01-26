<?php

$mysqli = new mysqli('localhost', 'user', '123456', 'Inventory') or die(mysqli_error($mysqli));

$id = 0;
$update = false;
$error1 = false;
$error2 = false;

if(isset($_POST['delivery']))
{
    $nameText = $_POST['area1'];
    $DateCreateDate = $_POST['area2'];
    $DateOutDate = $_POST['area3'];
    $сostperoneInt = $_POST['area4'];
    $numbersInt = $_POST['area5'];

    if(!empty($nameText) && !empty($DateCreateDate) && !empty($DateOutDate) && !empty($сostperoneInt) && !empty($numbersInt)) {
        $DateCreateDate = preg_replace('/[^0-9\.]/u', '',$DateCreateDate);
        $DateOutDate = preg_replace('/[^0-9\.]/u', '',$DateOutDate);
        $сostperoneInt_validate = filter_var($сostperoneInt, FILTER_VALIDATE_FLOAT);
        $numbersInt_validate = filter_var($numbersInt, FILTER_VALIDATE_FLOAT);

    if($nameText && $DateCreateDate && $DateOutDate && $numbersInt_validate && $сostperoneInt_validate) {
        $error1 = false;
        $error2 = false;
        $mysqli->query("INSERT INTO item (name, DateCreate, DateOut, costperone, numbers) VALUES('$nameText','$DateCreateDate', '$DateOutDate', '$сostperoneInt','$numbersInt')") or die($mysqli->error());
        $mysqli->query("INSERT INTO ItemHistory (name, DateCreate, DateOut, costperone, numbers) VALUES('$nameText','$DateCreateDate', '$DateOutDate', '$сostperoneInt','$numbersInt')") or die($mysqli->error());
        header("location: Item.php");
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

    $mysqli->query("DELETE FROM item WHERE id=$id") or die($mysqli->error());

    header("location: Item.php");
}

if(isset($_GET['edit']))
{
    $id = $_GET['edit'];
    $update = true;
    $result = $mysqli->query("SELECT * FROM item WHERE id=$id") or die($mysqli->error());

    if ($result->num_rows){
        $row = $result->fetch_array();
        $name = $row['name'];
        $DateCreateDate = $row['DateCreate'];
        $DateOutDate = $row['DateOut'];
        $costperone = $row['costperone'];
        $numbers = $row['numbers'];
    }
    
}

if(isset($_POST['save']))
{
    $nameText = $_POST['area1'];
    $DateCreateDate = $_POST['area2'];
    $DateOutDate = $_POST['area3'];
    $сostperoneInt = $_POST['area4'];
    $numbersInt = $_POST['area5'];

    if(!empty($nameText) && !empty($DateCreateDate) && !empty($DateOutDate) && !empty($сostperoneInt) && !empty($numbersInt)) {
        $DateCreateDate = preg_replace('/[^0-9\.]/u', '',$DateCreateDate);
        $DateOutDate = preg_replace('/[^0-9\.]/u', '',$DateOutDate);
        $сostperoneInt_validate = filter_var($сostperoneInt, FILTER_VALIDATE_FLOAT);
        $numbersInt_validate = filter_var($numbersInt, FILTER_VALIDATE_FLOAT);

        if($nameText && $DateCreateDate && $DateOutDate && $numbersInt_validate && $сostperoneInt_validate) {
        $error1 = false;
        $error2 = false;
        $mysqli->query("UPDATE item SET name='$nameText' WHERE id=$id") or die($mysqli->error());
        $mysqli->query("UPDATE item SET DateCreate='$DateCreateDate' WHERE id=$id") or die($mysqli->error());
        $mysqli->query("UPDATE item SET DateOut='$DateOutDate' WHERE id=$id") or die($mysqli->error());
        $mysqli->query("UPDATE item SET costperone='$сostperoneInt' WHERE id=$id") or die($mysqli->error());
        $mysqli->query("UPDATE item SET numbers='$numbersInt' WHERE id=$id") or die($mysqli->error());
        header("location: Item.php");
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
