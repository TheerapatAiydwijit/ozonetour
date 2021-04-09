<?php 
$foldername = $_POST['foldername'];
$ProjectPrice = (isset($_POST['ProjectPrice']) ? $_POST['ProjectPrice'] : 0);
$ProjectID = $_POST['ProjectID'];
$ProjectImg = $_POST['ProjectImg'];
$ProjectImg = basename($ProjectImg);
$Projectstatus =$_POST['Projectstatus'];
// print_r($ProjectDetail);
$name = array();
if (isset($_POST['conten'])) {
  $conten = $_POST['conten'];
  foreach ($conten as $key => $value) {
    $Bname = basename($value);
    array_push($name, "$Bname");
  }
}
$nameimgin = array();
$targeted = "../../uplond/" . $foldername . "/";
// $imgonfolder = scandir($targeted,1);
if (is_dir($targeted)) {
  if ($dh = opendir($targeted)) {
    while (($file = readdir($dh)) !== false) {
      // echo "filename:" . $file . "<br>";
      if ($file === "." or $file === "..") {
            // echo "เป็นจุด";
          } else {
            array_push($nameimgin, "$file");
          }
    }
    closedir($dh);
  }
}
$result = array_diff($nameimgin, $name);
// print_r($result);
// print_r($result);
foreach ($result as $key => $value) {
    $Address = "../../uplond/" . $foldername . "/" . $value;
    if (unlink($Address)) {
      // echo "ลบรูปที่ไม่ตรงสำเหร็ยจ";
    } else {
      // echo "ลบรูปที่ไม่ตรงไม่สำเหร็ยจ";
    }
  }
//   echo "มาละๆ";
  $conn = mysqli_connect("localhost", "root", "", "ozonetour_web") or die("Error: " . mysqli_error($conn));
$material = $_POST['material'];
// printf($test);
$date = date("Y-m-d G:i:s");
// print_r($test);    
$sql = "UPDATE project SET
ProjectDetailall ='$material',
ProjectImg = '$ProjectImg',
ProjectPrice ='$ProjectPrice',
ProjectPricedate ='$date',
Projectstatus='$Projectstatus' WHERE  ProjectID='$ProjectID'";
// $quary = mysqli_query($conn, $sql);
if ($conn->query($sql) === TRUE) {
  $DELETE = "DELETE FROM projectdetail WHERE ProjectID='$ProjectID'";
  $result = mysqli_query($conn, $DELETE);
  $ProjectDetail =(isset($_POST['ProjectDetail']) ? $_POST['ProjectDetail'] : " ");
  print_r($ProjectDetail);
  foreach ($ProjectDetail as $key => $value) {
    $Detail = "INSERT INTO projectdetail(ProjectID,Convenient,OtherConven)
    VALUES ('$ProjectID','$value','')";
    if($conn->query($Detail) === TRUE){
        echo "เรียบร้อย";
    }else{
      echo "Error: " . $Detail . "<br>" . $conn->error;
    }
  }
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}
?>