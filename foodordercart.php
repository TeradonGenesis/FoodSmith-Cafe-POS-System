<!DCOCTYPE html>
    <html lang="en">

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
                    <div class="col-md-12">
                        <p class="text-center mb-0 mt-5">Navigation Bar</p>
                        
                        <nav class="navbar navbar-dark  bg-dark" id="foodNavBar">
                            <ul class="navbar-nav nav-fill w-100">
                                <li class="nav-item">
                                    <a class="nav-link" href="#" id="foodNav"><i class="fas fa-bacon"></i> Food</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#" id="drinksNav"><i class="fas fa-cocktail"></i> Drinks</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#" id="desertNav"><i class="fas fa-ice-cream"></i> Desert</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <!--Menu Area-->
                <div class="col-md-7 col-sm-6 lulw2">
                    <!--First row for the food items-->
                    <div class="row food1">
                        <div class="col-md-3 col-sm-3 customCard">
                            <div class="card">
                                <img src="images/bacon.jpg" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <a href="#" class="btnfood1 btn-transparent">Order</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-3 customCard">
                            <div class="card">
                                <img src="images/bacon.jpg" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <a href="#" class="btnfood1 btn-transparent">Order</a>
                                </div>
                            </div>
                        </div>
                       <div class="col-md-3 col-sm-3 customCard">
                            <div class="card">
                                <img src="images/bacon.jpg" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <a href="#" class="btnfood1 btn-transparent">Order</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-3 customCard">
                            <div class="card">
                                <img src="images/bacon.jpg" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <a href="#" class="btnfood1 btn-transparent">Order</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--Second row for the food items-->
                     <div class="row food2">
                        <div class="col-md-3 col-sm-3 customCard">
                            <div class="card">
                                <img src="images/bacon.jpg" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <a href="#" class="btnfood1 btn-transparent">Order</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-3 customCard">
                            <div class="card">
                                <img src="images/bacon.jpg" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <a href="#" class="btnfood1 btn-transparent">Order</a>
                                </div>
                            </div>
                        </div>
                       <div class="col-md-3 col-sm-3 customCard">
                            <div class="card">
                                <img src="images/bacon.jpg" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <a href="#" class="btnfood1 btn-transparent">Order</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-3 customCard">
                            <div class="card">
                                <img src="images/bacon.jpg" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <a href="#" class="btnfood1 btn-transparent">Order</a>
                                </div>
                            </div>
                        </div>
                        

                    </div>

                </div>
                <!--Food Order Cart-->
                <div class="col-md-3 ml-auto lulw3">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="sel1">Select table:</label>
                                <select class="form-control" id="sel1">
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12 ">
                            <!--Autoincremented based on Order ID in database-->
                            Order ID autogenerated?
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
                                        <td>RM 50.00</td>
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
                                        <td>RM 50.00</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-6 ">
                            <p class="text-center" id="totalprice">TOTAL PRICE:</p>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <p id="totalAmt" class="text-center">RM 9000</p>
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




        <!--Bootstrap JS-->
        <script src="js/jquery-3.4.1.slim.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script>
            $('.table tbody').on('click', '.btn', function() {
                $(this).closest('tr').remove(); //removes the closest table row, in this case, the table row where the delete button is pressed
            });

            $('#resetBtn').on('click', function() {
                $('#table tbody').empty(); //empties the table
                $('#totalAmt').text("RM 0");
            });

        </script>
    </body>

    </html>
