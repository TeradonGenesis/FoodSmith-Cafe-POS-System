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


            <?php include 'includes/nav.inc.php'?>
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
    
    
           
    
    $showFood = showJoins($connection, "SELECT *  FROM order_list INNER JOIN menu
ON ordered_food = food_id WHERE order_status = 1 ORDER BY order_id");
    
    
    $connection->close();
    
    ?>

            

            <div class="table-container">



                <div class="row mt-2">

                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 tab-pane active" id="display">
                        <table class="table table-borded table-striped">
                            <thead class="thead-dark">
                                <tr>
                                    <th class="col-2">OrderID#</th>
                                    <th class="col-2">FoodID#</th>
                                    <th class="col-3">Name</th>
                                    <th class="col-1">Table</th>
                                    <th class="col-1 text-center">Quantity</th>
                                    <th class="col-3 text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php foreach($showFood as $food) {?>
                                <tr>
                                    <td class="col-2 pt-4"><?php echo $food['order_id']?></td>
                                    <td class="col-2 pt-4"><?php echo $food['food_id']?></td>
                                    <td class="col-3 pt-4"><?php echo $food['food_name']?></td>
                                    <td class="col-1 pt-4"><?php echo $food['ordered_table']?></td>
                                    <td class="col-1 pt-4 text-center"><?php echo $food['quantity']?></td>
                                    <td class="col-3 pt-4 text-center">
                                        <div class="row text-center">
                                            <div class="col-12 col-sm-4 col-md-4 col-lg-4 formbtn">
                                                <button onclick=" updateStatus(<?php echo $food['order_id'] ?>, <?php echo $food['ordered_food']; ?>)" value="hide" class="btn btn-success enbtn btn-md" name="hide"><i class="fas fa-check"></i></button>
                                            </div>
                                            <div class="col-12 col-sm-4 col-md-4 col-lg-4 formbtn">
                                                <button value="edit" class="btn btn-warning enbtn btn-md modalButton" name="editable"><i class="fas fa-edit"></i></button>
                                            </div>
                                            <div class="col-12 col-sm-4 col-md-4 col-lg-4 formbtn deleteButton">
                                                <button onclick="deleteFood(<?php echo $food['order_id'] ?>, <?php echo $food['ordered_food']; ?>)" value="delete" class="btn btn-danger enbtn btn-md" name="delete"><i class="fas fa-trash-alt"></i></button>
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
                                    <form id="qtyUpdateForm" action="kitcheninbox2.php" method="POST" enctype="multipart/form-data">
                                        <div id="updateFood" class="row mt-3">

                                            <input id="getOrderID" class="form-control quantityOrderID" type="hidden" name="quantityOrderID" placeholder="id" value="">
                                            
                                            <input id="getOrderFood" class="form-control quantityOrderedFood" type="hidden" name="quantityOrderFood" placeholder="id" value="">
                                            
                                            

                                            <br />
                                            <div class="col-12 col-sm-12 col-md-12 col-lg-12 text-left mb-4">
                                                <input id="editQuantityid" class="form-control editQuantity" type="number" name="editQuantity" placeholder="Name" value="">
                                            </div>
                                        

                                            <div class="col-12 col-sm-12 col-md-12 col-lg-12 text-left formbtn">
                                                <button id= "updateQuantitybtn" type="submit" value="qtyFood" class="btn btn-success enbtn btn-md" name="qtyBtn">UPDATE</button>
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
