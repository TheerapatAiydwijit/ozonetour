<?php
$conn = mysqli_connect("localhost", "root", "", "ozonetour_web") or die("Error: " . mysqli_error($conn));
$select = "SELECT * FROM project";
$query = mysqli_query($conn, $select);
$require = array();
$i = 0;
while ($row = mysqli_fetch_array($query)) {
    $keytem = $row['ProjectID'];
    $temporary = $row['ProjectName'];
    // $require[$keytem]=$temporary;
    // $text =  "<a href='editMTPackages.php' id='$keytem'>".$temporary."</a>";
    echo "<a href='#' id='$keytem' onclick='dataselect($keytem)'><li class='testall' id='namepackages'>" . $temporary . "</li></a>";
}
?>