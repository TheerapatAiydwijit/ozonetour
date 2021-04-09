<?php 
    session_start();
    $step = $_POST['step'];
    if($step == "1"){
        $menuid = $_POST['menuid'];
        $_SESSION['menuid']= $menuid;
        echo "1";
    }else{
        $menuid = $_SESSION['menuid'];
        session_unset();
        session_destroy();
        echo $menuid;
    }
?>