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

</head>

<body>

    <div class="wrapper">
        <?php include 'includes/sidepanel.inc.php'?>
        <div id="content">
            <?php 
    
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
        
                //Search form
                $number_cond = null;
                if(isset($_POST['searchSubmit'])) {

                    $number = $_POST['searchTableNumber'];

                    if(isset($_POST['searchTableNumber']) && !empty($_POST['searchTableNumber'])){
                            $number_cond = " AND (ordered_table ='$number') ";
                    } else {
                        $number_cond = null;
                    } 

                }


    
    $showFood = showJoins($connection, "SELECT *  FROM order_list INNER JOIN menu
ON ordered_food = food_id WHERE order_status = 1 $number_cond ORDER BY order_id");
    
    
    $connection->close();
    
    ?>
            <div class="container">
                    <p class="mt-3"><i class="fas fa-search"></i> Search Orders</p>

                <form action="kitcheninbox.php" method="post">
                    <div id="searchOrders" class="row mt-3">

                        <div class="col-12 col-sm-12 col-md-3 col-lg-3 text-left mb-2">
                            <input id="searchTableNumberID" class="form-control" type="text" name="searchTableNumber" placeholder="Table Number">
                        </div>

                        <div class="col-12 col-sm-12 col-md-4 col-lg-4 text-left formbtn">
                            <button id="searchSubmitID" type="submit" value="submit" class="btn btn-success enbtn btn-md" name="searchSubmit">SEARCH</button>
                            <button id="searchResetID" type="submit" value="reset" class="btn btn-danger enbtn btn-md" name="searchReset">RESET</button>
                        </div>
                    </div>
                </form>
            </div>



            <div class="table-container">


                <div class="col-12 col-sm-12 col-md-12 col-lg-12 tab-pane active" id="display">
                   <p>Click on the headers to sort by column</p>
                    <input type='hidden' id='sort' value='asc'>
                    <table id="kitchen-table" class="table table-borded table-striped">
                        <thead class="thead-dark">
                            <tr>
                                <th class="w-40"><span onclick='sortTable("order_id");'>OrderID#</span></th>
                                <th class="w-20"><span onclick='sortTable("food_id");'>FoodID#</span></th>
                                <th class="w-10"><span onclick='sortTable("food_name");'>Name</span></th>
                                <th class="w-5"><span onclick='sortTable("ordered_table");'>Table</span></th>
                                <th class="w-5 text-center"><span onclick='sortTable("quantity");'>Quantity</span></th>
                                <th class="w-20 text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php foreach($showFood as $food) {?>
                            <tr>
                                <td class="w-40 pt-4"><?php echo $food['order_id']?></td>
                                <td class="w-20 pt-4"><?php echo $food['food_id']?></td>
                                <td class="w-10 pt-4"><?php echo $food['food_name']?></td>
                                <td class="w-10 pt-4"><?php echo $food['ordered_table']?></td>
                                <td class="w-10 pt-4 text-center"><?php echo $food['quantity']?></td>
                                <td class="w-10 pt-4 text-center">
                                    <div class="row text-center">
                                        <div class="col-12 col-sm-4 col-md-4 col-lg-4 formbtn">
                                            <button onclick=" updateStatus(<?php echo $food['order_id'] ?>, <?php echo $food['ordered_food']; ?>)" value="hide" class="btn btn-success enbtn btn-md" name="hide"><i class="fas fa-check"></i></button>
                                        </div>
                                        <div class="col-12 col-sm-4 col-md-4 col-lg-4 formbtn">
                                            <button value="edit" class="btn btn-warning enbtn btn-md modalButton" name="editable"><i class="fas fa-edit"></i></button>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <?php } ?>

                        </tbody>
                    </table>

                </div>


            </div>

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
                                <form id="qtyUpdateForm" action="kitcheninbox.php" method="POST" enctype="multipart/form-data">
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


    <?php include 'includes/footer.inc.php' ?>
    <script src="js/kitcheninbox.js"></script>
</body>

</html>
