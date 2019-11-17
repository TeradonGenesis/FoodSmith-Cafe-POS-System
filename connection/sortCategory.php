<?php

require_once('../connection/connection.php');

$columnName = $_POST['columnName'];
$sort = $_POST['sort'];

$select_query = "SELECT *  FROM food_category ORDER BY ".$columnName." ".$sort." ";

$result = mysqli_query($connection,$select_query);

$html = '';
while($row = mysqli_fetch_array($result)){
  $id = $row['category_id'];
  $name = $row['category_name'];
  $action = '<div class="row text-center">
                <div class="col-12 col-sm-12 col-md-12 col-lg-12 formbtn">
                    <button value="edit" class="btn btn-warning enbtn btn-md modalButton" name="editable"><i class="fas fa-edit"></i></button>
                </div>
            </div>';
      
      

  $html .= "<tr>
    <td class='w-25 pt-4'>".$id."</td>
    <td class='w-25 pt-4'>".$name."</td> 
    <td class='w-40 text-center'>".$action."</td>
  </tr>";
}

echo $html;

?>
