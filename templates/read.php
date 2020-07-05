<?php

$columns = array('id', 'name', 'title', 'date_of_birth', 'gender', 'group_name', 'date_joined', 'proposed_day_of_leaving', 'parent_name', 'parent_phone_number', 'phone_number', 'email', 'attendance', 'rate_of_service');


$uri = explode("=", $_SERVER['REQUEST_URI']);
$member = $uri[count($uri)-1];

$edit = True;
$data = $database->select_table(1, "*", "members", "id = $member");
$data = $data->fetch();

$name = $data['name'];
$title = $data['title']; 
$date_of_birth = $data['date_of_birth'];
$group_name = $data['group_name'];
$image = $data['image'];
$date_joined = $data['date_joined']; 
$proposed_day_of_leaving = $data['proposed_day_of_leaving']; 
$parent_name = $data['parent_name']; 
$parent_number = $data['parent_phone_number'];
$phone_number = $data['phone_number'];
$email = $data['email'];
$gender = $data['gender'];



?>

<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
  <h1 class="page-header">Data Info...</h1>
  
  <div class="form-group" style="float:right;">
	<img src="images/<?php echo $image; ?>">
  </div>
	<?php for($i = 0;$i < count($columns);$i++){ ?>
	<div class="form-group">
	<?php $var = $columns[$i];$val = str_replace("_", " ", $columns[$i]); ?>
		<p><label for="<?php echo $var; ?>"><?php echo ucwords($val); ?>:</label>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $data[$var]; ?></p>
	</div>
	<?php }?>
</div>