<?php
$conn = mysqli_connect("localhost", "root", "", "ozonetour_web") or die("Error: " . mysqli_error($conn));
    $packageid =$_POST['packageid'];
    $TravelDate = $_POST['TravelDate'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $rates =$_POST['rates'];
    $NumberPeople =$_POST['NumberPeople'];
    $fillname = $_POST['fillname'];
    $phone = $_POST['phone'];
    $Email =$_POST['Email'];
    $datandtime = $date." ".$time;
$sql = "INSERT INTO reservationpackage(reservationpackagenamelast,reservationpackagetell,reservationpackageemail,reservationpackagecount,reservationpackagedate,reservationpackagedatenow,reservationpackageprice,ProjectID)
VALUE ('$fillname','$phone','$Email','$NumberPeople','$TravelDate','$datandtime','$rates','$packageid')";
    if($conn->query($sql) === TRUE){
        echo "1";
    }else{
        echo "0";
    }
?>