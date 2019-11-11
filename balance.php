<!DCOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>CMS</title>

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="css/custom-frontend.css">
    <link rel="stylesheet" href="css/custom.css">


    <!-- Font Awesome JS -->
    <link rel="stylesheet" href="fontawesome/css/all.min.css">
    <link rel="stylesheet" href="fontawesome/css/all.css">
    <link rel="stylesheet" href="fontawesome/css/solid.css">
    <link rel="stylesheet" href="fontawesome/css/solid.min.css">
    <link rel="stylesheet" href="css/main-menu.css">

</head>

    <body>
        <?php
        require_once('connection/connection.php');
        session_start();
        if (!isset($_SESSION["price"])) {
            header("Location:tablelisting.php");
        }
        if((isset($_POST["custom_amount"]) && ($_POST["custom_amount"] >= $_SESSION["price"]))) {
            $_SESSION["amount"] = $_POST["custom_amount"];
        } else if (isset($_POST["amount"])) {
            $_SESSION["amount"] = $_POST["amount"];
        } else {
            $_SESSION["amount"] = $_POST["price"];
        }
        $balance = $_SESSION["amount"] - $_SESSION["price"];
        $price = $_SESSION["price"];
        $tableno = $_SESSION["tableno"];
        updateTableOrder($connection, "order_list","0","$tableno");
        updateTableStatus($connection, "table_listing","0","$tableno");
        insertTransaction($connection, $price);
        ?>
        <div class="wrapper">
           <?php include 'includes/sidepanel.inc.php'?>
           <div id="content">
           <div class="jumbotron show_balance">
           <div class="row">
            <div class="col-md-12"><h1>RM <?php echo $balance; ?></h1></div>
            </div>
            <div class="row">
            <div class="bottom-buttons">
               <div class="col-md-12 col-sm-12 col-lg-12">
               <p><a href="mailto:231555215@outlook.com"><button type="button" class="btn btn-success">Mail Transaction</button></a></p></div>
               <div class="col-md-12 col-sm-12 col-lg-12">
               <p><a href="foodordercart.php"><button type="button" class="btn btn-success">Main Menu</button></a></p></div>
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
        <?php 
        unset($_SESSION["price"]);
        unset($_SESSION["tableno"]);
        session_destroy(); ?>
        
          
        
        <!--Bootstrap JS-->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <script>
            $('.table tbody').on('click','.btn',function(){
                $(this).closest('tr').remove(); //removes the closest table row, in this case, the table row where the delete button is pressed
            });
            
            $('#resetBtn').on('click',function(){
               $('#table tbody').empty(); //empties the table
                $('#totalAmt').text("RM 0");
            });
        </script>
    </body>
</html>