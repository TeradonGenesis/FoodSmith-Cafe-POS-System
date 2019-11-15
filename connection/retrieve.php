<?php
$day=$_POST['day'];
$month=$_POST['month'];
if(isset($_POST['day']) && isset($_POST['month'])){
    $conn = mysqli_connect("localhost","root","","poscafe");
    $sql="SELECT * FROM transaction_listing WHERE DAYOFMONTH(created_on)=".$day." AND MONTH(created_on)=".$month;
    $result = $conn->query($sql);
    if($result!=false){
        while($row = $result->fetch_assoc()){
            $date = new DateTime($row['created_on']);
            $show_date = $date->format('d/m/Y');
            echo "<tr>";
            echo "<td>".$row['trans_id']."</td>";
            echo "<td>".$row['total_price']."</td>";
            echo "<td>".$show_date."</td>";
            echo "</tr>";
        }
    }
}

if(isset($_POST['day']) && empty($_POST['month'])){
    $conn = mysqli_connect("localhost","root","","poscafe");
    $sql="SELECT * FROM transaction_listing WHERE DAYOFMONTH(created_on)=".$day;
    $result = $conn->query($sql);
    if($result!=false){
        while($row = $result->fetch_assoc()){
            $date = new DateTime($row['created_on']);
            $show_date = $date->format('d/m/Y');
            echo "<tr>";
            echo "<td>".$row['trans_id']."</td>";
            echo "<td>".$row['total_price']."</td>";
            echo "<td>".$show_date."</td>";
            echo "</tr>";
        }
    }
}

if(empty($_POST['day']) && isset($_POST['month'])){
    $conn = mysqli_connect("localhost","root","","poscafe");
    $sql="SELECT * FROM transaction_listing WHERE MONTH(created_on)=".$month;
    $result = $conn->query($sql);
    if($result!=false){
        while($row = $result->fetch_assoc()){
            $date = new DateTime($row['created_on']);
            $show_date = $date->format('d/m/Y');
            echo "<tr>";
            echo "<td>".$row['trans_id']."</td>";
            echo "<td>".$row['total_price']."</td>";
            echo "<td>".$show_date."</td>";
            echo "</tr>";
        }
    }
}
?>