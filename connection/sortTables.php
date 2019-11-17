<?php

require_once('../connection/connection.php');

$columnName = $_POST['columnName'];
$sort = $_POST['sort'];

$select_query = "SELECT * FROM table_listing WHERE table_id != '' ORDER BY ".$columnName." ".$sort." ";

$result = mysqli_query($connection,$select_query);

$html = '';
while($row = mysqli_fetch_array($result)){
  $id = $row['table_id'];
  $number = $row['table_no'];
  $category = $row['table_category'];
  $action = '<div class="row text-center">
                <div class="col-12 col-sm-6 col-md-6 col-lg-6 formbtn">
                    <button value="edit" class="btn btn-warning enbtn btn-md modalButton" name="editable"><i class="fas fa-edit"></i></button>
                </div>
                <div class="col-12 col-sm-6 col-md-6 col-lg-6 formbtn deleteButton">
                    <button onclick="deleteTable('.$id.')" value="delete" class="btn btn-danger enbtn btn-md" name="delete"><i class="fas fa-trash-alt"></i></button>
                </div>
            </div>';
      
      

  $html .= "<tr>
    <td class='w-25 text-center'>".$id."</td>
    <td class='w-25 text-center'>".$number."</td>
    <td class='w-25 text-center'>".$category."</td>
    <td class='w-50 text-center'>".$action."</td>
  </tr>";
}

echo $html;

?>


