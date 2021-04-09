<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="AdminCss.css">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous"> -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script> -->
    <script src="https://kit.fontawesome.com/563b069620.js" crossorigin="anonymous"></script>
    <title>Document</title>
    <!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha256-4+XzXVhsDmqanXGHaHvgh1gMQKX40OUvDEBTu8JcmNs=" crossorigin="anonymous"></script> -->

    <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <!-- include summernote css/js -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <script src="scriptadmin.js"></script>
    <script>
        $(document).ready(function() {
            $('#search').keyup(function() {
                var value = $(this).val().toLowerCase();
                // console.log(text);
                $("#packagesshow li").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });

        function dataselect(target) {
            console.log("dawdawd");
            var target = target;
            // console.log(target);
            $('#summernote').summernote('enable');
            $.ajax({
                url: "searchPackages.php",
                data: {
                    target: target
                },
                type: "post",
                dataType: "json",
                success: function(require) {
                    $('#packagename').val(require.project.ProjectName).attr("readonly", true);
                    $('#summernote').summernote("code", require.project.ProjectDetailall);
                    $('#price').val(require.project.ProjectPrice);
                    $('#packagsID').html(require.project.ProjectID);
                    var url = "../uplond/" + require.project.ProjectName + "/" + require.project.ProjectImg;
                    var image = document.createElement("img");
                    image.setAttribute("src", url);
                    image.setAttribute("id", "imgshow");
                    image.setAttribute("width", "100px");
                    image.setAttribute("height", "100px");
                    var div = document.getElementById('showimg');
                    div.innerHTML = " ";
                    div.append(image);
                    // var lem = require.length;
                    console.log("awawfawf");
                    $projectdetail = require.projectdetail;
                    $Detaillent = $projectdetail.length;
                    var ul = document.getElementById('Convenient');
                    ul.innerHTML = " ";
                    for (i = 0; i < $Detaillent; i++) {
                        var li = document.createElement('li');
                        var idforli = ul.children.length + 1;
                        li.setAttribute("id", "element" + idforli);
                        li.setAttribute("class", "my-2");
                        var button = document.createElement('button');
                        button.setAttribute("type", "button");
                        button.setAttribute("Class", "deleteConvenient");
                        button.innerHTML = '<i class="fas fa-times"></i>';
                        li.appendChild(button);
                        var inputs = document.createElement('input');
                        inputs.setAttribute("name", "Convenient");
                        inputs.setAttribute("class", "Convenient");
                        inputs.setAttribute("value", $projectdetail[i].Convenient);
                        li.appendChild(inputs);
                        ul.appendChild(li);
                        // console.log(require);
                    }
                }
            });
        }
        $(document).ready(function() {
            $('#dataall').load("processAdmin/dataselect.php");
            $('#deleteP').click(function() {
                var ProjectID = $('#packagsID').html();
                $.ajax({
                    url: "processAdmin/deletepackagesAll.php",
                    type: "post",
                    data: {
                        ProjectID: ProjectID
                    },
                    success: function(require) {
                        console.log("ลบหมดแล้ว");
                        var divdataall = document.getElementById('dataall');
                        divdataall.innerHTML = " ";
                        $('#dataall').load("processAdmin/dataselect.php");
                        $('#summernote').summernote("reset");
                        document.getElementById("myForm").reset();
                    }
                });
            });
        });
    </script>
</head>

<body>
    <div class="container-fluid mx-0">
        <div class="row">
            <div class="col-md-2" id="sidbar" class="headeredit">
                <div class="sidebar-header">
                    <h2>Admin Ozonetour</h2>
                </div>
                <hr>
                <p>Dummy Heading</p>
                <hr>
                <div class="input-group md-form form-sm form-1 pl-0">
                    <input class="form-control my-0 py-1" id="search" type="text" placeholder="Search" aria-label="Search">
                </div>
                <div class="searchbox">
                    <div id="Packagesall" class="overflow-auto" style="height: auto;max-height: 40vh;">
                        <ul id="packagesshow" class="list-unstyled ">
                            <div id="dataall">

                            </div>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-10 pt-5">
                <a href="MTPackages.php"> &#60;&#60;ย้อนกลับ </a>
                <form method="post" action="processAdmin/AddPackages.php" id="myForm">
                    <div class="row">
                        <div class="col-md-8 mx-5">
                            <p id="status"></p>
                            <!-- <center><h2 id="packagename"></h2></center> -->
                            <input type="text" id="packagename" name="topic" class="form-control" placeholder="ใส่ชื่อหัวห้อแพ๊คเกจทัวร์">
                            <!-- <button type="button"><a href="#" id="CPName">ยืนยันชื่อแพ็คเกจ</a></button> -->
                            <br>
                            <textarea id="summernote" name="editordata"></textarea>
                            <!-- <input type="submit" value="สร้าง"> -->
                            <button type="button" id="submit" class="btn bg-dark" name="2">
                                <a href="#" class="text-white" id="statud">
                                    บันทึกการแก้ไข
                                </a>
                            </button>
                            <button type="button" id="deleteP" class="btn bg-danger" name="2">
                                <a href="#" class="text-white" id="statud">
                                    ลบแพ็คเกจ
                                </a>
                            </button>
                            <script>
                                $("#summernote").summernote({
                                    lang: "en - EN",
                                    dialogsInBody: true,
                                    height: 500,
                                    minHeight: null,
                                    maxHeight: null,
                                    shortCuts: false,
                                    fontSize: 14,
                                    disableDragAndDrop: false,
                                    toolbar: [
                                        ["style", ["bold", "italic", "underline", "clear"]],
                                        ["font", ["strikethrough", "superscript", "subscript"]],
                                        ["fontsize", ["fontsize"]],
                                        ["color", ["color"]],
                                        ["para", ["ul", "ol", "paragraph"]],
                                        ["height", ["height"]],
                                        ["Insert", ["picture"]],
                                        ["Other", ["fullscreen", "codeview"]]
                                    ],
                                    callbacks: {
                                        onImageUpload: function(image) {
                                            var FloderName = $("#packagename").val();
                                            editor = $(this);
                                            uploadImageContent(image[0], editor, FloderName);
                                        },
                                        onMediaDelete: function(image) {
                                            editor = $(this);
                                            deleteImage(image[0].src, editor);
                                        }
                                    }
                                });
                                $('#summernote').summernote('disable');
                            </script>
                        </div>
                        <div class="col">
                            <div>
                                <h1>รายละเอียดแพ็คเกจ</h1>
                            </div>
                            <div class="detail">
                                <p>แพ็คเกจไอดีที่<b id="packagsID"></b></p>
                            </div>
                            <div>
                                <p>รูปภาพแนะนำ</p>
                                <input type="file" name="recommend" id="imguplode" onchange="getImg(this.files)">
                                <div id="showimg" class="detail">

                                </div>
                            </div>
                            <div class="mt-2">
                                <p>หมวดสิ่งอำนวยความสดวก</p>
                                <button type="button" onclick="addConvenient()">เพิ่ม</button>
                            </div>
                            <div class="overflow-auto" style="height: auto;max-height: 40vh;">
                                <ul id="Convenient" class="list-unstyled my-3 detail">

                                </ul>
                            </div>
                            <div>
                                <p>ราคาของแพ็คแกจ</p>
                                <input type="number" name="price" id="price">
                            </div>
                            <div class="form-check pl-0">
                                <p>สถานะของแพ็คเกจ</p>
                                <select id="statuspack">
                                    <option value="1" id="of1">เปิดให้บริการ</option>
                                    <option value="0" id="of2">ไม่สามารถให้บริการในขณะนี้</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>