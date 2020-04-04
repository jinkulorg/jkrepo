@extends('layouts.app')

@section('content')
<div class="grid_3">
    <div class="container">
        <div class="breadcrumb1">
            <ul>
                <a href="/"><i class="fa fa-home home_1"></i></a>
                <span class="divider">&nbsp;|&nbsp;</span>
                <li class="current-page">Add or Change Profile Pics</li>
            </ul>
        </div>
        @if(\Session::has('success'))
        <div class="alert alert-success">
            <p>{{\Session::get('success')}}</p>
        </div>
        @endif
        @if(\Session::has('failure'))
        <div class="alert alert-danger">
            <p>{{\Session::get('failure')}}</p>
        </div>
        @endif
        <div class="row" style="text-align: center">
            <form id="profilePicForm" action="{{action('ProfilesController@updateProfilePic',$profile->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="_method" value="PATCH" />
                <div class="col-md-6">
                    <table class="table_working_hours" style="width: auto; margin-left:auto; margin-right:auto;">
                        <tbody>
                            <tr class="opened_1">
                                <td class="day_value" colspan="2">
                                    <div class="img" id="profileImageDiv">
                                        <table>
                                            <tr>
                                                <td colspan="4">
                                                    <?php
                                                    $totalPics = 0;
                                                    if ($profile->profile_pic_path != null) {
                                                        $profile_pic_paths = explode(",", $profile->profile_pic_path);
                                                        $totalPics = sizeof($profile_pic_paths);
                                                        if ($totalPics != 0) {
                                                            ?>
                                                            <img id='mainimage' src='/storage/profile_images/mainimage/{{$profile_pic_paths[0]}}' width='300' height='305'>
                                                        <?php
                                                            } else {
                                                                ?>
                                                            <img id='mainimage' src='/images/blank-profile-picture.png' width='300' height='300'>
                                                        <?php
                                                            }
                                                        } else {
                                                            ?>
                                                        <img id='mainimage' src='/images/blank-profile-picture.png' width='300' height='300'>
                                                    <?php
                                                    }
                                                    ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <?php
                                                $totalPics = 0;
                                                if ($profile->profile_pic_path != null) {
                                                    $profile_pic_paths = explode(",", $profile->profile_pic_path);
                                                    $totalPics = sizeof($profile_pic_paths);
                                                    $i = 1;
                                                    foreach ($profile_pic_paths as $profile_pic_path) {
                                                        ?>
                                                        <td>
                                                            <img id="image{{$i}}" width="73" height="63" src="/storage/profile_images/thumbnail/{{$profile_pic_path}}" onclick="showInMainImage('image{{$i}}')" />&nbsp;
                                                        </td>
                                                    <?php
                                                            $i++;
                                                        }
                                                    }
                                                    for ($i = $totalPics + 1; $i <= 4; $i++) {
                                                        ?>
                                                    <td>
                                                        <img id="image{{$i}}" width="73" height="63" src="/images/blank-profile-picture.png" onclick="showInMainImage('image{{$i}}')" />&nbsp;
                                                    </td>
                                                <?php
                                                }
                                                ?>
                                            </tr>
                                            <tr>
                                                <td style="text-align: center">
                                                    <label id="AddImage1" class="button_add button4" data-toggle="tooltip" data-placement="bottom" title="Add first image"><i class="fa fa-plus" aria-hidden="true"></i></label>
                                                    <label id="RemoveImage1" class="button_remove button4" data-toggle="tooltip" data-placement="bottom" title="Remove first image"><i class="fa fa-trash-o" aria-hidden="true"></i></label>
                                                </td>
                                                <td style="text-align: center">
                                                    <label id="AddImage2" class="button_add button4" data-toggle="tooltip" data-placement="bottom" title="Add second image"><i class="fa fa-plus" aria-hidden="true"></i></label>
                                                    <label id="RemoveImage2" class="button_remove button4" data-toggle="tooltip" data-placement="bottom" title="Remove second image"><i class="fa fa-trash-o" aria-hidden="true"></i></label>
                                                </td>
                                                <td style="text-align: center">
                                                    <label id="AddImage3" class="button_add button4" data-toggle="tooltip" data-placement="bottom" title="Add third image"><i class="fa fa-plus" aria-hidden="true"></i></label>
                                                    <label id="RemoveImage3" class="button_remove button4" data-toggle="tooltip" data-placement="bottom" title="Remove third image"><i class="fa fa-trash-o" aria-hidden="true"></i></label>
                                                </td>
                                                <td style="text-align: center">
                                                    <label id="AddImage4" class="button_add button4" data-toggle="tooltip" data-placement="bottom" title="Add fourth image"><i class="fa fa-plus" aria-hidden="true"></i></label>
                                                    <label id="RemoveImage4" class="button_remove button4" data-toggle="tooltip" data-placement="bottom" title="Remove fourth image"><i class="fa fa-trash-o" aria-hidden="true"></i></label>
                                                </td>
                                            </tr>
                                            <tr class="opened_1">
                                                <td class="day_value">
                                                    <div id="divImage1" class="inputText_block1" style="display: none">
                                                        <input class="optional <?php echo ($profile->profile_pic_path == null) ? "valid" : "valid" ?>" type="file" name="profile_pic_path1" id="profile_pic1" oninput="this.className = 'optional valid'" onchange="showImages(1)" accept="image/*">
                                                    </div>
                                                    <div id="divImage2" class="inputText_block1" style="display: none">
                                                        <input class="optional <?php echo ($profile->profile_pic_path == null) ? "valid" : "valid" ?>" type="file" name="profile_pic_path2" id="profile_pic2" oninput="this.className = 'optional valid'" onchange="showImages(2)" accept="image/*">
                                                    </div>
                                                    <div id="divImage3" class="inputText_block1" style="display: none">
                                                        <input class="optional <?php echo ($profile->profile_pic_path == null) ? "valid" : "valid" ?>" type="file" name="profile_pic_path3" id="profile_pic3" oninput="this.className = 'optional valid'" onchange="showImages(3)" accept="image/*">
                                                    </div>
                                                    <div id="divImage4" class="inputText_block1" style="display: none">
                                                        <input class="optional <?php echo ($profile->profile_pic_path == null) ? "valid" : "valid" ?>" type="file" name="profile_pic_path4" id="profile_pic4" oninput="this.className = 'optional valid'" onchange="showImages(4)" accept="image/*">
                                                    </div>
                                                </td>
                                            </tr>
                                            <input type="text" class="optional valid" name="removeFilesList" id="removeFilesList" value="" hidden>
                                            <tr>
                                                <td colspan="4">
                                                    <div id="processing" style="display: none; text-align: center;">
                                                        <h4><i class="fa fa-spinner fa-pulse fa-1x fa-fw" aria-hidden="true"></i> Please Wait. Saving Images.</h4>
                                                    </div>
                                                    <input class="btn_1" id="saveAll" style="width: 100%" type="submit" value="Save All" onclick="saveAllClicked()" style="display: inline-block">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="4">
                                                    <a class="btn_1" id="backbtn" style="width: 100%" href="{{action('ProfilesController@show',$profile->id)}}" style="display: inline-block">Back to your profile</a>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </form>
            <div class="col-md-6">
                <label style="color: #a3384f; margin: 10px; text-align: left;">
                    <b style="color: #c0032c"><i class='fa fa-check' aria-hidden='true'></i> Image should not be greater than 2 MB.</b>
                    <br><br><i class='fa fa-check' aria-hidden='true'></i> Upload square images for best view (e.g, 2611 X 2611).
                    <br><br><i class='fa fa-check' aria-hidden='true'></i> Use <a href="https://play.google.com/store/apps/details?id=com.lyrebirdstudio.instasquare">Instasquare</a> App to make square images or <a href="https://croppola.com/">croppola</a> to crop square images.
                    <br><br><i class='fa fa-check' aria-hidden='true'></i> In case, if the big image is not loaded and small image is loaded, then click on the small image.
                    <br><br><i class='fa fa-check' aria-hidden='true'></i> Your first image will be seen in search result, requests and in featured profile (if subscribed).
                </label>
            </div>
        </div>
    </div>
    <script>
        function saveAllClicked() {
            document.getElementById('saveAll').style.display = "none";
            document.getElementById('backbtn').style.display = "none";
            document.getElementById('processing').style.display = "block";
        }

        function showImages(identity) {
            var fileInput = document.getElementById('profile_pic' + identity);
            makeAllFileInputValid();
            var files = fileInput.files;
            for (i = 0; i < files.length; i++) {
                //enable the below code and test with our marriage images.

                if (files[i].size > 2000000) {
                    alert("Image size is greater than 2MB. Please upload image which is less than 2MB.");
                    continue;
                }

                if (files[i].type.indexOf("image") == -1) {
                    alert("You can upload only images.");
                    continue;
                }

                var oFReader = new FileReader();
                oFReader.readAsDataURL(files[i]);

                var mainImageElement = document.getElementById('mainimage');
                var imageName = "image" + identity;
                var imgElement = document.getElementById(imageName);
                removeFilesListInput = document.getElementById("removeFilesList");

                oldImage1 = imgElement.src.substr(imgElement.src.lastIndexOf("/") + 1);
                img1src = imgElement.src;
                if (mainImageElement.src == img1src.replace("thumbnail", "mainimage")) {
                    mainImageElement.src = "/images/blank-profile-picture.png";
                }
                imgElement.src = "/images/blank-profile-picture.png";
                if (removeFilesListInput.value == "") {
                    removeFilesListInput.value = oldImage1;
                } else {
                    removeFilesListInput.value = removeFilesListInput.value + "," + oldImage1;
                }

                oFReader.onload = function(oFREvent) {
                    var imageName = "image" + identity;
                    var imgElement = document.getElementById(imageName);
                    var mainImageElement = document.getElementById('mainimage');
                    imgElement.src = oFREvent.target.result;
                    mainImageElement.src = oFREvent.target.result;
                }
            }

        }

        function makeAllFileInputValid() {
            document.getElementById('profile_pic1').className = "optional valid";
            document.getElementById('profile_pic2').className = "optional valid";
            document.getElementById('profile_pic3').className = "optional valid";
            document.getElementById('profile_pic4').className = "optional valid";
        }

        function showInMainImage(image) {
            var imageFrom = document.getElementById(image);
            var mainImageElement = document.getElementById('mainimage');
            imagesrc = imageFrom.src;
            mainImageElement.src = imagesrc.replace("thumbnail", "mainimage");
        }


        const fileSelect1 = document.getElementById("AddImage1"),
            fileElem1 = document.getElementById("profile_pic1")
        fileSelect1.addEventListener("click", function(e) {
            if (fileElem1) {
                fileElem1.click();

            }
        }, false);

        const fileSelect2 = document.getElementById("AddImage2"),
            fileElem2 = document.getElementById("profile_pic2")
        fileSelect2.addEventListener("click", function(e) {
            if (fileElem2) {
                fileElem2.click();
            }
        }, false);

        const fileSelect3 = document.getElementById("AddImage3"),
            fileElem3 = document.getElementById("profile_pic3")
        fileSelect3.addEventListener("click", function(e) {
            if (fileElem3) {
                fileElem3.click();
            }
        }, false);

        const fileSelect4 = document.getElementById("AddImage4"),
            fileElem4 = document.getElementById("profile_pic4")
        fileSelect4.addEventListener("click", function(e) {
            if (fileElem4) {
                fileElem4.click();
            }
        }, false);

        mainImageElement = document.getElementById('mainimage');
        removeFilesListInput = document.getElementById("removeFilesList");

        const rmfileSelect1 = document.getElementById("RemoveImage1"),
            rmfileElem1 = document.getElementById("profile_pic1")
        rmfileSelect1.addEventListener("click", function(e) {

            if (rmfileElem1) {
                rmfileElem1.value = "";
                img1 = document.getElementById("image1");
                oldImage1 = img1.src.substr(img1.src.lastIndexOf("/") + 1);
                img1src = img1.src;
                if (mainImageElement.src == img1src.replace("thumbnail", "mainimage")) {
                    mainImageElement.src = "/images/blank-profile-picture.png";
                }
                img1.src = "/images/blank-profile-picture.png";
                if (removeFilesListInput.value == "") {
                    removeFilesListInput.value = oldImage1;
                } else {
                    removeFilesListInput.value = removeFilesListInput.value + "," + oldImage1;
                }
            }

        }, false);

        const rmfileSelect2 = document.getElementById("RemoveImage2"),
            rmfileElem2 = document.getElementById("profile_pic2")
        rmfileSelect2.addEventListener("click", function(e) {


            if (rmfileElem2) {
                rmfileElem2.value = "";
                img2 = document.getElementById("image2");
                oldImage2 = img2.src.substr(img2.src.lastIndexOf("/") + 1);
                img2src = img2.src;
                if (mainImageElement.src == img2src.replace("thumbnail", "mainimage")) {
                    mainImageElement.src = "/images/blank-profile-picture.png";
                }
                img2.src = "/images/blank-profile-picture.png";
                if (removeFilesListInput.value == "") {
                    removeFilesListInput.value = oldImage2;
                } else {
                    removeFilesListInput.value = removeFilesListInput.value + "," + oldImage2;
                }
            }

        }, false);

        const rmfileSelect3 = document.getElementById("RemoveImage3"),
            rmfileElem3 = document.getElementById("profile_pic3")
        rmfileSelect3.addEventListener("click", function(e) {

            if (rmfileElem3) {
                rmfileElem3.value = "";
                img3 = document.getElementById("image3");
                oldImage3 = img3.src.substr(img3.src.lastIndexOf("/") + 1);
                img3src = img3.src;
                if (mainImageElement.src == img3src.replace("thumbnail", "mainimage")) {
                    mainImageElement.src = "/images/blank-profile-picture.png";
                }
                img3.src = "/images/blank-profile-picture.png";
                if (removeFilesListInput.value == "") {
                    removeFilesListInput.value = oldImage3;
                } else {
                    removeFilesListInput.value = removeFilesListInput.value + "," + oldImage3;
                }
            }

        }, false);

        const rmfileSelect4 = document.getElementById("RemoveImage4"),
            rmfileElem4 = document.getElementById("profile_pic4")
        rmfileSelect4.addEventListener("click", function(e) {

            if (rmfileElem4) {
                rmfileElem4.value = "";
                img4 = document.getElementById("image4");
                oldImage4 = img4.src.substr(img4.src.lastIndexOf("/") + 1);
                img4src = img4.src;
                if (mainImageElement.src == img4src.replace("thumbnail", "mainimage")) {
                    mainImageElement.src = "/images/blank-profile-picture.png";
                }
                img4.src = "/images/blank-profile-picture.png";
                if (removeFilesListInput.value == "") {
                    removeFilesListInput.value = oldImage4;
                } else {
                    removeFilesListInput.value = removeFilesListInput.value + "," + oldImage4;
                }
            }

        }, false);

        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
    @endsection