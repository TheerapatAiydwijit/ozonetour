<?php
session_start();
 $conn = mysqli_connect("localhost", "root", "", "ozonetour_web") or die("Error: " . mysqli_error($conn)); 
    $usernameL = $_POST['usernameL'];
    $passwordL = $_POST['passwordL'];
    // echo $passwordL;
    $sql = "SELECT * FROM user WHERE username='$usernameL' AND password='$passwordL'";
    $query = mysqli_query($conn, $sql);
    if ($query->num_rows > 0) {
        $user = mysqli_fetch_array($query);
        $_SESSION["userID"] = $user['userID'];
        echo "1";
    }else{
        echo "0";
    }
?>