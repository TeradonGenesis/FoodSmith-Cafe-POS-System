<!DOCTYPE html>
<html>
<?php require_once('connection/connection.php'); ?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Table Listing</title>

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
            if(isset($_SESSION)) {
                session_unset();
                $_SESSION["table"] = 1;
            } else {
                session_start();
                $_SESSION["table"] = 1;
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
    
    
           
    
    $showTables = showJoins($connection, "SELECT *  FROM table_listing WHERE table_id != '' ORDER BY table_no");
    
    
    $connection->close();
    
    ?>



            
                <div class="row">
                    
                    <?php foreach($showTables as $table) { ?>
                    <div class="col-12 col-sm-2 col-md-2 col-lg-2 text-center ">

                        <div class="card">
                            <div class="card-content mb-3">
                                <div class="card-title text-center" style="font-size:72px;">
                                   <?php echo $table['table_no']; ?>
                                </div>
                            </div>
                            <div class="card-read-more big-button-menu">
                                <a href="orderdetails.php?table=<?php echo base64_encode($table['table_no']); ?>" class="btn btn-block stretched-link text-white font-weight-bold <?php if($table['status'] == 0) {
                                            echo "bg-success";
    
                                            } else {
                                                echo "bg-danger";
                                            }
    
                                    ?>">
                                    <?php if($table['status'] == 0) {
                                            echo "FREE";
    
                                            } else {
                                                echo "OCCUPIED";
                                            }
    
                                    ?>
                                </a>
                            </div>
                        </div>

                    </div>
                    <?php } ?>



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
