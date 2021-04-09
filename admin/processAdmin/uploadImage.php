<?php
$FloderName = $_POST["FloderName"];
$return_value = "";
if ($_FILES["image"]["name"]) {
    if (!$_FILES["image"]["error"]) {
    $filename = $_FILES["image"]["name"];
    $fileTest = "../../uplond/$FloderName/".$filename;
        if(file_exists($fileTest)) {
            $Unit = date('dmyis');
            $random = rand(0, 9);
            $Unit .= $random;
            $ext = explode(".", $filename);
            $name = $ext[0].$Unit;
            $filename = $name . "." . $ext[1];
        }
        $destination = "../../uplond/" . "$FloderName/" . $filename;
        $location = $_FILES["image"]["tmp_name"];
        move_uploaded_file($location, $destination);
        $return_value = "uplond/" . "$FloderName/" . $filename;
    } else {
        $return_value = "Ooops! Your upload triggered the following error: " . $_FILES["image"]["error"];
    }
}
echo $return_value;
// echo $FloderName;
