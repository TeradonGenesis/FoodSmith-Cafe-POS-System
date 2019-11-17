<?php

require_once('../connection/connection.php');

$columnName = $_POST['columnName'];
$sort = $_POST['sort'];

$select_query = "SELECT *  FROM order_list INNER JOIN menu ON ordered_food = food_id WHERE order_status = 1 ORDER BY ".$columnName." ".$sort." ";

$result = mysqli_query($connection,$select_query);

$html = '';
while($row = mysqli_fetch_array($result)){
  $oid = $row['order_id'];
  $fid = $row['food_id'];
  $name = $row['food_name'];
  $table = $row['ordered_table'];
  $qty = $row['quantity'];
  $action = '<div class="row text-center">
                <div class="col-12 col-sm-4 col-md-4 col-lg-4 formbtn">
                    <button onclick=" updateStatus('.$oid.', '.$fid.')" value="hide" class="btn btn-success enbtn btn-md" name="hide"><i class="fas fa-check"></i></button>
                </div>
                <div class="col-12 col-sm-4 col-md-4 col-lg-4 formbtn">
                    <button value="edit" class="btn btn-warning enbtn btn-md modalButton" name="editable"><i class="fas fa-edit"></i></button>
                </div>
                <div class="col-12 col-sm-4 col-md-4 col-lg-4 formbtn deleteButton">
                    <button onclick="deleteFood('.$oid.', '.$fid.')" value="delete" class="btn btn-danger enbtn btn-md" name="delete"><i class="fas fa-trash-alt"></i></button>
                </div>
            </div>';
      
      

  $html .= "<tr>
    <td class=w-40 pt-4'>".$oid."</td>
    <td class=w-20 pt-4'>".$fid."</td>
    <td class='w-10 pt-4'>".$name."</td>
    <td class='w-5 pt-4'>".$table."</td>
    <td class='w-5 pt-4 text-center'>".$qty."</td>
    <td class='w-20 pt-4 text-center'>".$action."</td>
  </tr>";
}

echo $html;

?>
