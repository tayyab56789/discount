<?php 
    include('admin-header.php'); 
    $shop = new Shop();
    $values = array(
        "shop_id" => "'".$_GET["shop"]."'"
    );
        
        //["shopowner_id"] = $_SESSION["user_id"];
    
    //echo "<pre>";
    //print_r($result);
    //echo "</pre>";
    
    if(isset($_POST["add_product"])){
        //echo "<pre>";
        //print_r($_POST);
        //print_r($_FILES);
        //die;
        $icon='';
        //echo "</pre>";
        $file_upload_name= basename($_FILES["fileToUpload"]["name"]);
        $file_name = explode(".", $file_upload_name); 
        //print_r($file_name);
        $target_dir = "uploads/";
        $target_file = $target_dir . uniqid(). "_".$_POST["p_name"].'.'.$file_name[1];
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
        
        $product_data = array(
            "p_name" => $_POST["p_name"],
            "p_description" => $_POST["p_description"],
            "p_category" => $_POST["p_category"],
            "p_price" => $_POST["p_price"],
            "p_image_id" => $icon,
            "shop_id" => $_GET["shop"]
        );
        $products::addProduct($conn,$product_data);
    }

    if(isset($_POST["update_product"])) {
        $icon=$_POST['p_image_id'];
        //echo "</pre>";
        $file_upload_name= basename($_FILES["fileToUpload"]["name"]);
        $file_name = explode(".", $file_upload_name); 
        //print_r($file_name);
        $target_dir = "uploads/";
        $target_file = $target_dir . uniqid(). "_".$_POST["p_name"].'.'.$file_name[1];
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
        
        $product_data = array(
            "p_name" => $_POST["p_name"],
            "p_description" => $_POST["p_description"],
            "p_category" => $_POST["p_category"],
            "p_price" => $_POST["p_price"],
            "p_image_id" => $icon,
            "shop_id" => $_GET["shop"],
            "p_id" => $_POST["p_id"]
        );
        $products::updateProduct($conn,$product_data);
    }

   $result =  json_decode($products::selectProductsByShop($conn,$values)); 
//echo "<pre>";
//print_r($result);
//echo "</pre>";
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
                            <h2>Products</h2>
                            <div class="text-center">
                                <button type="button" class="btn btn-success " data-toggle="modal" data-target="#myModal">+ ADD NEW PRODUCT</button>&nbsp; &nbsp;<button onclick="goBack()" class="btn btn-default ">Go Back</button>
                            </div>


                            <!-- Modal -->
                            <div class="modal fade" id="myModal" role="dialog">
                                <div class="modal-dialog">

                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">Add a Product</h4>
                                        </div>
                                        <div class="modal-body">
                                            <form method="POST" action "" enctype="multipart/form-data">
                                                <lable>Product Name</lable>
                                                <input type="text" class="form-control" value="" name="p_name" required>
                                                <br>
                                                <lable>Product Description</lable>
                                                <textarea class="form-control" value="" name="p_description" id="p_description" required> </textarea>
                                                <br>
                                                <div class="form-group">
                                                  <label for="p_category">Select Category</label>
                                                  <select class="form-control" id="p_category" name="p_category">
                                                    <option value="clothing">clothing</option>
                                                    <option value="electronics">electronics</option>
                                                    <option value="restourant">restourant</option>
                                                    <option value="entertainment" > entertainment </option>
                                                  </select>
                                                </div>
                                                <div class="form-group">
                                                  <label for="p_price">Market price</label>
                                                  <input class="form-control" type="text" name="p_price" id="p_price">
                                                </div>
                                                <div class="text-center">
                                                    <div class="fileUpload btn btn-success" id="img_upload_00">
                                                        <span>Select image to upload</span>
                                                        <input type="file" name="fileToUpload" class="upload" />
                                                    </div>
                                                </div>

                                        </div>
                                        <div class="modal-footer">
                                            <input type="submit" class="btn btn-success" name="add_product" value="+ ADD PRODUCT">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        </div>
                                        </form>
                                    </div>

                                </div>
                            </div>
                            <table class="table table-bordered" id="test">
                                <thead>
                                    <tr >
                                        <th style="text-align:center;">#</th>
                                        <th style="text-align:center;">image</th>
                                        <th style="width:150px; text-align:center;">Product name</th>
                                        <th style="text-align:center;">Description</th>
                                        <th style="text-align:center;">category</th>
                                        
                                        <th style="text-align:center;">Normal Price</th>

                                        <th>Options</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    if(isset($result->products))
                            for($i = 0 ; $i< count($result->products); $i++) {
                                echo '
                                    <tr>

                                        <td class="text-center">'. ($i+1) .'</td>
                                        <td style="text-align:center;"><a href="add-discount.php?product='.$result->products[$i]->p_id.'" ><img src="'.$result->products[$i]->p_image_id.'" style="max-width:50px; max-height:50px;"></a></td>
                                        <td><a href="add-discount.php?product='.$result->products[$i]->p_id.'" >'.$result->products[$i]->p_name.'</a></td>
                                         <td>'.$result->products[$i]->p_description.'</td>
                                         <td>'.$result->products[$i]->p_category.'</td>
                                         <td>'.$result->products[$i]->p_price.'</td>
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        <td><i data-toggle="modal" data-target="#'.$result->products[$i]->p_id.'" class="fa fa-pencil-square-o edit-button" aria-hidden="true" data-id="'.$result->products[$i]->p_id.'" style="cursor:pointer;"></i>&nbsp; &nbsp; <i style="color:red; cursor:pointer;" data-id="'.$result->products[$i]->p_id.'" class="fa fa-times delete_shop" aria-hidden="true"></i><!-- Modal -->
                                          <div class="modal fade" id="'.$result->products[$i]->p_id.'" role="dialog">
                                            <div class="modal-dialog">

                                              <!-- Modal content-->
                                              <div class="modal-content">
                                                <div class="modal-header">
                                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                  <h4 class="modal-title">Edit Product</h4>
                                                </div>
                                                <div class="modal-body">
                                                  <form method="POST" action "" enctype="multipart/form-data">
                                                <lable>Product Name</lable>
                                                <input type="text" class="form-control" value="'.$result->products[$i]->p_name.'" name="p_name" required>
                                                <br>
                                                <lable>Product Description</lable>
                                                <textarea class="form-control" value="" name="p_description" id="p_description" required>'.$result->products[$i]->p_description.'</textarea>
                                                <br>
                                                <div class="form-group">
                                                  <label for="p_category">Select Category</label>
                                                  <select class="form-control" id="p_category" name="p_category">
                                                    <option '; 
                                                    
                                                    if($result->products[$i]->p_category == 'clothing') { echo ' selected ';}
                                                    echo'value="clothing">clothing</option>
                                                    <option'; 
                                                    
                                                    if($result->products[$i]->p_category == 'electronics') { echo ' selected ';}
                                                    echo' value="electronics">electronics</option>
                                                    <option'; 
                                                    
                                                    if($result->products[$i]->p_category == 'restourant') { echo ' selected ';}
                                                    echo' value="restourant">restourant</option>
                                                    <option'; 
                                                    
                                                    if($result->products[$i]->p_category == 'entertainment') { echo ' selected ';}
                                                    echo' value="entertainment" > entertainment </option>
                                                  </select>
                                                </div>
                                                <div class="form-group">
                                                  <label for="p_price">Market price</label>
                                                  <input class="form-control" type="text" name="p_price" id="p_price" value="'.$result->products[$i]->p_price.'">
                                                </div>
                                                <div class="text-center">
                                                    <div class="fileUpload btn btn-success" id="img_upload_00">
                                                        <span>Select image to upload</span>
                                                        <input type="file" name="fileToUpload" class="upload" />
                                                    </div>
                                                </div>
                                                <input type="hidden" value="'.$result->products[$i]->p_id.'" name="p_id">
                                                <input type="hidden" value="'.$result->products[$i]->p_image_id.'" name="p_image_id">
                                        </div>
                                        <div class="modal-footer">
                                            <input type="submit" class="btn btn-success" name="update_product" value="UPDATE PRODUCT">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        </div>
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
                        action: "deleteProduct",
                        p_id: id
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
