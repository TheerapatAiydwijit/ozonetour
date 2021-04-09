<?php 
include("ConnectDB.php");
$response =$_POST['response'];
$secretKey = "6LcY_BgaAAAAAMJE5ZtWS0_vg4M4_BuLJAbU7161";
$testUrl = 'https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($secretKey) .  '&response=' . urlencode($response);
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $testUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_TIMEOUT, 5);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);// localhost, development only.
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);// localhost, development only.

$output = curl_exec($ch);
if ($output === false) {
    // if curl error.
    $curlError = curl_error($ch);
    $curlErrorNo = curl_errno($ch);
}
curl_close($ch);
// echo 'curl result:<br>' . PHP_EOL;
// var_dump($output);
if (isset($curlError)) {
    echo 'Error:<br>' . PHP_EOL;
    var_dump($curlError);
    echo 'Error code:<br>' . PHP_EOL;
    var_dump($curlErrorNo);
}
$response = json_decode($output, true);
$status = $response['success'];
    if(!$status == "1"){
        echo "0";
    }else{
        $date = date("Y-m-d");
        $firstname =$_POST['firstname'];
        $lastname =$_POST['lastname'];
        $phone = $_POST['phone'];
        $datetavl = $_POST['datetavl'];
        $menucat_ID = $_POST['menucat_ID'];
        $sqlshit = "INSERT INTO shit_action (shit_actionname,shit_actionlastname,shit_actiondate,menucat_ID,shit_actiontell,shit_actiondatenow)
        VALUE ('$firstname','$lastname','$datetavl','$menucat_ID','$phone','$date')";
        // $quary = mysqli_query($conn,$sqlshit);
        if($conn->query($sqlshit) === TRUE){
            echo "1";
        }else{
            echo "2";
        }
    }
?>
