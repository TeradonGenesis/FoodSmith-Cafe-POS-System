<?php require_once('../connection/connection.php'); ?>
   

   <?php 
    
        if(isset($_POST['submit']) && $_POST['submit'] == "submit") {
            
            if(isset($_POST['name']) && !empty($_POST['name'])) {
                
                $name = $_POST['name'];
                
                 header('Location: manage-food-category.php');
           
                
            } else {
                $name = null;
                
                 header('Location: manage-food-category.php');
           
            }
            
            $addCategories = insertFoodCategory($connection, $name);
            
        } else if (isset($_POST['submit']) && $_POST['submit'] == "reset"){
            
            if(isset($_POST['name']) && !empty($_POST['name'])) {
                
                $name = null;
                
                 header('Location: manage-food-category.php');
            
                
            }
        }
    
?>
