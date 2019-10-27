<?php
$id=$_POST['id'];
$food=$_POST['food'];
$table=$_POST['table'];
$qty=$_POST['qty'];
$price=$_POST['price'];
if(isset($_POST['id']) && isset($_POST['food']) && isset($_POST['table']) && isset($_POST['qty']) && isset($_POST['price'])){
    $conn=mysqli_connect("localhost","root","","poscafe");
    $sqlOrder="INSERT INTO order_list(order_id,ordered_food,ordered_table,quantity,order_price,order_status,ordered_on) VALUES('$id','$food','$table','$qty','$price',1,current_timestamp())";
    $conn->query($sqlOrder);
    
    $updateTable="UPDATE table_listing SET status = '1' WHERE table_no = '$table';";
    $conn->query($updateTable);
}


?>