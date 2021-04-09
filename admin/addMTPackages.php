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
    <script src="scriptadmin.js"></script>
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
                        <a href="MTPackages.php"><i class="fas fa-archive"></i>จัดการแพ็คเกจทัวร์</a>
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
            <div class="col-md-10 pt-5">
                <div class="my-0">
                    <a href="MTPackages.php"> &#60;&#60;ย้อนกลับ </a>
                </div>
                <form method="post" action="processAdmin/AddPackages.php" id="myForm">
                    <div class="row">
                        <div class="col-md-8 mx-5">
                            <p id="status"></p>
                            <input type="text" id="packagename" name="topic" class="form-control" placeholder="ใส่ชื่อหัวห้อแพ๊คเกจทัวร์">
                            <button type="button"><a href="#" id="CPName">ยืนยันชื่อแพ็คเกจ</a></button>
                            <br>
                            <textarea id="summernotedetail" name="editordata"></textarea>
                            <textarea id="summernote" name="editordata"></textarea>
                            <!-- <input type="submit" value="สร้าง"> -->
                            <button type="button" id="submit" class="btn bg-dark" name="1">
                                <a href="#" class="text-white" id="statud">
                                    สร้างแพ็คเกจใหม่
                                </a>
                            </button>
                            <script>
                                $("#summernotedetail").summernote({
                                    lang: "en - EN",
                                    dialogsInBody: true,
                                    height: 300,
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
                            <div>
                                <p>รูปภาพแนะนำ</p>
                                <input type="file" name="recommend" id="imguplode" onchange="getImg(this.files)">
                                <div id="showimg">

                                </div>
                                <div class="mt-2">
                                    <p>รายละเอียดแพ็คเกจ</p>
                                    <button type="button" onclick="addConvenient()">เพิ่ม</button>
                                </div>
                                <div class="overflow-auto" style="height: auto;max-height: 40vh;">
                                    <ul id="Convenient" class="list-unstyled my-3">

                                    </ul>
                                </div>
                                <div>
                                    <p>ราคาของแพ็คแกจ</p>
                                    <input type="number" name="price" id="price">
                                </div>
                                <div class="form-check pl-0">
                                <p>สถานะของแพ็คเกจ</p>
                                <select class="country">
                                    <option value="open">เปิดให้บริการ</option>
                                    <option value="close">ไม่สามารถให้บริการในขณะนี้</option>
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