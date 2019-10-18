<!DCOCTYPE html>
<html lang="en">
    <head>
        <title>Food Order Cart</title>
        <!--Required meta tags-->
        <meta charset="utf-8"/>
        <meta name="viewport" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"/>
        <!--Bootstrap CSS-->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"/>
        <link rel="stylesheet" href="css/custom.css"/>
        
        
    </head>
    <body>
        <?php
        require_once('connection/connection.php');
        session_start();
        $balance = $_POST["amount"] - $_SESSION["price"];
        $orderid=$_SESSION["orderid"];
        echo $orderid;
        updateTableStatus($connection, "table_listing","0","$orderid");
        updateTableOrder($connection, "table_listing","0","$orderid");
        ?>
        <div class="container">
            <div class="show_balance">
                <h1>RM <?php echo $balance; ?></h1>
            </div>
            <div class="bottom-buttons">
                <p><a href="mailto:231555215@outlook.com"><button type="button" class="btn btn-success">Mail Transaction</button></a></p>
                <p><a href="foodordercart.php"><button type="button" class="btn btn-success">Main Menu</button></a></p>
            </div>
        </div>
        
          
        
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