<?php 
    $filename = $_POST['imgname']; 
    $target = strstr( $filename, '/uplond/' );  
    if(unlink("../..".$target))
    {
        echo 'File Delete Successfully';
    }else{

        echo 'File Delete is not Successfully';
    }
?>