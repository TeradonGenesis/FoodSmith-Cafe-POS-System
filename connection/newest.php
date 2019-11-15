<?php

    $conn = mysqli_connect("localhost","root","","poscafe");
    $sql="SELECT * FROM transaction_listing ORDER BY created_on ASC";
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

?>
