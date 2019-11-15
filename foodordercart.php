<!DCOCTYPE html>
    <html lang="en">
    <?php require_once('connection/connection.php'); ?>

    <?php 

        $foods = show($connection, "menu", "food_id != '' AND status = 1", "food_id");
        $categories = show($connection, "food_category", "category_id !=''", "category_id");
        $tables = show($connection, "table_listing", "table_id != ''", "table_no");
        $foodcat = showJoins($connection, "SELECT f.category_id,f.category_name,m.food_picture,m.food_name, m.food_price,m.food_id FROM food_category f INNER JOIN menu m ON f.category_id=m.category");
        $connection->close();
    ?>

    <head>
        <title>Food Order Cart</title>
        <!--Required meta tags-->
        <meta charset="utf-8" />
        <meta name="viewport" href="css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous" />
        <!--Bootstrap CSS-->
        <link rel="stylesheet" href="css/bootstrap.min.css" />
        <link rel="stylesheet" href="css/custom-frontend.css">
        <link rel="stylesheet" href="fontawesome/css/all.min.css" />
        <link rel="stylesheet" href="css/foodlisting.css" />

        <!-- Font Awesome JS -->
        <link rel="stylesheet" href="fontawesome/css/all.min.css">
        <link rel="stylesheet" href="fontawesome/css/all.css">
        <link rel="stylesheet" href="fontawesome/css/solid.css">
        <link rel="stylesheet" href="fontawesome/css/solid.min.css">



    </head>

    <body>
        <div class="wrapper h-100">

            <?php include 'includes/sidepanel.inc.php'?>
            <div class="content">
                <div class="container-fluid h-100">
                    <!--NavBar area-->
                    <div class="row h-100">
                        <div class="col-md-2 col-sm-2 lulw">
                            <div class="col-md-12 innerNav">                     
                                <nav id="categorybar" class="nav-pills" role="tablist" aria-orientation="vertical" id="v-pills-tab">
                                    <div class="categorybar-header">
                                        <h3>Category</h3>
                                    </div>
                                    <ul class="list-unstyled components">
                                    <li class="active2">
                                        <a href="foodordercart.php" id="v-pills-home-tab" data-toggle="pill" href="foodordercart.php" role="tab" aria-controls="v-pills-home" aria-selected="true" aria-orientation="vertical" class="nav-link">All food</a>
                                    </li>
                                    <?php
                                    foreach($categories as $category) { ?>
                                    <li class="active2">
                                        <a href="foodordercart.php" id="v-pills-profile-tab" data-toggle="pill" href="foodordercart.php" aria-controls="v-pills-profile" aria-selected="false" role="tab" class="nav-link"><?php echo $category['category_name'];?></a><?php } ?></li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                        <!--Menu Area-->
                        <div class="col-md-7 col-sm-7 lulw2">
                            <!--First row for the food items-->
                            <div class="row food1">
                                <?php foreach($foodcat as $food) { ?>
                                <div class="col-md-3 col-sm-3 customCard mb-2 <?php echo $food["category_name"].'-'.$food["category_name"];?>">
                                    <div class="card">
                                        <div class="overflow">
                                            <img src="images/<?php echo $food['food_picture']?>" class="card-img-top img-fluid" height="100%" alt="...">
                                        </div>
                                        <div class="card-body text-center"><input class="form-control foodid" type="hidden" name="foodid" value="<?php echo $food['food_id']?>"><p><?php echo $food['food_price']?></p>
                                            <a href="#" class="btnfood1 btn-transparent"><?php echo $food['food_name']?></a>
                                        </div>
                                    </div>
                                </div>
                                <?php } ?>
                            </div>
                            <!--Second row for the food items-->


                        </div>
                        <!--Food Order Cart-->
                        <div class="col-md-3 lulw3 text-white rounded">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="sel1">Select table:</label>
                                        <select class="form-control" id="sel1">
                                            <option value="" selected="" type="hidden">Table No</option>
                                            <?php foreach($tables as $table) { ?>
                                            <option value="<?php echo $table['table_no']?>"><?php echo $table['table_no']?></option>
                                            <?php }?>
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
                                <div class="col-md-12">
                                    <table id="table" class="table text-white">
                                        <thead>
                                            <th scope="col">Delete</th>
                                            <th scope="col">Item</th>
                                            <th scope="col">Quantity</th>
                                            <th scope="col">Unit Price</th>
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
            </div>
        </div>




        <!-- jQuery CDN - Slim version (=without AJAX) -->
        <!-- Popper.JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
        <!-- Bootstrap JS -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <script src="js/jquery.tabledit.js"></script>
        <script src="js/jquery.js"></script>
        <script src="js/jquery-3.4.1.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/foodordercart.js"></script>
    </body>

    </html>
