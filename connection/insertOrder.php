<?php
$id=$_POST['id'];
$food=$_POST['food'];
$table=$_POST['table'];

if(isset($_POST['id']) && isset($_POST['food']) && isset($_POST['table'])){
    $conn=mysqli_connect("localhost","root","","poscafe");
    $sqlOrder="INSERT INTO order_list(order_id,ordered_food,ordered_table,quantity,order_price,order_status,ordered_on) VALUES($id,$food,$table,NULL,NULL,1,current_timestamp())";
    $conn->query($sqlOrder);
}


?>