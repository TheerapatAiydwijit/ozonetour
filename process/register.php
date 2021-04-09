<?php
$conn = mysqli_connect("localhost", "root", "", "ozonetour_web") or die("Error: " . mysqli_error($conn));
$usernameR = $_POST['usernameR'];
$passwordR = $_POST['passwordR'];
$nameR = $_POST['nameR'];
$emailR = $_POST['emailR'];
$phoneR = $_POST['phoneR'];
$chekusername = "SELECT userID FROM user WHERE username='$usernameR'";
$username = mysqli_query($conn, $chekusername);
if ($username->num_rows > 0) {
    echo 0;
} else {
    $chekEmail = "SELECT userID FROM user WHERE email='$emailR'";
    $cEmail = mysqli_query($conn, $chekEmail);
    if ($cEmail->num_rows > 0) {
        echo 1;
    } else {
        $sql = "INSERT INTO user(name,tell,email,username,password)
        VALUE ('$nameR','$phoneR','$emailR','$usernameR','$passwordR')";
        if ($conn->query($sql) === TRUE) {
            echo 2;
        } else {
            echo 3;
        }
    }
}
