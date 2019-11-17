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
    
                if(isset($_POST['updateFood'])) {
                    
                        $updateID = $_POST['updateID'];
                        $updateName = $_POST['updateName'];
                        $updatePrice = $_POST['updatePrice'];
                        $updateCategory = $_POST['updateCategory'];
                    
                        
                        $fileName = $_FILES['updateFile']['name'];
                        $fileTmpName = $_FILES['updateFile']['tmp_name'];
                        $fileSize = $_FILES['updateFile']['size'];
                        $fileError = $_FILES['updateFile']['error'];
                        $fileType = $_FILES['updateFile']['type'];
                        
                        $fileExt = explode('.', $fileName);
                        $fileActualExt = strtolower(end($fileExt));
                        
                        $allowed = array('jpg', 'jpeg', 'png');
                        
                        if(in_array($fileActualExt, $allowed)) {
                            if($fileError === 0) {
                                if($fileSize < 5000000) {
                                    $fileNameNew = uniqid('', true).".".$fileActualExt;
                                    
                                    $fileDestination = '../images/'.$fileNameNew;
                                    
                                    move_uploaded_file($fileTmpName, $fileDestination);
                                    
                                    $updateStuff = updateFoodItemwithPicture($connection, "menu", $updateID, $fileNameNew, $updateName, $updatePrice, $updateCategory);
                                    $success = "Food Updated";
                                    
                                    
                                    
                                } else {
                                    $uploadStatus = "File size is too big";
                                    $success = "Fail to add food";
                                }
                                
                            } else {
                               $uploadStatus = "There was an error uploading the file"; 
                                $success = "Fail to add food";
                            }
                        } else {
                            $uploadStatus =  "You cannot upload files of this type";
                            $success = "Fail to add food";
                        }
                    
                    $updateStuff = updateFoodItem($connection, "menu", $updateID, $updateName, $updatePrice, $updateCategory);
                                    $success = "Food Updated";
                }
    
                
                if(isset($_POST['status']) && isset($_POST['id'])) {
                    $status = $_POST['status'];
                    $id = $_POST['id'];
                    
                    if ($status == 1) {
                        $update = updateHideStatus($connection, "menu", "2", $id);
                    } else if($status == 2) {
                        $update = updateHideStatus($connection, "menu", "1", $id);
                    }
                    
                }
    
                if(isset($_POST['deleteid'])) {
                    $deleteid = $_POST['deleteid'];
                    
                    $sql="DELETE FROM menu WHERE food_id = $deleteid;";
                    $connection->query($sql);
                    $connection->close();
                }
    
    
    
    
    
                $success = '';
                $uploadStatus = '';
                $alert = '';
                $alert_price = '';
                $alert_name = '';
                $alert_category = '';
                $invalid_name = '';
                $invalid_price = '';
                $invalid_category = '';
    
                if(isset($_POST['submit']) && $_POST['submit'] == "submit") {

                    if(isset($_POST['name']) && !empty($_POST['name']) && isset($_POST['price']) && !empty($_POST['price']) && isset($_FILES['file']) && isset($_POST['category']) && !empty($_POST['category'])) {

                        $name = $_POST['name'];
                        $price = $_POST['price'];
                        $category = $_POST['category'];
                        
                        $fileName = $_FILES['file']['name'];
                        $fileTmpName = $_FILES['file']['tmp_name'];
                        $fileSize = $_FILES['file']['size'];
                        $fileError = $_FILES['file']['error'];
                        $fileType = $_FILES['file']['type'];
                        
                        $fileExt = explode('.', $fileName);
                        $fileActualExt = strtolower(end($fileExt));
                        
                        $allowed = array('jpg', 'jpeg', 'png');
                        
                        if(in_array($fileActualExt, $allowed)) {
                            if($fileError === 0) {
                                if($fileSize < 5000000) {
                                    $fileNameNew = uniqid('', true).".".$fileActualExt;
                                    
                                    $fileDestination = '../images/'.$fileNameNew;
                                    
                                    move_uploaded_file($fileTmpName, $fileDestination);
                                    
                                    $addFood = insertMenu($connection, $fileNameNew, $name, $price, $category);
                                    $success = "Food Added";
                                    
                                    
                                    
                                } else {
                                    $uploadStatus = "File size is too big";
                                    $success = "Fail to add food";
                                }
                                
                            } else {
                               $uploadStatus = "There was an error uploading the file"; 
                                $success = "Fail to add food";
                            }
                        } else {
                            $uploadStatus =  "You cannot upload files of this type";
                            $success = "Fail to add food";
                        }
                        

                    } else {
                        $success = "Fail to add food";
                    }
                    
                    $pattern = '/^(0|[1-9]\d*)(\.\d{2})?$/';
                    
                    if (empty($_POST['price'])) {
                        $alert_price = "Please enter a price";
                        $invalid_price = 'is-invalid';
                        
                    } else if (isset($_POST['price']) && preg_match($pattern, $_POST['price']) == '0') {
                       $alert_price = "Only numbers and one . is allowed";
                        $invalid_price = 'is-invalid';
                    }
                    
                    if (empty($_POST['name'])) {
                        $alert_name = "Please enter a name";
                        $invalid_name = 'is-invalid';
                        
                    }
                    
                    if (empty($_POST['category'])) {
                        $alert_category = "Please select a category";
                        $invalid_category = 'is-invalid';
                        
                    }
    

                } 
    
                //Search form
                $name_cond = null;
                $type_cond = null;
                if(isset($_POST['searchSubmit'])) {
        
                    $name = $_POST['searchName'];
                    $type = $_POST['searchType'];

                    if(isset($_POST['searchName']) && !empty($_POST['searchName'])){
                            $name_cond = " AND (food_name REGEXP '[[:<:]]".$name."[[:>:]]' )";
                    } else {
                        $name_cond = null;
                    } 

                    if(isset($_POST['searchType']) && !empty($_POST['searchType'])){
                            $type_cond = " AND (category = '$type')";
                    } else {
                        $type_cond = null;
                    }
                }
                
    
           
    
    $showFood = showJoins($connection, "SELECT *  FROM menu INNER JOIN food_category
ON menu.category = food_category.category_id WHERE menu.status = 1 $name_cond $type_cond ORDER BY menu.food_id");
    
   $hideFood = showJoins($connection, "SELECT *  FROM menu INNER JOIN food_category
ON menu.category = food_category.category_id WHERE menu.status = 2 $name_cond $type_cond ORDER BY menu.food_id");
    
    $showCategories = show($connection, "food_category", "category_id != ''", "category_name");
    
    $connection->close();
    
    ?>

            <!--<button type="button" class="btn collapsebtn" data-toggle="collapse" data-target="#addFood"><i class="fas fa-plus"></i> Add food</button>
            <p></p>--->
            <p class="mt-2"><i class="fas fa-plus"></i> Add food</p>
            <p class="text-danger"><?php echo $success ?></p>
            <form id="addFoodForm" action="manage-menu.php" method="POST" enctype="multipart/form-data">
                <div id="addFood" class="row mt-3">

                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 mb-2 text-left uploading" id="uploadPhoto">
                        <span class="btn btn-primary btn-file">
                            <i class="fas fa-upload"></i> Browse<input type="file" name="file" class="file-input" id="addPhoto">
                        </span>
                        <span class="file-label">No file</span>
                        <p>* Required</p>
                        <p class="text-danger"><?php echo $uploadStatus; ?></p>
                    </div>
                    <div class="col-12 col-sm-4 col-md-4 col-lg-4 text-left mb-2">
                        <input id="addName" class="form-control <?php echo $invalid_name; ?>" type="text" name="name" value="" placeholder="Food name">
                        <?php if ($alert_name !== '') {
                            echo "<p class ='text-danger'>".$alert_name."</p>"; 
                        } else {
                            echo "<p>* Required</p>"; 
                        } ?>
                    </div>
                    <div class="col-12 col-sm-4 col-md-4 col-lg-4 text-left mb-2">
                        <input id="addPrice" class="form-control <?php echo $invalid_price; ?>" type="text" name="price" value="" placeholder="Price eg. 2.50">
                        <?php if ($alert_price !== '') {
                            echo "<p class ='text-danger'>".$alert_price."</p>"; 
                        } else {
                            echo "<p>* Required</p>"; 
                        } ?>
                    </div>
                    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 text-left mb-4">
                        <select id="addCategory" name="category" class="form-control <?php echo $invalid_category; ?>">
                            <option selected="" hidden="" value="">Category</option>
                            <?php foreach($showCategories as $showCategory) { ?>
                            <option value="<?php echo $showCategory['category_id']; ?>"><?php echo $showCategory['category_name']; ?></option>
                            <?php } ?>
                        </select>
                        <?php if ($alert_category !== '') {
                            echo "<p class ='text-danger'>".$alert_category."</p>"; 
                        } else {
                            echo "<p>* Required</p>"; 
                        } ?>
                    </div>

                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 text-left formbtn">
                        <button id="submitForm" type="submit" value="submit" class="btn btn-success enbtn btn-md" name="submit">ADD</button>
                        <button type="submit" value="reset" class="btn btn-danger enbtn btn-md" name="reset">RESET</button>
                    </div>
                </div>
            </form>
            <p class="form-message"></p>

            <p class="mt-3"><i class="fas fa-search"></i> Search food</p>
            <form action="manage-menu.php" method="post">
                <div id="searchFood" class="row mt-3">

                    <div class="col-12 col-sm-12 col-md-3 col-lg-3 text-left mb-2">
                        <input id="searchNameID" class="form-control" type="text" name="searchName" placeholder="Name">
                    </div>


                    <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 text-left mb-4">
                        <select id="searchTypeID" name="searchType" class="form-control">
                            <option selected="" hidden="" value="">Category</option>
                            <?php foreach($showCategories as $showCategory) { ?>
                            <option value="<?php echo $showCategory['category_id']; ?>"><?php echo $showCategory['category_name']; ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 text-left formbtn">
                        <button id="searchSubmitID" type="submit" value="submit" class="btn btn-success enbtn btn-md" name="searchSubmit">SEARCH</button>
                        <button id="searchResetID" type="submit" value="reset" class="btn btn-danger enbtn btn-md" name="searchReset">RESET</button>
                    </div>
                </div>
            </form>

            <div class="table-container">

                <nav class="mt-5">
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#display" role="tab" aria-controls="nav-home" aria-selected="true">Display</a>
                        <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#notdisplay" role="tab" aria-controls="nav-profile" aria-selected="false">Not display</a>
                    </div>
                </nav>


                <div class="row mt-2 tab-content">

                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 tab-pane active" id="display">
                       <p>Click on the headers to sort by column</p>
                        <input type='hidden' id='sort' value='asc'>
                        <table id="foodTableID" class="table table-borded table-striped">
                            <thead class="thead-dark">
                                <tr>
                                    <th class="w-5"><span onclick='sortTable("food_id");'>ID</span></th>
                                    <th class="w-15">Image</th>
                                    <th class="w-20"><span onclick='sortTable("food_name");'>Name</span></th>
                                    <th class="w-15 text-center"><span onclick='sortTable("food_price");'>Price</span></th>
                                    <th class="w-15"><span onclick='sortTable("category_name");'>Category</span></th>
                                    <th class="w-30 text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php foreach($showFood as $food) {?>
                                <tr>
                                    <td class="w-5 pt-4"><?php echo $food['food_id']?></td>
                                    <td class="w-15"><img class="foodpics" src="../images/<?php echo $food['food_picture'] ?>" alt="<?php echo $food['food_picture'] ?>" width="70" height="70" /></td>
                                    <td class="w-20 pt-4"><?php echo $food['food_name']?></td>
                                    <td class="w-15 pt-4 text-center"><?php echo $food['food_price']?></td>
                                    <td class="w-15 pt-4"><?php echo $food['category_name']?></td>
                                    <td class="w-30 pt-4 text-center">
                                        <div class="row text-center">
                                            <div class="col-12 col-sm-4 col-md-4 col-lg-4 formbtn">
                                                <button onclick=" updateStatus(<?php echo $food['status']; ?>, <?php echo $food['food_id']; ?>)" value="hide" class="btn btn-primary enbtn btn-md" name="hide"><i class="fas fa-eye-slash"></i></button>
                                            </div>
                                            <div class="col-12 col-sm-4 col-md-4 col-lg-4 formbtn">
                                                <button value="edit" class="btn btn-warning enbtn btn-md modalButton" name="editable"><i class="fas fa-edit"></i></button>
                                            </div>
                                            <div class="col-12 col-sm-4 col-md-4 col-lg-4 formbtn deleteButton">
                                                <button onclick="deleteFood(<?php echo $food['food_id']; ?>)" value="delete" class="btn btn-danger enbtn btn-md" name="delete"><i class="fas fa-trash-alt"></i></button>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <?php } ?>

                            </tbody>
                        </table>

                    </div>

                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 tab-pane" id="notdisplay">
                       <p>Click on the headers to sort by column</p>
                        <input type='hidden' id='sort' value='asc'>
                        <table id="foodTableID2" class="table table-borded table-striped">
                            <thead class="thead-dark">
                                <tr>
                                    <th class="w-5"><span onclick='sortTable2("food_id");'>ID</th>
                                    <th class="w-15">Image</th>
                                    <th class="w-20"><span onclick='sortTable2("food_name");'>Name</th>
                                    <th class="w-15 text-center"><span onclick='sortTable2("food_price");'>Price</th>
                                    <th class="w-15"><span onclick='sortTable2("category_name");'>Category</th>
                                    <th class="w-30 text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php foreach($hideFood as $hfood) {?>
                                <tr>
                                    <td class="w-5 pt-4"><?php echo $hfood['food_id']?></td>
                                    <td class="w-15"><img class="foodpics" src="../images/<?php echo $hfood['food_picture'] ?>" alt="<?php echo $hfood['food_picture'] ?>" width="70" height="70" /></td>
                                    <td class="w-20 pt-4"><?php echo $hfood['food_name']?></td>
                                    <td class="w-15 pt-4 text-center"><?php echo $hfood['food_price']?></td>
                                    <td class="w-15 pt-4"><?php echo $hfood['category_name']?></td>
                                    <td class="w-30 pt-4 text-center">
                                        <div class="row text-center">
                                            <div class="col-12 col-sm-4 col-md-4 col-lg-4 formbtn">
                                                <button onclick=" updateStatus(<?php echo $hfood['status']; ?>, <?php echo $hfood['food_id']; ?>)" value="hide" class="btn btn-primary enbtn btn-md" name="hide"><i class="fas fa-eye"></i></button>
                                            </div>
                                            <div class="col-12 col-sm-4 col-md-4 col-lg-4 formbtn">
                                                <button value="edit" class="btn btn-warning enbtn btn-md modalButton" name="editable"><i class="fas fa-edit"></i></button>
                                            </div>
                                            <div class="col-12 col-sm-4 col-md-4 col-lg-4 formbtn deleteButton">
                                                <button onclick="deleteFood(<?php echo $hfood['food_id']; ?>)" value="delete" class="btn btn-danger enbtn btn-md" name="delete"><i class="fas fa-trash-alt"></i></button>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <?php }?>

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
                                    <form action="manage-menu.php" method="POST" enctype="multipart/form-data">
                                        <div id="updateFood" class="row mt-3">

                                            <input id="getID" class="form-control " type="hidden" name="updateID" placeholder="id" value="">

                                            <div class="col-12 col-sm-12 col-md-12 col-lg-12 mb-4 text-left uploading">
                                                <span class="btn btn-primary btn-file">
                                                    <i class="fas fa-upload"></i> Browse<input id="editPhoto" type="file" name="updateFile" class="file-input">
                                                </span>
                                                <span id="edit-file-label">No file</span>
                                            </div>
                                            <br />
                                            <div class="col-12 col-sm-12 col-md-12 col-lg-12 text-left mb-4">
                                                <input id="editName" class="form-control" type="text" name="updateName" placeholder="Name" value="">
                                            </div>
                                            <br />
                                            <div class="col-12 col-sm-12 col-md-12 col-lg-12 text-left mb-4">
                                                <input id="editPrice" class="form-control" type="text" name="updatePrice" placeholder="Price eg. 2.50" value="">
                                            </div>
                                            <br />
                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-left mb-4">
                                                <select id="editCategory" name="updateCategory" class="form-control">
                                                    <option selected="" hidden="" value="">Category</option>
                                                    <?php foreach($showCategories as $showCategory) { ?>
                                                    <option value="<?php echo $showCategory['category_id']; ?>"><?php echo $showCategory['category_name']; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <br />

                                            <div class="col-12 col-sm-12 col-md-12 col-lg-12 text-left formbtn">
                                                <button type="submit" value="updateFood" class="btn btn-success enbtn btn-md" name="updateFood">UPDATE</button>
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


    <?php include 'footer.php'?>
    <script src="../js/manage-menu.js"></script>


</body>

</html>
