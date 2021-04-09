<?php 
$conn = mysqli_connect("localhost", "root", "", "ozonetour_web") or die("Error: " . mysqli_error($conn));
    $key = (isset($_POST['target'])?$_POST['target']:"Null");
    $select = "SELECT * FROM project WHERE ProjectID='$key'";
    $query = mysqli_query($conn, $select);
    $require = array();
    $row = mysqli_fetch_array($query);
        $ProjectID  = $row['ProjectID'];
        $ProjectName = $row['ProjectName'];
        $ProjectDetailall = $row['ProjectDetailall'];
        $ProjectImg = $row['ProjectImg'];
        $ProjectPrice = $row['ProjectPrice'];
        $ProjectPricedate = $row['ProjectPricedate'];
        $Projectstatus = $row['Projectstatus'];
        // $require[$keytem]=$temporary;
        // $text =  "<a href='editMTPackages.php' id='$keytem'>".$temporary."</a>";
        $require = array("ProjectID" => $ProjectID,
                        "ProjectName" => $ProjectName,
                        "ProjectDetailall" => $ProjectDetailall,
                        "ProjectImg" => $ProjectImg,
                        "ProjectPrice" => $ProjectPrice,
                        "ProjectPricedate" => $ProjectPricedate,
                        "Projectstatus"=> $Projectstatus);
    // print_r($require);
    // $jsonreturn = json_encode($require);
    // echo $jsonreturn;
    $selectDetailall = "SELECT * FROM projectdetail WHERE ProjectID='$key'";
    $queryD = mysqli_query($conn, $selectDetailall);
    $requireD = array();
    $i = 0;
    while($Detailall = mysqli_fetch_array($queryD)){
            $order =$Detailall['Order'];
            $Convenient = $Detailall['Convenient'];
            $requireD[$i] = array("Order" => $order,
                            "ProjectID" => $ProjectID,
                            "Convenient" => $Convenient);
                            $i++;
    }
    $retaun = array("project" => $require,
                    "projectdetail" =>$requireD);
    // array_push($retaun, $require,$requireD);
    $Detailallreturn = json_encode($retaun);
    echo $Detailallreturn;
?>