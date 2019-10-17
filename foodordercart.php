<!DCOCTYPE html>
    <html lang="en">
    <?php require_once('connection/connection.php'); ?>

    <?php 

        $foods = show($connection, "menu", "food_id != '' AND status = 1", "food_id");
        $categories = show($connection, "food_category", "category_id !=''", "category_id");
        $connection->close();
    ?>

    <head>
        <title>Food Order Cart</title>
        <!--Required meta tags-->
        <meta charset="utf-8" />
        <meta name="viewport" href="css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous" />
        <!--Bootstrap CSS-->
        <link rel="stylesheet" href="css/bootstrap.min.css" />
        <link rel="stylesheet" href="fontawesome/css/all.min.css" />
        <link rel="stylesheet" href="css/foodlisting.css" />



    </head>

    <body>
        <div class="container-fluid">
            <!--NavBar area-->
            <div class="row">
                <div class="col-md-2 col-sm-2 lulw">
                    <div class="col-md-12 innerNav">
                        <p class="text-center mb-0 mt-5">Navigation Bar</p>
                        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                            <a class="nav-link active foodNav" id="v-pills-home-tab" data-toggle="pill" href="foodordercart.php" role="tab" aria-controls="v-pills-home" aria-selected="true"><i class="fas fa-bacon"></i> All Food</a>
                            <?php foreach($categories as $category) { ?>
                            <a class="nav-link drinksNav" id="v-pills-profile-tab" data-toggle="pill" href="foodordercart.php" role="tab" aria-controls="v-pills-profile" aria-selected="false"><i class="fas fa-cocktail"></i> <?php echo $category['category_name'] ?></a>
                            <?php } ?>

                        </div>
                    </div>
                </div>
                <!--Menu Area-->
                <div class="col-md-7 col-sm-7 lulw2">
                    <!--First row for the food items-->
                    <div class="row food1">
                        <?php foreach($foods as $food) { ?>
                        <div class="col-md-3 col-sm-3 customCard mb-2">
                            <div class="card">
                                <img src="images/<?php echo $food['food_picture']?>" class="card-img-top img-fluid" height="100%" alt="...">
                                <div class="card-body text-center">
                                    <a href="#" class="btnfood1 btn-transparent"><?php echo $food['food_name']?></a>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                    <!--Second row for the food items-->


                </div>
                <!--Food Order Cart-->
                <div class="col-md-3 lulw3">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="sel1">Select table:</label>
                                <select class="form-control" id="sel1">
                                    <option value="" selected="" type="hidden">Table No</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-12 text-center">
                            <!--Autoincremented based on Order ID in database-->
                            <?php
                                date_default_timezone_set("Asia/Kuala_Lumpur");
                                $id=date('dmYHis');
                                echo '<p>Order ID: <span id="orderID">'.$id.'</span></p>';
                            ?>
                        </div>
                        <div class="col-md-12 ">
                            <table id="table" class="table">
                                <thead>
                                    <th scope="col">Delete</th>
                                    <th scope="col">Item</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Price</th>
                                </thead>
                                <tbody>
                                    <!--Stand in data, hardcoded-->
                                    <!--<tr class="deleteRow">
                                        <th scope="row">
                                            <button type="button" class="btn btn-danger btn-sm">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </th>
                                        <td>Item 1</td>
                                        <td>
                                            <input class="form-control" type="number" value="1" />
                                        </td>
                                        <td class="price">50.00</td>
                                    </tr>

                                    <tr class="deleteRow">
                                        <th scope="row">
                                            <button type="button" class="btn btn-danger btn-sm">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </th>
                                        <td>Item 1</td>
                                        <td>
                                            <input class="form-control" type="number" value="1" />
                                        </td>
                                        <td class="price">10.00</td>
                                    </tr>-->
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-6 ">
                            <p class="text-center" id="totalprice">TOTAL PRICE:</p>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <p id="totalAmt" class="text-center">0.00</p>
                        </div>
                        <div class="col-md-12">
                            <p class="text-center">
                                <button type="button" id="submitBtn" class="btn btn-primary">Submit</button>
                                <button type="button" id="resetBtn" class="btn btn-danger">Reset</button>
                            </p>
                        </div>
                    </div>
                </div>

            </div>

        </div>




        <!-- jQuery CDN - Slim version (=without AJAX) -->
        <!-- Popper.JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
        <!-- Bootstrap JS -->

        <script src="../js/jquery.tabledit.js"></script>
        <script src="../js/jquery.js"></script>
        <script src="../js/jquery-3.4.1.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>
        <script>
            var _totalPrice = 0.00;
            $('#totalAmt').html(_totalPrice.toFixed(2));

            function updatePrice() {
                _totalPrice = 0.00;
                $('.table tbody tr').each(function(rowIndex) {

                    $(this).find('td.price').each(function() {
                        _totalPrice += parseFloat($(this).html());
                    });
                });

                $('#totalAmt').html(_totalPrice.toFixed(2));
            }

            $('.table tbody').on('click', '.btn', function() {
                $(this).closest('tr').remove(); //removes the closest table row, in this case, the table row where the delete button is pressed
                updatePrice();
            });

            $('#resetBtn').on('click', function() {
                $('#table tbody').empty(); //empties the table
                $('#totalAmt').text("RM 0");
            });

        
            $('#submitBtn').on('click', function() {

                var _tableNo;
                var _orderid;
                var _foodname;
                var _qty;
                var _price;

                _tableNo = parseInt($('#sel1 :selected').text());
                _price = _totalPrice;
                _orderid = parseInt($('#orderID').html());

                $.ajax({
                    type: "POST",
                    url: "connection/insertID.php",
                    data: {
                        id: _orderid,
                    }
                    
                });
                
                $('.table tbody tr').each(function(rowIndex){
                    $(this).find('.food-item-name').each(function(){
                        _foodname=$(this).html();
                    });
                    $(this).find('input').each(function(){
                       _qty=$(this).val(); 
                    });
                    $(this).find('td.price').each(function(){
                       _price=$(this).html(); 
                    });
                    
                    $.ajax({
                       type:"POST",
                        url:"connection/insertOrder.php",
                        data:{
                            id:_orderid,
                            food:"Test",
                            table:1
                        }
                        
                    });
                    
                });
                //window.location.reload();
                //this iterates through the table row, extracts the required data then inserts into SQL(yet to be implemented)

            });
            $('.btnfood1').on('click', function() {
                var _name = $('.btnfood1').text();
                var _tr = '<tr class="deleteRow"><th scope="row"><button type="button" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button></th><td class="food-item-name">' + _name + '</td><td><input class="form-control" type="number" value="1"/></td><td class="price">50.00</td></tr>'
                $('tbody').append(_tr);
                updatePrice();
            });


            $('.table tbody').on('change', 'tr', function() {
                var _qty;
                var _price;
                var _increase;

                $(this).find('input').each(function() {
                    _qty = $(this).val();
                });
                $(this).find('td.price').each(function() {
                    _price = $(this).html();
                });

                _increase = _qty * _price;

                updatePrice();
                $(this).find('td.price').each(function() {
                    $(this).html(_increase.toFixed(2));
                });
                updatePrice();
            });

        </script>
    </body>

    </html>
