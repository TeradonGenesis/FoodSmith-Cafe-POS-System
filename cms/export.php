<?php
    if(isset($_POST["export"])){
        $connect = mysqli_connect("localhost","root","","poscafe");
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachkemnt; filename=transaction-data.csv');
        $output = fopen("php://output","w");
        fputcsv($output,array('ID','Total Price','DateTime'));
        $query = "SELECT * FROM transaction_listing ORDER BY trans_id";
        $result = mysqli_query($connect,$query);
        while($row = mysqli_fetch_assoc($result)){
            fputcsv($output,$row);
        }
        fclose($output);
    }
?>