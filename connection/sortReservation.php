<?php

require_once('../connection/connection.php');

$columnName = $_POST['columnName'];
$sort = $_POST['sort'];

$select_query = "SELECT * FROM reservation WHERE status = 1 ORDER BY ".$columnName." ".$sort." ";

$result = mysqli_query($connection,$select_query);

$html = '';
while($row = mysqli_fetch_array($result)){
  $id = $row['reserve_id'];
  $name = $row['reserve_name'];
  $mobile = $row['reserve_mobile'];
  $date = $row['reserve_date'];
  $table = $row['reserve_table'];
  $customers = $row['reserve_customers'];
    $action = '<div class="row text-center">
                    <div class="col-12 col-sm-4 col-md-4 col-lg-4 formbtn">
                        <button onclick=" updateStatus('.$id.')" value="hide" class="btn btn-success enbtn btn-md" name="hide"><i class="fas fa-check"></i></button>
                    </div>
                    <div class="col-12 col-sm-4 col-md-4 col-lg-4 formbtn">
                        <button value="edit" class="btn btn-warning enbtn btn-md modalButton" name="editable"><i class="fas fa-edit"></i></button>
                    </div>
                    <div class="col-12 col-sm-4 col-md-4 col-lg-4 formbtn deleteButton">
                        <button onclick="deleteFood('.$id.')" value="delete" class="btn btn-danger enbtn btn-md" name="delete"><i class="fas fa-trash-alt"></i></button>
                    </div>
                </div>';

  $html .= "<tr>
    <td class='w-5'>".$id."</td>
    <td class='w-20'>".$name."</td>
    <td class='w-15'>".$mobile."</td>
    <td class='w-15'>".$date."</td>
    <td class='w-10'>".$customers."</td>
    <td class='w-5'>".$table."</td>
    <td class='w-20'>".$action."</td>
  </tr>";
}

echo $html;