<!DOCTYPE html>
<html>
<?php require_once('connection/connection.php'); ?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>CMS</title>

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="css/custom-frontend.css">


    <!-- Font Awesome JS -->
    <link rel="stylesheet" href="fontawesome/css/all.min.css">
    <link rel="stylesheet" href="fontawesome/css/all.css">
    <link rel="stylesheet" href="fontawesome/css/solid.css">
    <link rel="stylesheet" href="fontawesome/css/solid.min.css">
    <link rel="stylesheet" href="css/main-menu.css">

</head>

<body>
    <div class="wrapper">
        <?php include 'includes/sidepanel.inc.php'?>
        <div id="content">
            <?php
            session_start();
            
            if (!isset($_SESSION["table"])) {
                header("Location:tablelisting.php");
            }
            
                if(isset($_POST['qtyBtn'])) {
        
                        $orderID = $_POST['quantityOrderID'];
                        $orderedFood = $_POST['quantityOrderFood'];
                        $editQty = $_POST['editQuantity'];


                        $sql="UPDATE order_list SET quantity = '".$editQty."' WHERE order_id = '".$orderID."' AND ordered_food = '".$orderedFood."'";
                    
                        $connection->query($sql);



                }
        
        
        
                if(isset($_POST['update_order_id']) && isset($_POST['update_ordered_food'])) {
                    $order_id = $_POST['update_order_id'];
                    $ordered_food = $_POST['update_ordered_food'];
                    
                    $sql="UPDATE order_list SET order_status = 2 WHERE order_id = '".$order_id."' AND ordered_food = '".$ordered_food."'";
                    $connection->query($sql);
                   
                }
    
                
    
                if(isset($_POST['deleteorderid']) && isset($_POST['deleteorderedfood'])) {
                    $deleteorderid = $_POST['deleteorderid'];
                    $deleteorderedfood = $_POST['deleteorderedfood'];
                    
                    $sql="DELETE FROM order_list WHERE order_id = $deleteorderid AND ordered_food = $deleteorderedfood;";
                    $connection->query($sql);
                    $connection->close();
                }
        
        
        if(isset($_GET['table'])) {
            $table_no = base64_decode($_GET['table']);
            $_SESSION["tableno"] = $table_no;
                
            $showFood = showJoins($connection, "SELECT *  FROM order_list INNER JOIN menu
            ON ordered_food = food_id WHERE ordered_table = '$table_no' AND order_status != 0 ORDER BY order_id");
        }
        
        $sum_total = 0;
    
    
    $connection->close();
    
    ?>
            <div class="table-container">



                <div class="row mt-2">
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                        <h1>Table No: <?php echo $table_no ?></h1>
                    </div>

                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 tab-pane active" id="display">
                        <table class="table table-borded table-striped">
                            <thead class="thead-dark">
                                <tr>
                                    <th class="w-30 text-center">Status</th>
                                    <th class="w-20">OrderID#</th>
                                    <th class="w-10">FoodID#</th>
                                    <th class="w-10">Name</th>
                                    <th class="w-10 text-center">Quantity</th>
                                    <th class="w-10 text-center">Unit Price</th>
                                    <th class="w-10 text-center">Total Price</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php foreach($showFood as $food) {?>
                                <tr>
                                    <td class="w-30 pt-4 text-center">
                                        <?php 
                                        if($food['order_status'] == 1) {
                                           echo '<i class="fas fa-clock fa-2x text-danger"></i>';
                                        } else if ($food['order_status'] == 2) {
                                           echo '<i class="fas fa-check fa-2x text-success"></i>';
                                        }
                                        
                                    ?>


                                    </td>
                                    <td class="w-20 pt-4"><?php echo $food['order_id']?></td>
                                    <td class="w-10 pt-4"><?php echo $food['food_id']?></td>
                                    <td class="w-10 pt-4"><?php echo $food['food_name']?></td>
                                    <td class="w-10 pt-4 text-center"><?php echo $food['quantity']?></td>
                                    <td class="w-10 pt-4 text-center"><?php echo $food['food_price']?></td>
                                    <td class="w-10 pt-4 text-center">
                                        <?php $total = $food['food_price'] * $food['quantity'];
                                               echo number_format((float)$total, 2, '.', '');
                                                $sum_total += $total;
                                                
                                        ?>
                                    </td>
                                </tr>
                                <?php } 
                                ?>

                            </tbody>
                        </table>

                    </div>
                    <div class="col-10 col-sm-10 col-md-10 col-lg-10">

                    </div>
                    <div class="col-2 col-sm-2 col-md-2 col-lg-2 text-center">
                        <hr />
                        <p class="font-weight-bold text-dark">Sum Total (RM):</p>
                        <p class="font-weight-bold text-dark"><?php echo number_format((float)$sum_total, 2, '.', ''); ?></p>
                    </div>


                </div>
                <?php include("payment.php"); ?>

                <!--Edit modal -->

                <div class="modal fade" id="editableModal" tabindex="-1" role="dialog" aria-labelledby="teachersModalLabel" aria-hidden="true">
                    <div class="modal-dialog text-center" role="document">
                        <div class="modal-content">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <div class="modal-body row">

                                <div class="col-12 col-md-12">
                                    <h5 class="modal-title" id="editableLabel">Edit Item #<span id="editID" value=""></span></h5>

                                </div>
                                <div class="col-12 col-md-12 text-center">
                                    <form id="qtyUpdateForm" action="kitcheninbox2.php" method="POST" enctype="multipart/form-data">
                                        <div id="updateFood" class="row mt-3">

                                            <input id="getOrderID" class="form-control quantityOrderID" type="hidden" name="quantityOrderID" placeholder="id" value="">

                                            <input id="getOrderFood" class="form-control quantityOrderedFood" type="hidden" name="quantityOrderFood" placeholder="id" value="">



                                            <br />
                                            <div class="col-12 col-sm-12 col-md-12 col-lg-12 text-left mb-4">
                                                <input id="editQuantityid" class="form-control editQuantity" type="number" name="editQuantity" placeholder="Name" value="">
                                            </div>


                                            <div class="col-12 col-sm-12 col-md-12 col-lg-12 text-left formbtn">
                                                <button id="updateQuantitybtn" type="submit" value="qtyFood" class="btn btn-success enbtn btn-md" name="qtyBtn">UPDATE</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>

            </div>

            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center" style="padding-top:15px; padding-bottom:15px;">
                    <div id="anchorUp" class="text-center" style="width:70px; height:70px; border-radius:50%; background-color:#CCC; margin:0 auto; 
          color:white; font-size:30px; padding-top:15px; box-shadow:0 0 8px rgba(0,0,0,.4);" onclick="up();">
                        <i class="fas fa-chevron-up "></i>
                    </div>
                </div>

            </div>





        </div>

    </div>

    <!--Edit modal -->


    <?php include 'includes/footer.inc.php'?>
    <script language="JavaScript">
        $(document).ready(function() {
            $('#sidebarCollapse').on('click', function() {
                $('#sidebar').toggleClass('active');
            });


        });

        function deleteFood($order_id, $ordered_food) {
            //get the input value
            $.ajax({
                //type. for eg: GET, POST
                type: "POST",
                //on success     
                //the url to send the data to
                url: "kitcheninbox2.php",
                //the data to send to
                data: {
                    deleteorderid: $order_id,
                    deleteorderedfood: $ordered_food
                },
                success: function() {
                    $(".table-container").load("kitcheninbox2.php .table-container");
                }

            });

        }


        function updateStatus($order_id, $ordered_food) {
            //get the input value
            $.ajax({
                //type. for eg: GET, POST
                type: "POST",
                //the url to send the data to
                url: "kitcheninbox2.php",
                //the data to send to
                data: {
                    update_order_id: $order_id,
                    update_ordered_food: $ordered_food
                },
                //on success
                success: function() {
                    alert("Data sent"),
                        $(".table-container").load("kitcheninbox2.php .table-container");

                }
            });
        }

        $('.modalButton').on('click', function() {
            $('#editableModal').modal('show');
            $tr = $(this).closest('tr');
            var data = $tr.children("td").map(function() {
                return $(this).text();
            }).get();

            console.log(data);

            var numID = data[0];

            $("#editID").html(numID);
            $(".quantityOrderID").val(data[0]);
            $(".quantityOrderedFood").val(data[1]);
            $(".editQuantity").val(data[3]);


        });

        $('#qtyUpdateForm').submit(function(e) {

            e.preventDefault;

            var form = $(this);
            var url = form.attr('action');

            $.ajax({
                //type. for eg: GET, POST
                type: "POST",
                //the url to send the data to
                url: url,
                //the data to send to
                data: form.serialize(),
                //on success
                success: function() {
                    alert("Data sent"),
                        $(".table-container").load("kitcheninbox2.php .table-container");

                }
            });


        });

    </script>


</body>

</html>
