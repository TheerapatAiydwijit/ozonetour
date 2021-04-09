<?php 
    $floder = $_POST['FloderName'];
    $chekfloder = is_dir("../../uplond/$floder");
    if($chekfloder){
        echo "มีแพ็คเกจชื่อนี้อยู่แล้ว";
    }
    else{
        echo "สร้างหัวข้อแพ็คเกจสำเหร็จ";
        $mkdirS = mkdir("../../uplond/$floder");
    }
?>