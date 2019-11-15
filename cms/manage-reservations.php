<!DOCTYPE html>
<html lang="en">
<?php require_once('../connection/connection.php'); ?>

<head>
    <?php include 'head.php'?>
    <?php 
    
    $reservation_status = null;
    $text_status = null;
    
    if(isset($_POST['submit'])) {
        if(isset($_POST['reserve_name']) && !empty($_POST['reserve_name']) && isset($_POST['reserve_mobile']) && !empty($_POST['reserve_mobile']) && isset($_POST['reserve_date']) && !empty($_POST['reserve_date']) && isset($_POST['reserve_table']) && !empty($_POST['reserve_table']) && isset($_POST['reserve_customers']) && !empty($_POST['reserve_customers'])) {
            
            $name = $_POST['reserve_name'];
            $mobile = $_POST['reserve_mobile'];
            $date = $_POST['reserve_date'];
            $table = $_POST['reserve_table'];
            $customers = $_POST['reserve_customers'];
            
            $insert = insertReservations ($connection, $name, $mobile, $date, $table, $customers);
            $reservation_status = "Reservation added";
            $text_status = "text-success";
            
            $reservation_status = "Reservation not added";
            $text_status = "text-danger";
                
        }
    }
    
    if(isset($_POST['updateReservations'])) {
        if(isset($_POST['updateID']) || isset($_POST['updateName']) && !empty($_POST['updqateName']) || isset($_POST['updateMobile']) && !empty($_POST['updateMobile']) || isset($_POST['updateDate']) && !empty($_POST['updateDate']) || isset($_POST['updateTable']) && !empty($_POST['updateTable']) || isset($_POST['updateCustomers']) && !empty($_POST['updateCustomers'])) {
            
            $id = $_POST['updateID'];
            $name = $_POST['updateName'];
            $mobile = $_POST['updateMobile'];
            $date = $_POST['updateDate'];
            $table = $_POST['updateTable'];
            $customers = $_POST['updateCustomers'];
            
            $update = updateReservations ($connection, $id, $name, $mobile, $date, $table, $customers);
            
            $reservation_status = "Reservation updated";
            $text_status = "text-success";
                
        } else {
            $reservation_status = "Reservation not updated";
            $text_status = "text-danger";
        }
    }
    
    if(isset($_POST['update_reserve_id'])) {
                    $update_reserve_id = $_POST['update_reserve_id'];
                    $sql="UPDATE reservation SET status = 2 WHERE reserve_id = '".$update_reserve_id."'";
                    $connection->query($sql);
                   
    }
    
    if(isset($_POST['deleteid'])) {
        $deleteid = $_POST['deleteid'];

        $sql="DELETE FROM reservation WHERE reserve_id = $deleteid;";
        $connection->query($sql);
        $connection->close();
    }
    
    //Search form
    $name_cond = null;
    $date_cond = null;
    if(isset($_POST['searchSubmit'])) {

        $name = $_POST['searchResName'];
        $getDate = $_POST['searchResDate'];
        
        $date = new DateTime($getDate);
        $format_date = $date->format('Y-m-d');

        if(isset($_POST['searchResName']) && !empty($_POST['searchResName'])){
                $name_cond = " AND (reserve_name REGEXP '[[:<:]]".$name."[[:>:]]' )";
        } else {
            $name_cond = null;
        } 

        if(isset($_POST['searchResDate']) && !empty($_POST['searchResDate'])){
                $date_cond = " AND (reserve_date = '$format_date')";
        } else {
            $date_cond = null;
        }
    }
           
    
    $reservations = show($connection, "reservation", "status = '1' $name_cond $date_cond", "reserve_id");
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
            <p class="<?php echo $text_status; ?>"><?php echo $reservation_status; ?></p>
            <form id="addReservationForm" action="manage-reservations.php" method="POST" enctype="multipart/form-data">
                <div id="addResrve" class="row mt-3">
                    <div class="col-12 col-sm-4 col-md-2 col-lg-2 text-left mb-4">
                        <input id="addReserveName" class="form-control" type="text" name="reserve_name" value="" placeholder="Name">
                    </div>
                    <div class="col-12 col-sm-4 col-md-2 col-lg-2 text-left mb-4">
                        <input id="addMobile" class="form-control" type="text" name="reserve_mobile" value="" placeholder="Phone number">
                    </div>
                    <div class="col-12 col-sm-4 col-md-2 col-lg-2 text-left mb-4">
                        <input id="addDate" class="form-control" type="date" name="reserve_date" value="" placeholder="YYYY-MM-DD">
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

            <p class="mt-3"><i class="fas fa-search"></i> Search Reservations</p>
            <form action="manage-reservations.php" method="post">
                <div id="searchReservations" class="row mt-3">

                    <div class="col-12 col-sm-12 col-md-3 col-lg-3 text-left mb-2">
                        <input id="searchResNameID" class="form-control" type="text" name="searchResName" placeholder="Name">
                    </div>
                    <div class="col-12 col-sm-12 col-md-3 col-lg-3 text-left mb-2">
                        <input id="searchResDateID" class="form-control" type="date" name="searchResDate" placeholder="">
                    </div>

                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 text-left formbtn">
                        <button id="searchSubmitID" type="submit" value="submit" class="btn btn-success enbtn btn-md" name="searchSubmit">SEARCH</button>
                        <button id="searchResetID" type="submit" value="reset" class="btn btn-danger enbtn btn-md" name="searchReset">RESET</button>
                    </div>
                </div>
            </form>

            <div class="table-container">


                <div class="row mt-5">
                   
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12" id="display">
                        <p>Click on the headers to sort by column</p>
                        <input type='hidden' id='sort' value='asc'>
                        <table id="reservation_table" class="table table-borded table-striped">
                            <thead class="thead-dark">
                                <tr>
                                    <th class="w-5"><span onclick='sortTable("reserve_id");'>ID</span></th>
                                    <th class="w-15"><span onclick='sortTable("reserve_name");'>Name</span></th>
                                    <th class="w-15"><span onclick='sortTable("reserve_mobile");'>Mobile</span></th>
                                    <th class="w-15"><span onclick='sortTable("reserve_date");'>Date</span></th>
                                    <th class="w-5"><span onclick='sortTable("reserve_customers");'>No.</span></th>
                                    <th class="w-5"><span onclick='sortTable("reserve_table");'>Table</span></th>
                                    <th class="w-20 text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php foreach($reservations as $reservation) { ?>
                                <tr>
                                    <td class="w-5"><?php echo $reservation['reserve_id']?></td>
                                    <td class="w-15"><?php echo $reservation['reserve_name']?></td>
                                    <td class="w-15"><?php echo $reservation['reserve_mobile']?></td>
                                    <td class="w-15"><?php echo ($reservation['reserve_date']);?></td>
                                    <td class="w-5"><?php echo $reservation['reserve_customers']?></td>
                                    <td class="w-5"><?php echo $reservation['reserve_table']?></td>
                                    <td class="w-20">
                                        <div class="row text-center">
                                            <div class="col-12 col-sm-4 col-md-4 col-lg-4 formbtn">
                                                <button onclick=" updateStatus(<?php echo $reservation['reserve_id']; ?>)" value="hide" class="btn btn-success enbtn btn-md" name="hide"><i class="fas fa-check"></i></button>
                                            </div>
                                            <div class="col-12 col-sm-4 col-md-4 col-lg-4 formbtn">
                                                <button value="edit" class="btn btn-warning enbtn btn-md modalButton" name="editable"><i class="fas fa-edit"></i></button>
                                            </div>
                                            <div class="col-12 col-sm-4 col-md-4 col-lg-4 formbtn deleteButton">
                                                <button onclick="deleteReserve(<?php echo $reservation['reserve_id']; ?>)" value="delete" class="btn btn-danger enbtn btn-md" name="delete"><i class="fas fa-trash-alt"></i></button>
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
                                    <form id="updateReserve_form" action="manage-reservations.php" method="POST" enctype="multipart/form-data">
                                        <div id="updateFood" class="row mt-3">

                                            <input id="getID" class="form-control " type="hidden" name="updateID" placeholder="id" value="">
                                            <br />
                                            <div class="col-12 col-sm-12 col-md-12 col-lg-12 text-left mb-4">
                                                <input id="editReserve_name" class="form-control" type="text" name="updateName" placeholder="Name" value="">
                                            </div>
                                            <br />
                                            <div class="col-12 col-sm-12 col-md-12 col-lg-12 text-left mb-4">
                                                <input id="editReserve_mobile" class="form-control" type="text" name="updateMobile" placeholder="Mobile no." value="">
                                            </div>
                                            <br />
                                            <div class="col-12 col-sm-12 col-md-12 col-lg-12 text-left mb-4">
                                                <input id="editReserve_date" class="form-control" type="date" name="updateDate" placeholder="" value="">
                                            </div>
                                            <br />
                                            <div class="col-12 col-sm-12 col-md-12 col-lg-12 text-left mb-4">
                                                <input id="editReserve_customers" class="form-control" type="number" name="updateCustomers" placeholder="" value="">
                                            </div>
                                            <br />
                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-left mb-4">
                                                <select id="editReserve_table" name="updateTable" class="form-control">
                                                    <option selected="" hidden="" value="">Table</option>
                                                    <?php foreach($tables as $table) { ?>
                                                    <option value="<?php echo $table['table_no']?>"><?php echo $table['table_no']?></option>
                                                    <?php }?>
                                                </select>
                                            </div>
                                            <br />

                                            <div class="col-12 col-sm-12 col-md-12 col-lg-12 text-left formbtn">
                                                <button type="submit" value="updateReservation" class="btn btn-success enbtn btn-md" name="updateReservations">UPDATE</button>
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
    <script src="../js/manage-reservations.js"></script>
</body>

</html>
