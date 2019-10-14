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
    
                $showModals = null;
                $modalName = '';
    
                if(isset($_POST['modalid'])) {
                    $modalid = $_POST['modalid'];
                    
                    $showModals = show($connection, "menu", "food_id = $modalid", "food_id DSEC LIMIT 1");
                    $modalName = $showModals['food_name'];
                    $modalPrice = $showModals['food_price'];
                    
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
                
    
           
    
    $showFood = showJoins($connection, "SELECT *  FROM menu INNER JOIN food_category
ON menu.category = food_category.category_id WHERE menu.status = 1 ORDER BY menu.food_id");
    
   $hideFood = showJoins($connection, "SELECT *  FROM menu INNER JOIN food_category
ON menu.category = food_category.category_id WHERE menu.status = 2 ORDER BY menu.food_id");
    
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

            <div class="table-container">

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

                                <?php foreach($showFood as $food) {?>
                                <tr>
                                    <td class="col-1 pt-4"><?php echo $food['food_id']?></td>
                                    <td class="col-2"><img class="foodpics" src="../images/<?php echo $food['food_picture'] ?>" alt="<?php echo $food['food_picture'] ?>" width="70" height="70" /></td>
                                    <td class="col-3 pt-4"><?php echo $food['food_name']?></td>
                                    <td class="col-1 pt-4 text-right"><?php echo $food['food_price']?></td>
                                    <td class="col-2 pt-4"><?php echo $food['category_name']?></td>
                                    <td class="col-3 pt-4 text-center">
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

                                <?php foreach($hideFood as $hfood) {?>
                                <tr>
                                    <td class="col-1 pt-4"><?php echo $hfood['food_id']?></td>
                                    <td class="col-2"><img class="foodpics" src="../images/<?php echo $hfood['food_picture'] ?>" alt="<?php echo $hfood['food_picture'] ?>" width="70" height="70" /></td>
                                    <td class="col-3 pt-4"><?php echo $hfood['food_name']?></td>
                                    <td class="col-1 pt-4 text-right"><?php echo $hfood['food_price']?></td>
                                    <td class="col-2 pt-4"><?php echo $hfood['category_name']?></td>
                                    <td class="col-3 pt-4 text-center">
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
                                        <div id="addFood" class="row mt-3">

                                            <div class="col-12 col-sm-12 col-md-12 col-lg-12 mb-4 text-left uploading">
                                                <span class="btn btn-primary btn-file">
                                                    <i class="fas fa-upload"></i> Browse<input id="editPhoto" type="file" name="file" class="file-input">
                                                </span>
                                                <span id="edit-file-label">No file</span>
                                            </div>
                                            <br />
                                            <div class="col-12 col-sm-12 col-md-12 col-lg-12 text-left mb-4">
                                                <input id="editName" class="form-control" type="text" name="name" placeholder="Name" value="<?php echo $modalName ?>">
                                            </div>
                                            <br />
                                            <div class="col-12 col-sm-12 col-md-12 col-lg-12 text-left mb-4">
                                                <input id="editPrice" class="form-control" type="text" name="price" placeholder="Price eg. 2.50" value="<?php echo $modalPrice?>">
                                            </div>
                                            <br />
                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-left mb-4">
                                                <select id="editCategory" name="category" class="form-control">
                                                    <option selected="" hidden="" value="">Category</option>
                                                    <?php foreach($showCategories as $showCategory) { ?>
                                                    <option value="<?php echo $showCategory['category_id']; ?>"><?php echo $showCategory['category_name']; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <br />

                                            <div class="col-12 col-sm-12 col-md-12 col-lg-12 text-left formbtn">
                                                <button type="submit" value="submit" class="btn btn-success enbtn btn-md" name="submit">ADD</button>
                                                <button type="submit" value="reset" class="btn btn-danger enbtn btn-md" name="submit">RESET</button>
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

    <div id="activateModal">
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
                                <div id="addFood" class="row mt-3">

                                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 mb-4 text-left uploading">
                                        <span class="btn btn-primary btn-file">
                                            <i class="fas fa-upload"></i> Browse<input id="editPhoto" type="file" name="file" class="file-input">
                                        </span>
                                        <span id="edit-file-label">No file</span>
                                    </div>
                                    <br />
                                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 text-left mb-4">
                                        <input id="editName" class="form-control" type="text" name="name" placeholder="Name" value="<?php echo $modalName ?>">
                                    </div>
                                    <br />
                                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 text-left mb-4">
                                        <input id="editPrice" class="form-control" type="text" name="price" placeholder="Price eg. 2.50" value="<?php echo $modalPrice?>">
                                    </div>
                                    <br />
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-left mb-4">
                                        <select id="editCategory" name="category" class="form-control">
                                            <option selected="" hidden="" value="">Category</option>
                                            <?php foreach($showCategories as $showCategory) { ?>
                                            <option value="<?php echo $showCategory['category_id']; ?>"><?php echo $showCategory['category_name']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <br />

                                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 text-left formbtn">
                                        <button type="submit" value="submit" class="btn btn-success enbtn btn-md" name="submit">ADD</button>
                                        <button type="submit" value="reset" class="btn btn-danger enbtn btn-md" name="submit">RESET</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>

    <?php include 'footer.php'?>
    <script language="JavaScript">
        function deleteFood($id) {
            //get the input value
            $.ajax({
                //type. for eg: GET, POST
                type: "POST",
                //on success     
                //the url to send the data to
                url: "manage-menu.php",
                //the data to send to
                data: {
                    deleteid: $id
                },
                success: function() {
                    $(".table-container").load("manage-menu.php .table-container ", function() {

                        $('.modalButton').click(function(e) {
                            e.preventDefault();
                            $('#editableModal').modal('show');
                            $tr = $(this).closest('tr');
                            var data = $tr.children("td").map(function() {
                                return $(this).text();
                            }).get();
                            var url = $(this).closest('tr').find('img').attr('src').replace('../images/', '');
                            var category = $(this).closest('tr').find('#editCategory').attr('value');

                            $("#edit-file-label").html(url);
                            $("#editID").html(data[0]);
                            $("#editName").val(data[2]);
                            $("#editPrice").val(data[3]);

                            $cat = data[4];

                            $("#editCategory option").filter(function() {
                                return $(this).text() == $cat;
                            }).prop("selected", true);
                        });
                    });
                }

            });



        }

    </script>


</body>

</html>
