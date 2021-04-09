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
            // $('#imguplode').change(function(){
            //     var upl =  $("#packagename").attr("readonly");
            //     console.log(upl);
            //     if(upl != "readonly"){
            //         alert("กรุณาตั้งชื่อแพ็คเกจก่อนเพิ่มรูปแนะนำ");
            //     }else{
            //         var img = this;
            //         var str = $("#packagename").val();
            //         uploadImageContent(img[0],"0",str);
            //     }   
            // });
        });     
        function getImg(img){
            var upl =  $("#packagename").attr("readonly");
                console.log(upl);
                if(upl != "readonly"){
                    alert("กรุณาตั้งชื่อแพ็คเกจก่อนเพิ่มรูปแนะนำ");
                }else{
                    // var img = this;
                    var str = $("#packagename").val();
                    console.log(img[0]);
                    uploadImageContent(img[0],"0",str);
                }   
        }
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
                    if(editor == "0"){
                    // console.log(url);
                    url = "img" + url;
                    var image = document.createElement("img");
                    image.setAttribute("src", url);
                    image.setAttribute("id","imgshow");
                    image.setAttribute("width","100px");
                    image.setAttribute("height","100px");
                    var div = document.getElementById('showimg');
                    div.innerHTML=" ";
                    div.append(image);
                    }else{
                    url = "img" + url;
                    var image = $(" <img> ").attr("src", url);
                    $(editor).summernote("insertNode", image[0]);
                    // console.log(url);
                    }
                   
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
                var button = document.getElementById('submit');
                button.setAttribute("disabled","true");
                var statud = document.getElementById('statud');
                statud.innerHTML="กำลังทำการบันทึกข้อมูล";
                var str = $("#packagename").val();
                var Conven = [];
                for (var m = 0;; m++) {
                    try {
                        var Convenient = document.getElementsByClassName('Convenient')[m].value;
                        Conven.push(Convenient);
                    } catch (e) {
                        // exit the loop
                        break;
                    }
                }
                var price = document.getElementById('price').value;
                var contentPost = document.getElementById("summernote").value;
                var dom = document.implementation.createHTMLDocument("Test");
                dom.body = document.createElement('body');
                dom.body.append(contentPost);
                var links = [];
                dom.imgs = document.getElementsByTagName('img');
                var imgpage = dom.imgs;
                // console.log(imgpage);
                // var endcode = decodeURIComponent(imgpage)
                // console.log(dom.imgs);
                // console.log(imgpage.length);
                for (var i = 0; i < imgpage.length; i++) {
                    links.push(imgpage[i].getAttribute("src"));
                    console.log("dawdawfawfaw");
                }
                var locatinfile = $('#submit').attr("name");
                var imgDetail = $('#imgshow').attr("src");
                var imgshow = decodeURIComponent(imgDetail);
                var selected = $ ("#statuspack").val();
                console.log(selected);
                if(locatinfile =="1"){
                $.ajax({
                    url: "processAdmin/AddPackages.php",
                    type: "POST",
                    data: {
                        material: contentPost,
                        conten: links,
                        foldername: str,
                        ProjectImg:imgshow,
                        Projectstatus: selected,
                        ProjectDetail: Conven,
                        ProjectPrice: price
                    },
                    success: function(require) {
                        console.log(require);
                        alert("บันทึกข้อมูลเสร็ยจสิ้น");
                        location.reload();
                    }
                });
                }
                else{
                    if(locatinfile =="2"){
                        var ProjectID = $('#packagsID').html();
                        $.ajax({
                            url: "processAdmin/editPackages.php",
                            type: "POST",
                            data: {
                                material: contentPost,
                                ProjectID: ProjectID,
                                conten: links,
                                foldername: str,
                                ProjectImg:imgshow,
                                Projectstatus:selected,
                                ProjectDetail: Conven,
                                ProjectPrice: price
                            },
                            success: function(require) {
                                console.log(require);
                                alert("บันทึกข้อมูลเสร็ยจสิ้น");
                                location.reload();
                            }
                        });
                        // console.log(locatinfile);
                    }else{

                    }
                }
                
            });
        });
        $(document).ready(function() {
            $('#Convenient').on('click', '.deleteConvenient', function() {
                $(this).parents('li').remove();
            });
        });

        function addConvenient() {
            var ul = document.getElementById('Convenient');
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
            li.appendChild(inputs);
            ul.appendChild(li);
        }