<?php
$ProjectID = $_POST['ProjectID'];
$conn = mysqli_connect("localhost", "root", "", "ozonetour_web") or die("Error: " . mysqli_error($conn));
$sql = "SELECT * FROM project WHERE ProjectID='$ProjectID'";
$result = mysqli_query($conn, $sql) or die("Error : " . mysqli_error($conn));
$objResult = mysqli_fetch_array($result);
$ProjectName = $objResult['ProjectName'];
$targeted = "../../uplond/" . $ProjectName . "/";
// $imgonfolder = scandir($targeted,1);
if (is_dir($targeted)) {
    if ($dh = opendir($targeted)) {
        while (($file = readdir($dh)) !== false) {
            // echo "filename:" . $file . "<br>";
            if ($file === "." or $file === "..") {
                // echo "เป็นจุด";
            } else {
                $targetedfile = "../../uplond/" . $ProjectName . "/".$file;
                if (unlink($targetedfile)) {
                    echo 'File Delete Successfully';
                } else {
                    echo 'File Delete is not Successfully';
                }
            }
        }
        closedir($dh);
    }
    rmdir($targeted);
}
$sqldeleproject = "DELETE FROM project WHERE ProjectID ='$ProjectID'";
$sqldeleprojectdetail = "DELETE FROM projectdetail WHERE ProjectID='$ProjectID'";
$resultproject = mysqli_query($conn,$sqldeleproject) or die("Error : ". mysqli_error($conn));
$resultprojectdetail  = mysqli_query($conn,$sqldeleprojectdetail) or die("Error : ". mysqli_error($conn));
echo "ลบ";
?>

