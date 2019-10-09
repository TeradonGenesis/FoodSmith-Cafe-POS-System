<!DOCTYPE html>
<html>
<?php require_once('../connection/connection.php'); ?>

<head>
    <?php include 'head.php'?>
    <?php 
    
        if(isset($_POST['submit']) && $_POST['submit'] == "submit") {
            
            if(isset($_POST['name']) && !empty($_POST['name'])) {
                
                $name = $_POST['name'];
                $addCategories = insertFoodCategory($connection, $name);
                
            }
            
        } else if (isset($_POST['submit']) && $_POST['submit'] == "reset"){
            
            if(isset($_POST['name']) && !empty($_POST['name'])) {
                
                $name = null;
                
            }
        }
           
    
    $showCategories = show($connection, "food_category", "category_id != ''", "category_id");
    
    $connection->close();
    
    ?>

</head>

<body>

    <div class="wrapper">
        <?php include 'sidepanel.php'?>
        <div id="content">

            <?php include 'nav.php'?>

            <p><i class="fas fa-plus"></i> Add category</p>

            <form action="manage-food-category.php" method="post">
                <div id="addCategory" class="row mt-3">
                    <div class="col-12 col-sm-4 col-md-4 col-lg-4 text-left mb-2">
                        <input class="form-control" type="text" name="name" placeholder="Category name">
                    </div>

                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 text-left formbtn">
                        <button type="submit" value="submit" class="btn btn-success enbtn btn-md" name="submit">ADD</button>
                        <button type="submit" value="reset" class="btn btn-danger enbtn btn-md" name="submit">RESET</button>
                    </div>
                </div>
            </form>


            <div class="row mt-5">
                <div class="col-12 col-sm-12 col-md-12 col-lg-8 tab-pane active" id="display">
                    <table class="table table-borded table-striped" id="categoryTable">
                        <thead class="thead-dark">
                            <tr>
                                   <th class="col-1">Category Name</th>
                                <th class="col-4">Category Name</th>
                                <th class="col-3 text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php foreach($showCategories as $showCategory) { ?>
                            <tr>
                               <td class="col-4"><?php echo $showCategory['category_id']?></td>
                                <td class="col-4"><?php echo $showCategory['category_name']?></td>
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
                            <?php } ?>
                            
                        </tbody>
                    </table>

                </div>
            </div>


      



        </div>

    </div>
    <?php include 'footer.php'?>
</body>

</html>
