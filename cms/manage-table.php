<!DOCTYPE html>
<html lang="en">
<?php require_once('../connection/connection.php'); ?>

<head>
    <?php include 'head.php'?>
    <?php 
    
        $table_status = null;
        $text_status = null;
    
        if(isset($_POST['updateTable'])) {
        
                $updateID = $_POST['updateID'];
                $updateName = $_POST['updateName'];
                $updateCategory = $_POST['updateCatName'];


                $updateStuff = updateTable ($connection, "table_listing", $updateID, $updateName, $updateCategory);
            
                
                $table_status = "Table Updated";



        }
    
        if(isset($_POST['submit']) && $_POST['submit'] == "submit") {
            
            if(isset($_POST['name']) && !empty($_POST['name'])) {
                
                $name = $_POST['name'];
                
                $number = checkDuplicate($connection, "table_listing", "table_no  = '$name'", "table_id");
                
                if($number > 0){
                    
                    $table_status = "There is a table with the same number already! Table not added!";
                    $text_status = "text-danger";
                    
                } else {
                    
                    $addTables = insertTable($connection, $name);
                    $table_status = "Table Added";
                    $text_status = "text-success";
                    
                }
                
            } else {
                $table_status = "Table field or category is empty! Table not added!";
                $text_status = "text-danger";
            }
            
        } else if (isset($_POST['submit']) && $_POST['submit'] == "reset"){
            
            if(isset($_POST['name']) && !empty($_POST['name'])) {
                
                $name = null;
                
            }
        }
    
        if(isset($_POST['deleteid'])) {
            $deleteid = $_POST['deleteid'];

            $sql="DELETE FROM table_listing WHERE table_id = $deleteid;";
            $connection->query($sql);
            $connection->close();
        }
        
        //Search form
        $number_cond = null;
        $seat_cond = null;
        if(isset($_POST['searchSubmit'])) {

            $number = $_POST['searchTabNum'];
            $seat = $_POST['searchTabSeat'];
    
            if(isset($_POST['searchTabNum']) && !empty($_POST['searchTabNum'])){
                    $number_cond = " AND (table_no ='$number')";
            } else {
                $number_cond = null;
            } 
            
            if(isset($_POST['searchTabSeat']) && !empty($_POST['searchTabSeat'])){
                    $seat_cond = " AND (table_category ='$seat')";
            } else {
                $seat_cond = null;
            } 

        }
           
    
    $showTables = show($connection, "table_listing", "table_id != '' $number_cond $seat_cond ", "table_no");
    
    $connection->close();
    
    ?>

</head>

<body>

    <div class="wrapper">
        <?php include 'sidepanel.php'?>
        <div id="content">

            <?php include 'nav.php'?>

            <p><i class="fas fa-plus"></i> Add table</p>
            <p class="<?php echo $text_status ?>"><?php echo $table_status ?></p>

            <form action="manage-table.php" method="post">
                <div id="addCategory" class="row mt-3">
                    <div class="col-12 col-sm-4 col-md-4 col-lg-4 text-left mb-2">
                        <input class="form-control" type="number" min="1" name="name" placeholder="Table number">
                        <p>* Required</p>
                    </div>
                    <div class="col-12 col-sm-4 col-md-4 col-lg-4 text-left mb-2">
                        <input class="form-control" type="number" min="1" name="category" placeholder="Number of seating">
                        <p>* Required</p>
                    </div>

                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 text-left formbtn">
                        <button type="submit" value="submit" class="btn btn-success enbtn btn-md" name="submit">ADD</button>
                        <button type="submit" value="reset" class="btn btn-danger enbtn btn-md" name="submit">RESET</button>
                    </div>
                </div>
            </form>
            
            <p class="mt-3"><i class="fas fa-search"></i> Search Table</p>
            <form action="manage-table.php" method="post">
                <div id="searchTable" class="row mt-3">

                    <div class="col-12 col-sm-12 col-md-3 col-lg-3 text-left mb-2">
                        <input id="searchTabNumID" class="form-control" type="number" name="searchTabNum" placeholder="Table number">
                    </div>
                    <div class="col-12 col-sm-12 col-md-3 col-lg-3 text-left mb-2">
                        <input id="searchTabSeatID" class="form-control" type="number" name="searchTabSeat" placeholder="Number of seating">
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
                                    <th class="w-25 text-center"><span onclick='sortTable("table_id");'>ID</span></th>
                                    <th class="w-25 text-center"><span onclick='sortTable("table_no");'>Table No.</span></th>
                                    <th class="w-25 text-center"><span onclick='sortTable("table_category");'>Number of Seats</span></th>
                                    <th class="w-50 text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php foreach($showTables as $showTable) { ?>
                                <tr>
                                    <td class="w-25 text-center"><?php echo $showTable['table_id']?></td>
                                    <td class="w-25 text-center"><?php echo $showTable['table_no']?></td>
                                    <td class="w-25 text-center"><?php echo $showTable['table_category']?></td>
                                    <td class="w-50 text-center">
                                        <div class="row text-center">
                                            <div class="col-12 col-sm-6 col-md-6 col-lg-6 formbtn">
                                                <button value="edit" class="btn btn-warning enbtn btn-md modalButton" name="editable"><i class="fas fa-edit"></i></button>
                                            </div>
                                            <div class="col-12 col-sm-6 col-md-6 col-lg-6 formbtn deleteButton">
                                                <button onclick="deleteTable(<?php echo $showTable['table_id']; ?>)" value="delete" class="btn btn-danger enbtn btn-md" name="delete"><i class="fas fa-trash-alt"></i></button>
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
                                <h5 class="modal-title" id="editableLabel">Edit Table Details</h5>

                            </div>
                            <div class="col-12 col-md-12 text-center">
                                <form id="editCategoryForm" action="manage-table.php" method="POST" enctype="multipart/form-data">
                                    <div id="updateFood" class="row mt-3">

                                        <input id="getID" class="form-control" type="hidden" name="updateID" placeholder="id" value="">

                                        <br />
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 text-left mb-4">
                                            <input id="editName" class="form-control" min="1" type="number" name="updateName" placeholder="Table number" value="">
                                        </div>
                                        <br />
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 text-left mb-4">
                                            <input id="editCategory" class="form-control" min="1" type="number" name="updateCatName" placeholder="Number of seating" value="">
                                        </div>
                                        <br />

                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 text-left formbtn">
                                            <button type="submit" value="updateTable" class="btn btn-success enbtn btn-md" name="updateTable">UPDATE</button>
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
    <script src="../js/manage-table.js"></script>
</body>

</html>
