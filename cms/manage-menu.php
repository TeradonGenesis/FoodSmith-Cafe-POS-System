<!DOCTYPE html>
<html>
<?php require_once('../connection/connection.php'); ?>

<head>
    <?php include 'head.php'?>


</head>

<body>

    <div class="wrapper">
        <?php include 'sidepanel.php'?>
        <div id="content">

            <?php include 'nav.php'?>
            <?php 
    
                if(isset($_POST['submit']) && $_POST['submit'] == "submit") {

                    if(isset($_POST['name']) && !empty($_POST['name'])) {

                        $name = $_POST['name'];
                        $addCategories = insertFoodCategory($connection, $name);

                    }
                    
                    if(isset($_POST['price']) && !empty($_POST['price'])) {

                        $name = $_POST['name'];
                        $addCategories = insertFoodCategory($connection, $name);

                    }
                    

                } else if (isset($_POST['submit']) && $_POST['submit'] == "reset"){

                    if(isset($_POST['name']) && !empty($_POST['name'])) {

                        $name = null;

                    }
                    
                    if(isset($_POST['price']) && !empty($_POST['price'])) {

                        $name = null;

                    }
                }
           
    
    $showCategories = show($connection, "food_category", "category_id != ''", "category_id");
    
    $connection->close();
    
    ?>

            <button type="button" class="btn collapsebtn" data-toggle="collapse" data-target="#addFood"><i class="fas fa-plus"></i> Add food</button>

            <form action="manage-menu.php" method="post">
                <div id="addFood" class="row collapse mt-3">

                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 mb-2 text-left formbtn">
                        <button type="submit" value="upload" class="btn btn-primary enbtn btn-md" name="upload"><i class="fas fa-upload"></i> Upload picture</button>
                    </div>
                    <div class="col-12 col-sm-4 col-md-4 col-lg-4 text-left mb-2">
                        <input class="form-control" type="text" name="name" placeholder="Name">
                    </div>
                    <div class="col-12 col-sm-4 col-md-4 col-lg-4 text-left mb-2">
                        <input class="form-control" type="text" name="price" placeholder="Price eg. 2.50">
                    </div>
                    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 text-left mb-4">
                        <select name="type" class="form-control">
                            <option selected="" hidden="" value="">Category</option>
                            <option value="Rice">Rice</option>
                            <option value="Noodle">Noodle</option>
                            <option value="Hot Drink">Hot Drink</option>
                            <option value="Cold Drink">Cold Drink</option>
                        </select>
                    </div>

                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 text-left formbtn">
                        <button type="submit" value="submit" class="btn btn-success enbtn btn-md" name="submit">ADD</button>
                        <button type="submit" value="reset" class="btn btn-danger enbtn btn-md" name="submit">RESET</button>
                    </div>
                </div>
            </form>

            <p class="mt-3"><i class="fas fa-search"></i> Search food</p>
            <form action="index.php" method="post">
                <div id="searchFood" class="row mt-3">

                    <div class="col-12 col-sm-12 col-md-3 col-lg-3 text-left mb-2">
                        <input class="form-control" type="text" name="name" placeholder="Name">
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 text-left mb-4">
                        <select name="type" class="form-control">
                            <option selected="" hidden="" value="">Value</option>
                            <option value=">">More than</option>
                            <option value="<">Less than</option>
                            <option value="=">Equal to</option>
                        </select>
                    </div>

                    <div class="col-12 col-sm-12 col-md-3 col-lg-3 text-left mb-2">
                        <input class="form-control" type="text" name="price" placeholder="Price e.g. 20.30">
                    </div>


                    <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 text-left mb-4">
                        <select name="type" class="form-control">
                            <option selected="" hidden="" value="">Category</option>
                            <option value="Rice">Rice</option>
                            <option value="Noodle">Noodle</option>
                            <option value="Hot Drink">Hot Drink</option>
                            <option value="Cold Drink">Cold Drink</option>
                        </select>
                    </div>

                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 text-left formbtn">
                        <button type="submit" value="submit" class="btn btn-success enbtn btn-md" name="submit">SEARCH</button>
                        <button type="submit" value="reset" class="btn btn-danger enbtn btn-md" name="submit">RESET</button>
                    </div>
                </div>
            </form>

            <nav class="mt-5">
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#display" role="tab" aria-controls="nav-home" aria-selected="true">Display</a>
                    <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#notdisplay" role="tab" aria-controls="nav-profile" aria-selected="false">Not display</a>
                </div>
            </nav>


            <div class="row mt-2 tab-content">
                <div class="col-12 col-sm-12 col-md-12 col-lg-12 tab-pane active" id="display">
                    <table class="table table-borded table-striped">
                        <thead class="thead-dark">
                            <tr>
                                <th class="col-1">#</th>
                                <th class="col-2">Image</th>
                                <th class="col-3">Name</th>
                                <th class="col-1 text-center">Price</th>
                                <th class="col-2">Category</th>
                                <th class="col-3 text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>


                            <tr>
                                <td class="col-1">#</td>
                                <td class="col-2"><img src="" alt="Missing" /></td>
                                <td class="col-3">Name</td>
                                <td class="col-1 text-right">20.30</td>
                                <td class="col-2">Category</td>
                                <td class="col-3 text-center">
                                    <div class="row text-center">
                                        <div class="col-12 col-sm-4 col-md-4 col-lg-4 formbtn">
                                            <button type="submit" value="display" class="btn btn-primary enbtn btn-md" name="submit"><i class="fas fa-eye-slash"></i></button>
                                        </div>
                                        <div class="col-12 col-sm-4 col-md-4 col-lg-4 formbtn">
                                            <button type="submit" value="edit" class="btn btn-warning enbtn btn-md" name="submit"><i class="fas fa-edit"></i></button>
                                        </div>
                                        <div class="col-12 col-sm-4 col-md-4 col-lg-4 formbtn">
                                            <button type="submit" value="delete" class="btn btn-danger enbtn btn-md" name="submit"><i class="fas fa-trash-alt"></i></button>
                                        </div>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td class="col-1">#</td>
                                <td class="col-2"><img src="" alt="Missing" /></td>
                                <td class="col-3">Name</td>
                                <td class="col-1 text-right">120.30</td>
                                <td class="col-2">Category</td>
                                <td class="col-3 text-center">
                                    <div class="row text-center">
                                        <div class="col-12 col-sm-4 col-md-4 col-lg-4 formbtn">
                                            <button type="submit" value="display" class="btn btn-primary enbtn btn-md" name="submit"><i class="fas fa-eye-slash"></i></button>
                                        </div>
                                        <div class="col-12 col-sm-4 col-md-4 col-lg-4 formbtn">
                                            <button type="submit" value="edit" class="btn btn-warning enbtn btn-md" name="submit"><i class="fas fa-edit"></i></button>
                                        </div>
                                        <div class="col-12 col-sm-4 col-md-4 col-lg-4 formbtn">
                                            <button type="submit" value="delete" class="btn btn-danger enbtn btn-md" name="submit"><i class="fas fa-trash-alt"></i></button>
                                        </div>
                                    </div>
                                </td>
                            </tr>

                        </tbody>
                    </table>

                </div>

                <div class="col-12 col-sm-12 col-md-12 col-lg-12 tab-pane" id="notdisplay">
                    <table class="table table-borded table-striped">
                        <thead class="thead-dark">
                            <tr>
                                <th class="col-1">#</th>
                                <th class="col-2">Image</th>
                                <th class="col-3">Name</th>
                                <th class="col-1 text-center">Price</th>
                                <th class="col-2">Category</th>
                                <th class="col-3 text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>


                            <tr>
                                <td class="col-1">#</td>
                                <td class="col-2"><img src="" alt="Missing" /></td>
                                <td class="col-3">Name</td>
                                <td class="col-1 text-right">20.30</td>
                                <td class="col-1">Category</td>
                                <td class="col-3 text-center">
                                    <div class="row text-center">
                                        <div class="col-12 col-sm-4 col-md-4 col-lg-4 formbtn">
                                            <button type="submit" value="notdisplay" class="btn btn-primary enbtn btn-md" name="submit"><i class="fas fa-eye"></i></button>
                                        </div>
                                        <div class="col-12 col-sm-4 col-md-4 col-lg-4 formbtn">
                                            <button type="submit" value="edit" class="btn btn-warning enbtn btn-md" name="submit"><i class="fas fa-edit"></i></button>
                                        </div>
                                        <div class="col-12 col-sm-4 col-md-4 col-lg-4 formbtn">
                                            <button type="submit" value="delete" class="btn btn-danger enbtn btn-md" name="submit"><i class="fas fa-trash-alt"></i></button>
                                        </div>
                                    </div>
                                </td>
                            </tr>

                        </tbody>
                    </table>

                </div>

            </div>



        </div>

    </div>
    <?php include 'footer.php'?>
</body>

</html>
