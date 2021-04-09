<?php
    $conn = mysqli_connect("localhost", "root", "", "ozonetour_web") or die("Error: " . mysqli_error($conn));
    $menucatID = $_POST['menuid'];
    $sqlvan ="SELECT * FROM menu WHERE menucat_ID='$menucatID'";
    $require = array();
    $quray = mysqli_query($conn,$sqlvan);
    if($quray ->num_rows > 0){
    $row = mysqli_fetch_array($quray);
        $menu_ID= $row['menu_ID'];
        $menucat_ID = $row['menucat_ID'];
        $menu_name = $row['menu_name'];
        $menu_details = $row['menu_details'];
        $menu_date = $row['menu_date'];
    $require = array("status" =>"1",
                     "menu_ID" =>$menu_ID,
                     "menucat_ID" => $menucat_ID,
                     "menu_name	" =>$menu_name,
                     "menu_details" =>$menu_details,
                     "menu_date" => $menu_date);
    }else{
        $require = array("status" =>"0");
    }   
    $Detailallreturn = json_encode($require);
    echo $Detailallreturn;
    // echo $menucatID;
?>