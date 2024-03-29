<!DOCTYPE html>
<html lang="en">
<?php require_once('../connection/connection.php'); ?>

<head>
    <?php include 'head.php'?>
    <?php 
    
        $category_status = null;
        $text_status = null;
        
        //Updating form
        if(isset($_POST['updateCat'])) {
        
                $updateID = $_POST['updateCatID'];
                $updateName = $_POST['updateCatName'];


                $updateStuff = updateCatItem($connection, "food_category", $updateID, $updateName);
            
                
                $category_status = "Category Updated";



        }
    
    
        //Inserting form    
        if(isset($_POST['submit']) && $_POST['submit'] == "submit") {
            
            if(isset($_POST['name']) && !empty($_POST['name'])) {
                
                $name = preg_replace('/\s+/', '', $_POST['name']);
                
                $number = checkDuplicate($connection, "food_category", "category_name  = '$name'", "category_id");
                
                if($number > 0){
                    
                    $category_status = "There is a category with a same name already! Category not added!";
                    $text_status = "text-danger";
                    
                } else {
                    
                    $addCategories = insertFoodCategory($connection, $name);
                    $category_status = "Category Added";
                    $text_status = "text-success";
                    
                }
                
            } else {
                $category_status = "Category not added";
                $text_status = "text-danger";
            }
            
        } else if (isset($_POST['submit']) && $_POST['submit'] == "reset"){
            
            if(isset($_POST['name']) && !empty($_POST['name'])) {
                
                $name = null;
                
            }
        }
    
    
        //Delete form
        if(isset($_POST['deleteid'])) {
                $deleteid = $_POST['deleteid'];

                $sql="DELETE FROM table_listing WHERE table_id = $deleteid;";
                $connection->query($sql);
                $connection->close();
        }
    
        //Search formj
        $name_cond = null;
        if(isset($_POST['searchSubmit'])) {

            $name = $_POST['searchCatName'];
    
            if(isset($_POST['searchCatName']) && !empty($_POST['searchCatName'])){
                    $name_cond = " AND (category_name REGEXP '[[:<:]]".$name."[[:>:]]' )";
            } else {
                $name_cond = null;
            } 

        }
           
    //echo out the content
    $showCategories = show($connection, "food_category", "category_id != '' $name_cond", "category_id");
    
    $connection->close();
    
    ?>

</head>

<body>

    <div class="wrapper">
        <?php include 'sidepanel.php'?>
        <div id="content">

            <?php include 'nav.php'?>

            <p><i class="fas fa-plus"></i> Add category</p>
            <p class="<?php echo $text_status ?>"><?php echo $category_status ?></p>

            <form action="manage-food-category.php" method="post">
                <div id="addCategory" class="row mt-3">
                    <div class="col-12 col-sm-4 col-md-4 col-lg-4 text-left mb-2">
                        <input class="form-control" type="text" name="name" placeholder="Category name">
                        <p>* Required</p>
                    </div>

                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 text-left formbtn">
                        <button type="submit" value="submit" class="btn btn-success enbtn btn-md" name="submit">ADD</button>
                        <button type="submit" value="reset" class="btn btn-danger enbtn btn-md" name="submit">RESET</button>
                    </div>
                </div>
            </form>
            
            <p class="mt-3"><i class="fas fa-search"></i> Search category</p>
            <form action="manage-food-category.php" method="post">
                <div id="searchCat" class="row mt-3">

                    <div class="col-12 col-sm-12 col-md-3 col-lg-3 text-left mb-2">
                        <input id="searchCatNameID" class="form-control" type="text" name="searchCatName" placeholder="Name">
                    </div>

                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 text-left formbtn">
                        <button id="searchSubmitID" type="submit" value="submit" class="btn btn-success enbtn btn-md" name="searchSubmit">SEARCH</button>
                        <button id="searchResetID" type="submit" value="reset" class="btn btn-danger enbtn btn-md" name="searchReset">RESET</button>
                    </div>
                </div>
            </form>

            <div class="table-container">
                <div class="row mt-5">
                    <div class="col-12 col-sm-12 col-md-12 col-lg-8 tab-pane active" id="display">
                       <p>Click on the headers to sort by column</p>
                        <input type='hidden' id='sort' value='asc'>
                        <table class="table table-borded table-striped" id="categoryTable">
                            <thead class="thead-dark">
                                <tr>
                                    <th class="w-25"><span onclick='sortTable("category_id");'>ID</span></th>
                                    <th class="w-25"><span onclick='sortTable("category_name");'>Category Name</span></th>
                                    <th class="w-40 text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php foreach($showCategories as $showCategory) { ?>
                                <tr>
                                    <td class="w-25"><?php echo $showCategory['category_id']?></td>
                                    <td class="w-25"><?php echo $showCategory['category_name']?></td>
                                    <td class="w-40 text-center">
                                        <div class="row text-center">
                                            <div class="col-12 col-sm-12 col-md-12 col-lg-12 formbtn">
                                                <button value="edit" class="btn btn-warning enbtn btn-md modalButton" name="editable"><i class="fas fa-edit"></i></button>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <?php } ?>

                            </tbody>
                        </table>

                    </div>
                </div>
            </div>

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
                                <form id="editCategoryForm" action="manage-food-category.php" method="POST" enctype="multipart/form-data">
                                    <div id="updateFood" class="row mt-3">

                                        <input id="getID" class="form-control " type="hidden" name="updateCatID" placeholder="id" value="">

                                        <br />
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 text-left mb-4">
                                            <input id="editName" class="form-control" type="text" name="updateCatName" placeholder="Name" value="">
                                        </div>
                                        <br />

                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 text-left formbtn">
                                            <button type="submit" value="updateFood" class="btn btn-success enbtn btn-md" name="updateCat">UPDATE</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>


                    </div>
                </div>
            </div>






        </div>

    </div>
    <?php include 'footer.php'?>
    <script src="../js/manage-category.js"></script>
</body>

</html>
