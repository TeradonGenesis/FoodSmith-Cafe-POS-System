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
    
    
    $stmt = $connection->prepare("SELECT * FROM ".$table.$cond.$ord);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
    $count = 0;
    $results = array();	
    
    while($row = $result){
        
        $results[$count] = $row;
        $count++;
    }
		
    return $results;
    
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

        echo "Record added";
        $stmt->close();
        $connection->close();
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

        echo "Record added";
        $stmt->close();
        $connection->close();
}

function insertTable ($connection = null, $number = null, $category = null) {
    if ($connection->connect_error)
            die('Connect Error (' . mysqli_connect_errno() . ') '. mysqli_connect_error());

        $sql = "INSERT INTO menu (table_no, table_category) VALUES (?, ?)";
        if (!$stmt = $connection->prepare($sql))
            die('Query failed: (' . $connection->errno . ') ' . $connection->error);

        if (!$stmt->bind_param('ii',$number, $category))
            die('Bind Param failed: (' . $connection->errno . ') ' . $connection->error);

        if (!$stmt->execute())
                die('Insert Error ' . $connection->error);

        echo "Record added";
        $stmt->close();
        $connection->close();
}

?>