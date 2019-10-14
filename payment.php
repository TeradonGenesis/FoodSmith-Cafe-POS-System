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
        session_start();
            $round_one = ceil($_SESSION["price"]); //rounds up the price to nearest 1 
            $round_ten = ceil($_SESSION["price"]/10) * 10; //rounds up the price to nearest 10
        ?>
        <div class="container">
            <section class="payment-section">
                <h2>Payment</h2>
                <form name="paymentform" method="POST" action="balance.php">
            <div class="row">
                <div class="col-md-6 payment-top">    
                        <input type="number" placeholder="Custom" name="amount" />
                </div>
                <div class="col-md-6 payment-top">
                    <p><button type="submit" class="btn btn-success payment-button" name="amount" value="<?php echo $_SESSION["price"]; ?>">Exact</button></p>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-3 payment-top">
                    <p><button type="submit" class="btn btn-success payment-button" name="amount" value="<?php echo $round_one; ?>"><?php echo $round_one; ?></button></p>
                </div>
                <div class="col-md-3 payment-top">
                    <p><button type="submit" class="btn btn-success payment-button" name="amount" value="<?php echo $round_ten; ?>"><?php echo $round_ten; ?></button></p>
                </div>
                <?php if($_SESSION["price"] <= 50) { ?>
                <div class="col-md-3 payment-top">
                    <p><button type="submit" class="btn btn-success payment-button" name="amount" value="50">50</button></p>
                </div>
                <?php } ?>
                <?php if($_SESSION["price"] <= 100) { ?>
                <div class="col-md-3 payment-top">
                    <p><button type="submit" class="btn btn-success payment-button" name="amount" value="100">100</button></p>
                </div>
                <?php } ?>
                 </div>
                </form>
            </section>
            <?php require_once('orderdetails.php'); ?>
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