<?php
    $conn = mysqli_connect("localhost","root","","poscafe");
    $sql="SELECT * FROM transaction_listing";
    $result = $conn->query($sql);
    if($result!=false){
        while($row = $result->fetch_assoc()){
            echo "<tr>";
            echo "<td>".$row['trans_id']."</td>";
            echo "<td>".$row['total_price']."</td>";
            echo "<td>".$row['created_on']."</td>";
            echo "</tr>";
        }
    }
?>