<?php

$name = $_POST['name'];
$type = $_POST['type'];

if(isset($name = $_POST['name']) || isset($_POST['type'])){
    $conn = mysqli_connect("localhost","root","","poscafe");
    $sql="SELECT * FROM MENU WHERE food_name=".$name." OR category=".$type;
    $result = $conn->query($sql);
    if($result!=false){
        while($row = $result->fetch_assoc()){
            echo '<tr>'
            echo '<td class="col-1 pt-4">'.$row['food_id'].'</td>';
            echo '<td class="col-2"><img class="foodpics" src="../images/'.$row['food_picture'].'" alt="'.$row['food_picture'].'" width="70" height="70" /></td>';
            echo '<td class="col-1 pt-4 text-center">'.$row['food_price'].'</td>';
            echo '<td class="col-2 pt-4 text-center">'.$row['category_name'].'</td>';
            echo '<td class="col-3 pt-4 text-center">
                                        <div class="row text-center">
                                            <div class="col-12 col-sm-4 col-md-4 col-lg-4 formbtn">
                                                <button onclick=" updateStatus('.$row['status'].','.$row['food_id'].')" value="hide" class="btn btn-primary enbtn btn-md" name="hide"><i class="fas fa-eye-slash"></i></button>
                                            </div>
                                            <div class="col-12 col-sm-4 col-md-4 col-lg-4 formbtn">
                                                <button value="edit" class="btn btn-warning enbtn btn-md modalButton" name="editable"><i class="fas fa-edit"></i></button>
                                            </div>
                                            <div class="col-12 col-sm-4 col-md-4 col-lg-4 formbtn deleteButton">
                                                <button onclick="deleteFood('.$row['food_id'].')" value="delete" class="btn btn-danger enbtn btn-md" name="delete"><i class="fas fa-trash-alt"></i></button>
                                            </div>
                                        </div>
                                    </td>';
            echo "</tr>";
        }
    }
}
?>
