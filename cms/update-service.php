<?php require_once('../connection/connection.php'); ?>
<?php 
    
    if(isset($_POST['submit']) && $_POST['submit'] == "updateFood") {
        
        
        $updateID = $_POST['updateID'];
        $updateName = $_POST['updateName'];
        $updatePrice = $_POST['updatePrice'];
        $updateCategory = $_POST['updateCategory'];
        
        
            $sql="UPDATE menu SET food_name = $updateName, food_price = $updatePrice, category = $updateCategory WHERE food_id = $updateID";
            $connection->query($sql);
            $connection->close(); 
            
        
        header("location:manage-menu.php"); 
        
}

?>
