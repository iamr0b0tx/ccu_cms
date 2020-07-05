<?php
require_once 'connect.php';
require_once 'database.php';

$database = new Database;

$a = $database->select_table(null, "id, name", "members", "group_name LIKE '%a%'", "date_joined ASC");
$a = $a->fetchAll();
$a_length = count($a);

$b = $database->select_table(null, "id, name", "members", "group_name LIKE '%b%'", "date_joined ASC");
$b = $b->fetchAll();
$b_length = count($b);

$c = $database->select_table(null, "id, name", "members", "group_name LIKE '%c%'", "date_joined ASC");
$c = $c->fetchAll();
$c_length = count($c);

$a_length = ceil($a_length*0.4);
$b_length = ceil($b_length*0.4);
$c_length = ceil($c_length*0.4);

$new_a = array_slice($a, 0, $a_length);

$new_b = array_slice($b, 0, $b_length);

$new_c = array_slice($c, 0, $c_length);

$new_a = array_merge($new_a, array_slice($b, $b_length, ceil((count($b)-$b_length)/2)));
$b = array_slice($b, $b_length + ceil((count($b)-$b_length)/2), count($b));
$new_a = array_merge($new_a, array_slice($c, $c_length, ceil((count($c)-$c_length)/2)));
$c = array_slice($c, $c_length + ceil((count($c)-$c_length)/2), count($c));

$new_b = array_merge($new_b, array_slice($a, $a_length, ceil((count($a)-$a_length)/2)));
$a = array_slice($a, $a_length + ceil((count($a)-$a_length)/2), count($a));
$new_b = array_merge($new_b, $c);

$new_c = array_merge($new_c, $a);
$new_c = array_merge($new_c, $b);

shuffle_data($new_a, 'a');
shuffle_data($new_b, 'b');
shuffle_data($new_c, 'c');
function shuffle_data($array, $grp){
	global $conn;
	foreach($array as $row){
		$id = $row["id"];
		$sql = "UPDATE members SET group_name='$grp' WHERE id=$id";
		$conn->exec($sql);
	}
}

?>
<html>
<head></head>
<body>
	
	<script>
		function done_shuffle(){
			alert("Data shuffled.");
			document.location.href = "../index.php";
		}
	
		done_shuffle();
	</script>

</body>
</html>