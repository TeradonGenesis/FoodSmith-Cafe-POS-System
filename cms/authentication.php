<?php require_once('../connection/connection.php'); ?>
<?php 
    

    if(isset($_POST['signin-submit'])) {
        $username = $_POST['getName'];
        $password = $_POST['getPassword'];
    }
?>