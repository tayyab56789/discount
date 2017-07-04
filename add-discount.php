<?php 
    include('admin-header.php'); 
    $shop = new Shop();
    $values = array(
        "p_id" => $_GET["product"]
    );
        
        //["shopowner_id"] = $_SESSION["user_id"];
    
    //echo "<pre>";
    //print_r($result);
    //echo "</pre>";
    
    if(isset($_POST["add_discount"])){
        //echo "<pre>";
        //print_r($_POST);
        //print_r($_FILES);
        
        
        $shop_data = array(
            "date_from" => '',
            "date_to" => $_POST['date_to'],
            "after_price" => $_POST['after_price'],
            "p_id" => $_GET['product']
        );
        $discount::addDiscount($conn,$shop_data);
    }

    
   $result =  json_decode($discount::showDiscountByProduct($conn,$values)); 
//echo "<pre>";
//print_r($result);
//echo "</pre>";

?>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
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
                            <h2>List of offers</h2>
                            <div class="text-center">
                                <button type="button" class="btn btn-success " data-toggle="modal" data-target="#myModal">+ ADD NEW OFFER</button> &nbsp; &nbsp;<button onclick="goBack()" class="btn btn-default ">Go Back</button>
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
                                                <lable>Offer till</lable>
                                                <input type="text" class="form-control date_input" value="" name="date_to"  required>
                                                <br>
                                                <lable>Offer price</lable>
                                                <input type="text" class="form-control" value="" name="after_price" required>
                                                <br>

                                        </div>
                                        <div class="modal-footer">
                                            <input type="submit" class="btn btn-success" name="add_discount" name="+ ADD OFFER">
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
                                        <th style="width:150px; text-align:center;">Offer till </th>
                                        <th style="text-align:center;">Offer Price</th>

                                        <th>Options</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    if(isset($result->discount))
                            for($i = 0 ; $i< count($result->discount); $i++) {
                                echo '
                                    <tr>

                                        <td class="text-center">'. ($i+1) .'</td>
                                        <td style="text-align:center;">'.$result->discount[$i]->date_to.'</td>
                                        <td>$'.$result->discount[$i]->after_price.'</td>
                                        <td> <i style="color:red; cursor:pointer;" data-id="'.$result->discount[$i]->d_id.'" class="fa fa-times delete_shop" aria-hidden="true"></i>
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
         $( ".date_input" ).datepicker({ dateFormat: "yy-mm-dd"});
        
        $('.delete_shop').click(function() {
            var id = $(this).data('id');
            //alert(id);
            var res = confirm('Do you want to delete shop?');
            if (res == true) {
                $.post("api/", {
                        action: "deleteDiscount",
                        d_id: id
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
