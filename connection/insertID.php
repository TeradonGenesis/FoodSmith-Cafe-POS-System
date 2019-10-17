<?php
$id=$_POST['id'];
if(isset($_POST['id'])){
    $conn=mysqli_connect("localhost","root","","poscafe");
    $sqlID="INSERT INTO order_id(order_id) VALUES($id)";
    $conn->query($sqlID);
}
    
?>