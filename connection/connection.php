<?php

Class DBConnection{
	var $hostname = "localhost";
	var $database = "poscafe";
	var $username = "root";
	var $password = "";
}

$DBConn = New DBConnection;

$connection = mysqli_connect($DBConn->hostname, $DBConn->username, $DBConn->password) or trigger_error(mysql_error(),E_USER_ERROR); 
mysqli_select_db($connection, $DBConn->database);




function show ($connection = null, $table = null, $condition = null, $order = null) {
    
    $cond = "";
    $ord = "";
    
    if(isset($condition) && !empty($condition)){
		$cond = " WHERE ".$condition;
	}
	
	if(isset($order) && !empty($order)){
		$ord = " ORDER BY ".$order;
	}
    
    $query = "SELECT * FROM ".$table.$cond.$ord;
    
    $result=mysqli_query($connection,$query) or die(mysqli_error($connection));
    

    $count = 0;
    $results = array();	
    
    if(mysqli_num_rows($result)>0){
        
        while($row = mysqli_fetch_assoc($result)){
        
            $results[$count] = $row;
            $count++;
        }

    }
		
    return $results;
    
}

function showJoins ($connection = null, $sql) {
    
    $query = $sql;
    
    $result=mysqli_query($connection,$query) or die(mysqli_error($connection));
    

    $count = 0;
    $results = array();	
    
    if(mysqli_num_rows($result)>0){
        
        while($row = mysqli_fetch_assoc($result)){
        
            $results[$count] = $row;
            $count++;
        }

    }
		
    return $results;
    
}

function insertTable ($connection = null, $table_no = null) {
    if ($connection->connect_error)
            die('Connect Error (' . mysqli_connect_errno() . ') '. mysqli_connect_error());

        $sql = "INSERT INTO table_listing (table_no) VALUES (?)";
        if (!$stmt = $connection->prepare($sql))
            die('Query failed: (' . $connection->errno . ') ' . $connection->error);

        if (!$stmt->bind_param('i',$table_no))
            die('Bind Param failed: (' . $connection->errno . ') ' . $connection->error);

        if (!$stmt->execute())
                die('Insert Error ' . $connection->error);

        $stmt->close();
}

function updateTable ($connection = null, $table, $table_id = null, $table_no = null, $table_cat = null) {
    if ($connection->connect_error)
            die('Connect Error (' . mysqli_connect_errno() . ') '. mysqli_connect_error());

        $sql = "UPDATE $table SET table_no = ?, table_category = ? WHERE table_id = ?";
        if (!$stmt = $connection->prepare($sql))
            die('Query failed: (' . $connection->errno . ') ' . $connection->error);

        if (!$stmt->bind_param('iii', $table_no, $table_cat, $table_id))
            die('Bind Param failed: (' . $connection->errno . ') ' . $connection->error);

        if (!$stmt->execute())
                die('Insert Error ' . $connection->error);

        $stmt->close();
}

function insertFoodCategory ($connection = null, $name = null) {
    if ($connection->connect_error)
            die('Connect Error (' . mysqli_connect_errno() . ') '. mysqli_connect_error());

        $sql = "INSERT INTO food_category (category_name) VALUES (?)";
        if (!$stmt = $connection->prepare($sql))
            die('Query failed: (' . $connection->errno . ') ' . $connection->error);

        if (!$stmt->bind_param('s',$name))
            die('Bind Param failed: (' . $connection->errno . ') ' . $connection->error);

        if (!$stmt->execute())
                die('Insert Error ' . $connection->error);

        $stmt->close();
}

function insertMenu ($connection = null, $picture = null, $name = null, $price = null, $category = null) {
    if ($connection->connect_error)
            die('Connect Error (' . mysqli_connect_errno() . ') '. mysqli_connect_error());

        $sql = "INSERT INTO menu (food_picture, food_name, food_price, category) VALUES (?, ?, ?, ?)";
        if (!$stmt = $connection->prepare($sql))
            die('Query failed: (' . $connection->errno . ') ' . $connection->error);

        if (!$stmt->bind_param('ssdi',$picture, $name, $price, $category))
            die('Bind Param failed: (' . $connection->errno . ') ' . $connection->error);

        if (!$stmt->execute())
                die('Insert Error ' . $connection->error);

        $stmt->close();
}

function insertMenuTesting ($connection = null, $name = null, $price = null) {
    if ($connection->connect_error)
            die('Connect Error (' . mysqli_connect_errno() . ') '. mysqli_connect_error());

        $sql = "INSERT INTO menu (food_name, food_price) VALUES (?, ?)";
        if (!$stmt = $connection->prepare($sql))
            die('Query failed: (' . $connection->errno . ') ' . $connection->error);

        if (!$stmt->bind_param('sd',$name, $price))
            die('Bind Param failed: (' . $connection->errno . ') ' . $connection->error);

        if (!$stmt->execute())
                die('Insert Error ' . $connection->error);

        $stmt->close();
}


function insertOrderID ($connection = null, $id = null) {
        if ($connection->connect_error)
            die('Connect Error (' . mysqli_connect_errno() . ') '. mysqli_connect_error());

        $sql = "INSERT INTO order_id VALUES (?)";
        if (!$stmt = $connection->prepare($sql))
            die('Query failed: (' . $connection->errno . ') ' . $connection->error);

        if (!$stmt->bind_param('i',$id))
            die('Bind Param failed: (' . $connection->errno . ') ' . $connection->error);

        if (!$stmt->execute())
                die('Insert Error ' . $connection->error);

        $stmt->close();
}

function insertTransaction ($connection = null, $price = null) { //insert transactions after payment
    if ($connection->connect_error)
            die('Connect Error (' . mysqli_connect_errno() . ') '. mysqli_connect_error());

        $sql = "INSERT INTO transaction_listing(total_price) VALUES (?)";
        if (!$stmt = $connection->prepare($sql))
            die('Query failed: (' . $connection->errno . ') ' . $connection->error);

        if (!$stmt->bind_param('i',$price))
            die('Bind Param failed: (' . $connection->errno . ') ' . $connection->error);

        if (!$stmt->execute())
                die('Insert Error ' . $connection->error);

        $stmt->close();
}

//insert into reservations table
function insertReservations ($connection = null, $name = null, $mobile = null, $date = null, $table = null, $customers = null) { 
    if ($connection->connect_error)
            die('Connect Error (' . mysqli_connect_errno() . ') '. mysqli_connect_error());

        $sql = "INSERT INTO reservation(reserve_name, reserve_mobile, reserve_date, reserve_table, reserve_customers) VALUES (?, ?, ?, ?, ?)";
        if (!$stmt = $connection->prepare($sql))
            die('Query failed: (' . $connection->errno . ') ' . $connection->error);

        if (!$stmt->bind_param('sssii',$name, $mobile, $date, $table, $customers))
            die('Bind Param failed: (' . $connection->errno . ') ' . $connection->error);

        if (!$stmt->execute())
                die('Insert Error ' . $connection->error);

        $stmt->close();
}

function updateHideStatus ($connection = null, $table = null, $status = null, $id = null) {
    if ($connection->connect_error)
            die('Connect Error (' . mysqli_connect_errno() . ') '. mysqli_connect_error());

        $sql = "UPDATE $table SET status = ? WHERE food_id = ?";
        if (!$stmt = $connection->prepare($sql))
            die('Query failed: (' . $connection->errno . ') ' . $connection->error);

        if (!$stmt->bind_param('ii', $status, $id))
            die('Bind Param failed: (' . $connection->errno . ') ' . $connection->error);

        if (!$stmt->execute())
                die('Insert Error ' . $connection->error);

        $stmt->close();
}

function updateKitchenInboxStatus ($connection = null, $table = null, $order_id = null, $ordered_food = null) {
    if ($connection->connect_error)
            die('Connect Error (' . mysqli_connect_errno() . ') '. mysqli_connect_error());

        $sql = "UPDATE $table SET status = 2 WHERE order_id = ? AND ordered_food = ?";
        if (!$stmt = $connection->prepare($sql))
            die('Query failed: (' . $connection->errno . ') ' . $connection->error);

        if (!$stmt->bind_param('ii', $order_id, $ordered_food))
            die('Bind Param failed: (' . $connection->errno . ') ' . $connection->error);

        if (!$stmt->execute())
                die('Insert Error ' . $connection->error);

        $stmt->close();
}

function updateTableOrder ($connection = null, $table = null, $status = null, $order = null) { //update order in order details
    if ($connection->connect_error)
            die('Connect Error (' . mysqli_connect_errno() . ') '. mysqli_connect_error());

        $sql = "UPDATE $table SET order_status = ? WHERE ordered_table = ?";
        if (!$stmt = $connection->prepare($sql))
            die('Query failed: (' . $connection->errno . ') ' . $connection->error);

        if (!$stmt->bind_param('ii', $status, $order))
            die('Bind Param failed: (' . $connection->errno . ') ' . $connection->error);

        if (!$stmt->execute())
                die('Insert Error ' . $connection->error);

        $stmt->close();
}

function updateTableStatus ($connection = null, $table = null, $status = null, $order = null) { //update table status
    if ($connection->connect_error)
            die('Connect Error (' . mysqli_connect_errno() . ') '. mysqli_connect_error());

        $sql = "UPDATE $table SET status = ? WHERE table_no = ?";
        if (!$stmt = $connection->prepare($sql))
            die('Query failed: (' . $connection->errno . ') ' . $connection->error);

        if (!$stmt->bind_param('ii', $status, $order))
            die('Bind Param failed: (' . $connection->errno . ') ' . $connection->error);

        if (!$stmt->execute())
                die('Insert Error ' . $connection->error);

        $stmt->close();
}

function updateFoodItem ($connection = null, $table = null, $id = null, $name = null, $price = null, $category = null) {
    if ($connection->connect_error)
            die('Connect Error (' . mysqli_connect_errno() . ') '. mysqli_connect_error());

        $sql = "UPDATE $table SET food_name = ?, food_price = ?, category = ? WHERE food_id = ?";
        if (!$stmt = $connection->prepare($sql))
            die('Query failed: (' . $connection->errno . ') ' . $connection->error);

        if (!$stmt->bind_param('sdii', $name, $price, $category, $id))
            die('Bind Param failed: (' . $connection->errno . ') ' . $connection->error);

        if (!$stmt->execute())
                die('Insert Error ' . $connection->error);

        $stmt->close();
}


function updateCatItem ($connection = null, $table = null, $id = null, $name = null) {
    if ($connection->connect_error)
            die('Connect Error (' . mysqli_connect_errno() . ') '. mysqli_connect_error());

        $sql = "UPDATE $table SET category_name = ? WHERE category_id = ?";
        if (!$stmt = $connection->prepare($sql))
            die('Query failed: (' . $connection->errno . ') ' . $connection->error);

        if (!$stmt->bind_param('si', $name, $id))
            die('Bind Param failed: (' . $connection->errno . ') ' . $connection->error);

        if (!$stmt->execute())
                die('Insert Error ' . $connection->error);

        $stmt->close();
}

//update reservations table
function updateReservations ($connection = null, $id = null, $name = null, $mobile = null, $date = null, $table = null, $customers = null) { 
    if ($connection->connect_error)
            die('Connect Error (' . mysqli_connect_errno() . ') '. mysqli_connect_error());

        $sql = "UPDATE reservation SET reserve_name = ?, reserve_mobile = ?, reserve_date = ?, reserve_table = ?, reserve_customers = ? WHERE reserve_id = ?";
        if (!$stmt = $connection->prepare($sql))
            die('Query failed: (' . $connection->errno . ') ' . $connection->error);

        if (!$stmt->bind_param('sssiii',$name, $mobile, $date, $table, $customers, $id))
            die('Bind Param failed: (' . $connection->errno . ') ' . $connection->error);

        if (!$stmt->execute())
                die('Insert Error ' . $connection->error);

        $stmt->close();
}



?>
