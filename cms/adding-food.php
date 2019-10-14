<?php require_once('../connection/connection.php'); ?>
<?php 
    
                
                if(isset($_POST['status']) && isset($_POST['id'])) {
                    $status = $_POST['status'];
                    $id = $_POST['id'];
                    
                    if ($status == 1) {
                        $update = updateHideStatus($connection, "menu", "2", $id);
                    } else if($status == 2) {
                        $update = updateHideStatus($connection, "menu", "1", $id);
                    }
                    
                }

                if(isset($_POST['deleteid'])) {
                    $deleteid = $_POST['deleteid'];
                    
                    $sql="DELETE FROM menu WHERE food_id = $deleteid;";
                    $connection->query($sql);
                    $connection->close();
                }
    
    
    
    
                $success = '';
                $uploadStatus = '';
                $alert = '';
                $alert_price = '';
                $alert_name = '';
                $alert_category = '';
                $invalid_name = '';
                $invalid_price = '';
                $invalid_category = '';
    


                    if(isset($_POST['name']) && !empty($_POST['name']) && isset($_POST['price']) && !empty($_POST['price']) && isset($_FILES['file']) && isset($_POST['category']) && !empty($_POST['category'])) {

                        $name = $_POST['name'];
                        $price = $_POST['price'];
                        $category = $_POST['category'];
                        
                        $fileName = $_FILES['file']['name'];
                        $fileTmpName = $_FILES['file']['tmp_name'];
                        $fileSize = $_FILES['file']['size'];
                        $fileError = $_FILES['file']['error'];
                        $fileType = $_FILES['file']['type'];
                        
                        $fileExt = explode('.', $fileName);
                        $fileActualExt = strtolower(end($fileExt));
                        
                        $allowed = array('jpg', 'jpeg', 'png');
                        
                        if(in_array($fileActualExt, $allowed)) {
                            if($fileError === 0) {
                                if($fileSize < 5000000) {
                                    $fileNameNew = uniqid('', true).".".$fileActualExt;
                                    
                                    $fileDestination = '../images/'.$fileNameNew;
                                    
                                    move_uploaded_file($fileTmpName, $fileDestination);
                                    
                                    $addFood = insertMenu($connection, $fileNameNew, $name, $price, $category);
                                    $success = "Food Added";
                                    
                                    
                                    
                                } else {
                                    $uploadStatus = "File size is too big";
                                    $success = "Fail to add food";
                                }
                                
                            } else {
                               $uploadStatus = "There was an error uploading the file"; 
                                $success = "Fail to add food";
                            }
                        } else {
                            $uploadStatus =  "You cannot upload files of this type";
                            $success = "Fail to add food";
                        }
                        

                    } else {
                        $success = "Fail to add food";
                    }
                    
                    $pattern = '/^(0|[1-9]\d*)(\.\d{2})?$/';
                    
                    if (empty($_POST['price'])) {
                        $alert_price = "Please enter a price";
                        $invalid_price = 'is-invalid';
                        
                    } else if (isset($_POST['price']) && preg_match($pattern, $_POST['price']) == '0') {
                       $alert_price = "Only numbers and one . is allowed";
                        $invalid_price = 'is-invalid';
                    }
                    
                    if (empty($_POST['name'])) {
                        $alert_name = "Please enter a name";
                        $invalid_name = 'is-invalid';
                        
                    }
                    
                    if (empty($_POST['category'])) {
                        $alert_category = "Please select a category";
                        $invalid_category = 'is-invalid';
                        
                    }
    

             
?>