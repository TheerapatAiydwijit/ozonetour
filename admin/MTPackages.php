<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="AdminCss.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/563b069620.js" crossorigin="anonymous"></script>
    <title>Document</title>
    <!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha256-4+XzXVhsDmqanXGHaHvgh1gMQKX40OUvDEBTu8JcmNs=" crossorigin="anonymous"></script> -->

    <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <!-- include summernote css/js -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <script type="text/javascript" charset="UTF-8">
        $(document).ready(function() {
            // Get value on button click and show alert
            $("#CPName").click(function() {
                var str = $("#packagename").val();
                if (str == "") {
                    alert("กรุณากรอกชื่อแพ็คเกจก่อนเริ่มเขียนเนื้อหา");
                } else {
                    var con = confirm("เมื่อยืนยันแล้วจะไม่สามารถแก้ไข้ได้อีก");
                    if (con == true) {

                        $.ajax({
                            url: "processAdmin/createfloder.php",
                            data: {
                                FloderName: str
                            },
                            type: "POST",
                            success: function(result) {
                                if (result == "มีแพ็คเกจชื่อนี้อยู่แล้ว") {
                                    $("#status").html(result);
                                } else {
                                    $("#status").html(result);
                                    $("#packagename").attr("readonly", true);
                                    $('#summernote').summernote('enable');
                                }
                            },
                            error: function(data) {
                                console.log(data);
                            }
                        });
                    } else {

                    }

                }

            });
        });

        function uploadImageContent(image, editor, FloderName) {
            var data = new FormData();
            data.append("image", image);
            data.append("FloderName", FloderName);
            // console.log(image);
            $.ajax({
                url: "processAdmin/uploadImage.php",
                cache: false,
                contentType: false,
                processData: false,
                data: data,
                type: "post",
                success: function(url) {
                    url = "../" + url;
                    var image = $(" <img> ").attr("src", url);
                    $(editor).summernote("insertNode", image[0]);
                    // console.log(url);
                },
                error: function(data) {
                    console.log(data);
                }
            });
        }

        function deleteImage(image, editor) {
            var imgname = decodeURIComponent(image);
            // console.log(imgname);
            $.ajax({
                url: "processAdmin/DeletePackages.php",
                data: {
                    imgname: imgname
                },
                type: "post",
                success: function(url) {
                    console.log(url);
                    // alert(url);
                },
                error: function(data) {
                    console.log(data);
                }
            });
        }
        $(document).ready(function() {
            $("#submit").click(function() {
                var str = $("#packagename").val();
                // $contentPost = $("#summernote").val();
                var contentPost = document.getElementById("summernote").value;
                var dom = document.implementation.createHTMLDocument("Test");
                dom.body = document.createElement('body');
                dom.body.append(contentPost);
                var links = [];
                dom.imgs = document.getElementsByTagName('img');
                var imgpage = dom.imgs;
                // var endcode = decodeURIComponent(imgpage)
                // console.log(dom.imgs);
                console.log(imgpage.length);
                for (var i = 0; i < imgpage.length;i++) {
                    links.push(imgpage[i].getAttribute("src"));
                    console.log("dawdawfawfaw");
                }
                $.ajax({
                    url: "processAdmin/AddPackages.php",
                    type:"POST",
                    data: {conten:links,foldername:str,ProjectDetail:str},
                    success: function(require){
                        console.log(require);
                    }
                });
            });
        });
    </script>
</head>

<body>
    <div class="container-fluid mx-0">
        <div class="row">
            <div class="col-md-2" id="sidbar">
                <div class="sidebar-header">
                    <h2>Admin Ozonetour</h2>
                </div>
                <hr>
                <p>Dummy Heading</p>
                <hr>
                <ul class="list-unstyled components">
                    <li>
                        <a href="admin.php"><i class="fas fa-home"></i>หน้าแรก</a>
                    </li>
                    <li>
                        <a href="#"><i class="fas fa-archive"></i>จัดการแพ็คเกจทัวร์</a>
                    </li>
                    <li>
                        <a href="#"><i class="fas fa-keyboard"></i>เว็บบอร์ด</a>
                    </li>
                    <li>
                        <a href="#"><i class="fas fa-edit"></i>เขียนบทความ</a>
                    </li>
                    <li>
                        <a href="#"><i class="far fa-address-book"></i>การติดต่อเพิ่มเติม</a>
                    </li>
                </ul>
            </div>
            <div class="col pt-5">
                <div class="row">
                    <div class="col-md-2">
                        <ul>
                            <li>
                               <a href="addMTPackages.php">เพิ่มแพ็คเกจทัวร์</a> 
                            </li>
                            <li>
                            <a href="editMTPackages.php">แก้ไขแพ็คเกจทัวร์</a> 
                            </li>
                            <li>

                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>