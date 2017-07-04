<?php 
    include('admin-header.php'); 
    $shop = new Shop();
    $values = array(
        "shopowner_id" => "'".$_SESSION["user_id"]."'"
    );
        
        //["shopowner_id"] = $_SESSION["user_id"];
    
    //echo "<pre>";
    //print_r($result);
    //echo "</pre>";
    
    if(isset($_POST["add_shop"])){
        //echo "<pre>";
        //print_r($_POST);
        //print_r($_FILES);
        $icon='';
        //echo "</pre>";
        $file_upload_name= basename($_FILES["fileToUpload"]["name"]);
        $file_name = explode(".", $file_upload_name); 
        //print_r($file_name);
        $target_dir = "uploads/";
        $target_file = $target_dir . uniqid(). "_".$_POST["shop_name"].'.'.$file_name[1];
        $uploadOk = 1;
        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
        // Check if image file is a actual image or fake image
        if(isset($_POST["submit"])) {
            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if($check !== false) {
                echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }
        }
        // Check if file already exists
        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }
        // Check file size
        if ($_FILES["fileToUpload"]["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }
        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                //echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
                $icon = $target_file;
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
        
        $shop_data = array(
            "shop_name" => $_POST["shop_name"],
            "shop_icon" => $icon,
            "shopowner_id" => $_SESSION["user_id"]
        );
        $shop::registerShop($conn,$shop_data);
    }

    if(isset($_POST["update_shop"])) {
        $icon=$_POST['shop_icon'];
        //echo "</pre>";
        $file_upload_name= basename($_FILES["fileToUpload"]["name"]);
        $file_name = explode(".", $file_upload_name); 
        //print_r($file_name);
        $target_dir = "uploads/";
        $target_file = $target_dir . uniqid(). "_".$_POST["shop_name"].'.'.$file_name[1];
        $uploadOk = 1;
        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
        // Check if image file is a actual image or fake image
        if(isset($_POST["submit"])) {
            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if($check !== false) {
                echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }
        }
        // Check if file already exists
        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }
        // Check file size
        if ($_FILES["fileToUpload"]["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }
        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                //echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
                $icon = $target_file;
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
        
        $shop_data = array(
            "shop_name" => $_POST["shop_name"],
            "shop_icon" => $icon,
            "shopowner_id" => $_SESSION["user_id"],
            "shop_id" => $_POST["shop_id"]
        );
        $shop::updateShop($conn,$shop_data);
    }

   $result =  json_decode($shop::selectShopByShopowner($conn,$values)); 
?>
<style>
    tr {
        vertical-align: middle;
    }
    
    td {
        vertical-align: middle !important;
    }
    
    .fileUpload {
        position: relative;
        overflow: hidden;
        margin: 10px;
    }
    
    .fileUpload input.upload {
        position: absolute;
        top: 0;
        right: 0;
        margin: 0;
        padding: 0;
        font-size: 20px;
        cursor: pointer;
        opacity: 0;
        filter: alpha(opacity=0);
    }

</style>
<section class="main">
    <section class="tab-content">
        <section class="tab-pane active fade in content" id="dashboard">
            <div class="container-fluid">
                <div class="row">
                    <div class="container">
                        <div class="row">
                            <h2>Shops Owned</h2>
                            <div class="text-center">
                                <button type="button" class="btn btn-success " data-toggle="modal" data-target="#myModal">+ ADD NEW SHOP</button>
                            </div>


                            <!-- Modal -->
                            <div class="modal fade" id="myModal" role="dialog">
                                <div class="modal-dialog">

                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">Add a shop</h4>
                                        </div>
                                        <div class="modal-body">
                                            <form method="POST" action "" enctype="multipart/form-data">
                                                <lable>Shop Name</lable>
                                                <input type="text" class="form-control" value="" name="shop_name" required>
                                                <br>
                                                <div class="text-center">
                                                    <div class="fileUpload btn btn-success" id="img_upload_00">
                                                        <span>Select image to upload</span>
                                                        <input type="file" name="fileToUpload" class="upload" />
                                                    </div>
                                                </div>

                                        </div>
                                        <div class="modal-footer">
                                            <input type="submit" class="btn btn-success" name="add_shop" name="+ ADD SHOP">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        </div>
                                        </form>
                                    </div>

                                </div>
                            </div>
                            <table class="table table-bordered" id="test">
                                <thead>
                                    <tr style="background-color:black; color:white">
                                        <th style="text-align:center;">#</th>
                                        <th style="width:150px; text-align:center;">shop_icon</th>
                                        <th style="text-align:center;">shop_name</th>

                                        <th>Options</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    if(isset($result->shop))
                            for($i = 0 ; $i< count($result->shop); $i++) {
                                echo '
                                    <tr>

                                        <td class="text-center">'. ($i+1) .'</td>
                                        <td style="text-align:center;"><a href="add-product.php?shop='.$result->shop[$i]->shop_id.'" ><img src="'.$result->shop[$i]->shop_icon.'" style="max-width:50px; max-height:50px;"></a></td>
                                        <td><a href="add-product.php?shop='.$result->shop[$i]->shop_id.'" >'.$result->shop[$i]->shop_name.'</a></td>
                                        <td><i data-toggle="modal" data-target="#'.$result->shop[$i]->shop_id.'" class="fa fa-pencil-square-o edit-button" aria-hidden="true" data-id="'.$result->shop[$i]->shop_id.'" style="cursor:pointer;"></i>&nbsp; &nbsp; <i style="color:red; cursor:pointer;" data-id="'.$result->shop[$i]->shop_id.'" class="fa fa-times delete_shop" aria-hidden="true"></i><!-- Modal -->
                                          <div class="modal fade" id="'.$result->shop[$i]->shop_id.'" role="dialog">
                                            <div class="modal-dialog">

                                              <!-- Modal content-->
                                              <div class="modal-content">
                                                <div class="modal-header">
                                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                  <h4 class="modal-title">Edit Shop</h4>
                                                </div>
                                                <div class="modal-body">
                                                  <form method="POST" action"" enctype="multipart/form-data">
                                                   <div class="text-center"> <img id="img_'.$result->shop[$i]->shop_id.'" src="'.$result->shop[$i]->shop_icon.'" style=" max-height:100px;">
                                                   </div>
                                                   <br>
                                                    <lable>Shop Name</lable>
                                                    <input type="text" class="form-control" value="'.$result->shop[$i]->shop_name.'" name="shop_name" >
                                                    <br>
                                                    <div class="text-center">
                                                        <div class="fileUpload btn btn-success" id="img_upload_'.$result->shop[$i]->shop_id.'">
                                                            <span>Select image to upload</span>
                                                            <input type="file" name="fileToUpload" class="upload" />
                                                        </div>
                                                    </div>
                                                  <input type="hidden" name="shop_id" value="'.$result->shop[$i]->shop_id.'">
                                                  <input type="hidden" name="shop_icon" value="'.$result->shop[$i]->shop_icon.'">
                                                </div>
                                                <div class="modal-footer">
                                                  <input type="submit" class="btn btn-success" value="Update" name="update_shop">
                                                  <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                                  </form>
                                                </div>
                                              </div>

                                            </div>
                                          </div>
                                      </td>
                                    </tr>';
                                }
?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </section>
</section>

<script>
    $(document).ready(function() {
        $('.delete_shop').click(function() {
            var id = $(this).data('id');
            //alert(id);
            var res = confirm('Do you want to delete shop?');
            if (res == true) {
                $.post("api/", {
                        action: "deleteShop",
                        shop_id: id
                    })
                    .done(function(data) {
                        location.reload();
                    })
                    .fail(function() {
                    });

            }
        });
    });

</script>
<?php
    include('admin-footer.php');
?>
