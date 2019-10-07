<?php

Class DBConnection{
	var $hostname = "localhost";
	var $database = "hotelbooking";
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
    $result = $stmt->get_result();
    
    $count = 0;
    $results = array();	
    
    while($row = mysqli_fetch_assoc($result)){
        
        $results[$count] = $row;
        $count++;
    }
		
    return $results;
    
}

function insert ($connection = null, $name = null, $contact = null, $email = null, $type = null, $in = null, $out = null, $id = null) {
    if ($connection->connect_error)
            die('Connect Error (' . mysqli_connect_errno() . ') '. mysqli_connect_error());

        $sql = "INSERT INTO booking (booking_name, booking_email, booking_contact, booking_roomType, booking_checkin, booking_checkout, booked_hotel) VALUES (?, ?, ?, ?, ?, ?, ?)";
        if (!$stmt = $connection->prepare($sql))
            die('Query failed: (' . $connection->errno . ') ' . $connection->error);

        if (!$stmt->bind_param('ssssssi',$name, $email, $contact, $type, $in, $out, $id))
            die('Bind Param failed: (' . $connection->errno . ') ' . $connection->error);

        if (!$stmt->execute())
                die('Insert Error ' . $connection->error);

        echo "Record added";
        $stmt->close();
        $connection->close();
}



?>
