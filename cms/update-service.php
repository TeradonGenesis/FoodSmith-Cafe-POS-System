<?php require_once('../connection/connection.php'); ?>
<?php 
    
    if(isset($_POST['updateReservations'])) {
        if(isset($_POST['updateID']) || isset($_POST['updateName']) && !empty($_POST['updqateName']) || isset($_POST['updateMobile']) && !empty($_POST['updateMobile']) || isset($_POST['updateDate']) && !empty($_POST['updateDate']) || isset($_POST['updateTable']) && !empty($_POST['updateTable']) || isset($_POST['updateCustomers']) && !empty($_POST['updateCustomers'])) {
            
            $id = $_POST['updateID'];
            $name = $_POST['updateName'];
            $mobile = $_POST['updateMobile'];
            $date = $_POST['updateDate'];
            $table = $_POST['updateTable'];
            $customers = $_POST['updateCustomers'];
            
            $update = updateReservations ($connection, $id, $name, $mobile, $date, $table, $customers);
            
            header("location:manage-reservations.php"); 
                
        }
    }
    

?>
