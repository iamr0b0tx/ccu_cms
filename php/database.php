<?php
class TableRows extends RecursiveIteratorIterator { 
    function __construct($it) { 
        parent::__construct($it, self::LEAVES_ONLY); 
    }

    /* function current() {
        return "<td style='width:150px;border:1px solid black;'>" . parent::current(). "</td>";
    }

    function beginChildren() { 
        echo "<tr>"; 
    } 

    function endChildren() { 
        echo "</tr>" . "\n";
    }  */
} 
class database {
	  var $var1;
	  var $var2 = "constant string";
	  
	  function create ($database_name, $arg2) {
		 // Create database
		 global $conn;
			$sql = "CREATE DATABASE myDB";
			if ($conn->query($sql) === TRUE) {
				echo "Database created successfully";
			} else {
				echo "Error creating database: " . $conn->error;
			}

	  }
	  
	  function select_table($limit='', $columns="id, name, email, group_name", $table_name='members', $where=null, $order = null) {
		 // Create database
		 global $conn;
		
		if($where == null) $sql = "SELECT $columns FROM $table_name";
		else			   $sql = "SELECT $columns FROM $table_name WHERE $where";
		
		if($order == null) $sql .= " ORDER BY id ASC";
		else $sql .= " ORDER BY $order";
		
		if($limit != null) $sql .=  " LIMIT $limit";
		//print($sql."<br>");
		try {
			$stmt = $conn->prepare($sql); 
			$stmt->execute();

			// set the resulting array to associative
			
			return $stmt;
			
		}catch(PDOException $e) {
			return "Error: " . $e->getMessage();
		}	
	  }
	  
	  function update_data($id, $name, $title, $image, $date_of_birth, $gender, $group_name, $date_joined, $proposed_day_of_leaving, $occupation, $parent_occupation, $parent_name, $parent_number, $phone_number, $email, $attendance, $rate_of_service,  $condition, $table_name="members") {
		  return self::io_data($id, $name, $title, $image, $date_of_birth, $gender, $group_name, $date_joined, $proposed_day_of_leaving, $occupation, $parent_occupation, $parent_name, $parent_number, $phone_number, $email, $attendance, $rate_of_service, $table_name, "UPDATE", "WHERE ".$condition);
	  }
	  function insert_data($id, $name, $title, $image, $date_of_birth, $gender, $group_name, $date_joined, $proposed_day_of_leaving, $occupation, $parent_occupation, $parent_name, $parent_number, $phone_number, $email, $attendance, $rate_of_service, $table_name="members") {
		return self::io_data($id, $name, $title, $image, $date_of_birth, $gender, $group_name, $date_joined, $proposed_day_of_leaving, $occupation, $parent_occupation, $parent_name, $parent_number, $phone_number, $email, $attendance, $rate_of_service, $table_name, "INSERT INTO");
	  }
	  
	  function io_data($id, $name, $title, $image, $date_of_birth, $gender, $group_name, $date_joined, $proposed_day_of_leaving, $occupation, $parent_occupation, $parent_name, $parent_number, $phone_number, $email, $attendance, $rate_of_service, $table_name="members", $state="INSERT INTO", $condition='') {
		// adding data to table
		global $conn;
		try {
			// sql to create table
			$sql = "$state $table_name SET
					id = '$id', name = '$name', title = '$title', image = '$image', date_of_birth = '$date_of_birth', gender = '$gender', 
					group_name = '$group_name', date_joined = '$date_joined', proposed_day_of_leaving = '$proposed_day_of_leaving', 
					parent_name = '$parent_name', parent_phone_number = $parent_number, phone_number = $phone_number, email = '$email', attendance = $attendance, rate_of_service = $rate_of_service $condition";
			
			// use exec() because no results are returned
			
			$conn->exec($sql);
			if(!strlen(trim($condition)) > 0) return "New record created successfully";
			else return "Record Edited successfully";
			
		}catch(PDOException $e){
			return "Error: " . $e->getMessage();
		}	  
	  }
	  
	  function drop_table_data($condition, $table_name="members"){
		  $sql = "DELETE FROM $table_name WHERE $condition";
		  global $conn;
		  try {
			$conn->exec($sql);
			return "Record deleted successfully";
			
		}catch(PDOException $e){
			return "Record failed to delete";
		}
	  }
		  
}
	
	

?>