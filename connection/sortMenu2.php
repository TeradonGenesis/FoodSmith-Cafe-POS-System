<?php

require_once('../connection/connection.php');

$columnName = $_POST['columnName'];
$sort = $_POST['sort'];

$select_query = "SELECT *  FROM menu INNER JOIN food_category
ON menu.category = food_category.category_id WHERE menu.status = 2 ORDER BY ".$columnName." ".$sort." ";

$result = mysqli_query($connection,$select_query);

$html = '';
while($row = mysqli_fetch_array($result)){
  $id = $row['food_id'];
  $picture = $row['food_picture'];
  $name = $row['food_name'];
  $price = $row['food_price'];
  $category = $row['category_name'];
  $status = $row['status'];
  $action = '<div class="row text-center">
                <div class="col-12 col-sm-4 col-md-4 col-lg-4 formbtn">
                    <button onclick=" updateStatus('.$status.', '.$id.')" value="hide" class="btn btn-primary enbtn btn-md" name="hide"><i class="fas fa-eye-slash"></i></button>
                </div>
                <div class="col-12 col-sm-4 col-md-4 col-lg-4 formbtn">
                    <button value="edit" class="btn btn-warning enbtn btn-md modalButton" name="editable"><i class="fas fa-edit"></i></button>
                </div>
                <div class="col-12 col-sm-4 col-md-4 col-lg-4 formbtn deleteButton">
                    <button onclick="deleteFood('.$id.')" value="delete" class="btn btn-danger enbtn btn-md" name="delete"><i class="fas fa-trash-alt"></i></button>
                </div>
            </div>';
      
      

  $html .= "<tr>
    <td class='w-20 pt-4'>".$id."</td>
    <td class='w-15'><img class='foodpics' src='../images/".$picture."' alt='".$picture."' width='70' height='70' /></td>
    <td class='w-20 pt-4'>".$name."</td>
    <td class='w-15 pt-4 text-center'>".$price."</td>
    <td class='w-15 pt-4'>".$category."</td>
    <td class='w-30 pt-4 text-center'>".$action."</td>
  </tr>";
}

echo $html;

?>
