<!DOCTYPE html>
<html lang="en">
<?php require_once('../connection/connection.php'); ?>

<head>
    <?php include 'head.php'?>
    <?php 
    

           
    
    $reservations = show($connection, "reservation", "status = '1'", "reserve_id");
    $tables = show($connection, "table_listing", "table_id != '1'", "table_no");
    $connection->close();
    
    ?>

</head>

<body>

    <div class="wrapper">
        <?php include 'sidepanel.php'?>
        <div id="content">

            <?php include 'nav.php'?>

            <p class="mt-2"><i class="fas fa-plus"></i> Add reservation</p>
            <form id="addReservationForm" action="manage-reservations.php" method="POST" enctype="multipart/form-data">
                <div id="addResrve" class="row mt-3">
                    <div class="col-12 col-sm-4 col-md-2 col-lg-2 text-left mb-4">
                        <input id="addReserveName" class="form-control" type="text" name="reserve_name" value="" placeholder="Name">
                    </div>
                    <div class="col-12 col-sm-4 col-md-2 col-lg-2 text-left mb-4">
                        <input id="addMobile" class="form-control" type="text" name="reserve_mobile" value="" placeholder="Phone number">
                    </div>
                    <div class="col-12 col-sm-4 col-md-2 col-lg-2 text-left mb-4">
                        <input id="addDate" class="form-control" type="text" name="reserve_date" value="" placeholder="YYYY-MM-DD">
                    </div>
                    <div class="col-xs-12 col-sm-4 col-md-2 col-lg-2 text-left mb-4">
                        <select id="addTable" name="reserve_table" class="form-control">
                            <option selected="" hidden="" value="">Table</option>
                            <?php foreach($tables as $table) { ?>
                            <option value="<?php echo $table['table_no']?>"><?php echo $table['table_no']?></option>
                            <?php }?>
                        </select>
                    </div>
                    <div class="col-12 col-sm-4 col-md-2 col-lg-2 text-left mb-4">
                        <input id="addCustomers" class="form-control" min="1" type="number" name="reserve_customers" value="" placeholder="No. of Customers">
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


                    <div class="col-12 col-sm-12 col-md-3 col-lg-3 text-left mb-2">
                        <input class="form-control" type="text" name="price" placeholder="Price e.g. 20.30">
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
                                    <th class="w-5">ID</th>
                                    <th class="w-20">Name</th>
                                    <th class="w-15">Mobile</th>
                                    <th class="w-15">Date</th>
                                    <th class="w-10">Customers</th>
                                    <th class="w-5">Table</th>
                                    <th class="w-20">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php foreach($reservations as $reservation) { ?>
                                <tr>
                                    <td class="w-5"><?php echo $reservation['reserve_id']?></td>
                                    <td class="w-20"><?php echo $reservation['reserve_name']?></td>
                                    <td class="w-15"><?php echo $reservation['reserve_mobile']?></td>
                                    <td class="w-15"><?php echo $reservation['reserve_date']?></td>
                                    <td class="w-10"><?php echo $reservation['reserve_customers']?></td>
                                    <td class="w-5"><?php echo $reservation['reserve_table']?></td>
                                    <td class="w-20">
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
                                <?php } ?>


                            </tbody>
                        </table>

                    </div>

                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 tab-pane" id="notdisplay">
                        <table class="table table-borded table-striped">
                            <thead class="thead-dark">
                                <tr>
                                    <th class="w-5">ID</th>
                                    <th class="w-20">Name</th>
                                    <th class="w-15">Mobile</th>
                                    <th class="w-15">Date</th>
                                    <th class="w-10">Customers</th>
                                    <th class="w-5">Table</th>
                                    <th class="w-20">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php foreach($reservations as $reservation) { ?>
                                <tr>
                                    <td class="w-5"><?php echo $reservation['reserve_id']?></td>
                                    <td class="w-20"><?php echo $reservation['reserve_name']?></td>
                                    <td class="w-15"><?php echo $reservation['reserve_mobile']?></td>
                                    <td class="w-15"><?php echo $reservation['reserve_date']?></td>
                                    <td class="w-10"><?php echo $reservation['reserve_customers']?></td>
                                    <td class="w-5"><?php echo $reservation['reserve_table']?></td>
                                    <td class="w-20">
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
                                <?php } ?>


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
    <?php include 'footer.php'?>
    <script src="../js/manage-table.js"></script>
</body>

</html>
