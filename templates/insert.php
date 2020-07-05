<?php
$info = '';
$status = 'danger';
$edit = False;

$uri = explode("=", $_SERVER['REQUEST_URI']);
$member = $uri[count($uri)-1];
//echo "<h1>$member</h1>";
//place corresponding page
if(count($uri) > 1 && strlen($member) > 0){
	$edit = True;
	$data = $database->select_table(1, "*", "members", "id = '$member'");
	$data = $data->fetch();
	//print_r($data);
	$id = $data['id'];
	$name = $data['name'];
	$title = $data['title']; 
	$date_of_birth = $data['date_of_birth'];
	$group_name = $data['group_name'];
	$image = $data['image'];
	$date_joined = $data['date_joined']; 
	$proposed_day_of_leaving = $data['proposed_day_of_leaving']; 
	$occupation = $data['occupation']; 
	$parent_occupation = $data['parent_occupation']; 
	$parent_name = $data['parent_name']; 
	$parent_number = $data['parent_phone_number'];
	$phone_number = $data['phone_number'];
	$email = $data['email'];
	$gender = $data['gender'];
	$attendance = $data['attendance'];
	$rate_of_service = $data['rate_of_service'];
	
	/* $a = array($name, $title, $image, $date_of_birth, $gender, $group_name, $date_joined, $proposed_day_of_leaving, $parent_name, $parent_number, $phone_number, $email);
	foreach($a as $d) echo $d."<br>"; */
}else{	
	$id = $attendance = $rate_of_service = $name = $title = $date_of_birth = $group_name = $date_joined = $proposed_day_of_leaving = $occupation = $parent_occupation =  $parent_name = $parent_number = $phone_number = $email = $gender = '';
}
//pre_process of data-target
if(isset($_POST['submit'])){
	$id = $_POST['id'];
	$name = $_POST['name'];
	$title = $_POST['title']; 
	$date_of_birth = $_POST['date_of_birth'];
	$group_name = $_POST['group_name'];
	$date_joined = $_POST['date_joined']; 
	$proposed_day_of_leaving = $_POST['proposed_day_of_leaving']; 
	$occupation = $_POST['occupation']; 
	$parent_occupation = $_POST['parent_occupation']; 
	$parent_name = $_POST['parent_name']; 
	$parent_number = $_POST['parent_phone_number'];
	$phone_number = $_POST['phone_number'];
	$email = $_POST['email'];
	$gender = $_POST['gender'];
	$attendance = $_POST['attendance'];
	$rate_of_service = $_POST['rate_of_service'];
	
	/* $a = array($name, $title, $image, $date_of_birth, $gender, $group_name, $date_joined, $proposed_day_of_leaving, $parent_name, $parent_number, $phone_number, $email);
	foreach($a as $d) echo $d."<br>"; */
	
	$info .= validate_var_input("id");
	$info .= validate_text_input("name");
	$info .= validate_text_input("title");
	$info .= validate_number_input("parent_phone_number");
	$info .= validate_number_input("phone_number");
	$info .= validate_number_input("attendance");
	$info .= validate_number_input("rate_of_service");
	$info .= validate_text_input("occupation");
	$info .= validate_text_input("parent_name");
	$info .= validate_text_input("group_name");
	$info .= validate_group_input("gender");

	if (empty($_POST["email"])) {
		$info .= " Email is required.";
		
	} else {
		$email = test_input($_POST["email"]);
		// check if e-mail address is well-formed
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		  $info .= " Invalid email format."; 
		}
	}

	if(!validate_phone_number($parent_number)) {
		$info .= " Parent Phone Number is invalid.";
	}
	if(!validate_phone_number($phone_number)) {
		$info .= " Phone Number is invalid.";
	}
	
	if($edit == False && !unique_phone_number('phone_number', $phone_number)) {
		$info .= " Phone Number already exist.";
	}
	
	if (strlen($info) < 1) $data = 1;
	else $data = 0;
	
	if($data == 1){
		$p_info = '';
		$target_dir = "images/";
		
		$uploadOk = 1;
		if(strlen(trim($_FILES["image"]["tmp_name"])) > 0){
			if($edit){
				$id = '$member';
			}
			$target_file = $target_dir . (string)($id) .'.'. pathinfo(basename($_FILES["image"]["name"]), PATHINFO_EXTENSION);
			$image = basename($target_file);
			
			$image_dim = explode(" ", getimagesize($_FILES["image"]["tmp_name"])[3]);
			$image_width = (int)str_replace('"', "", (str_replace("width=", "", $image_dim[0])));
			$image_height = (int)str_replace('"', "", (str_replace("height=", "", $image_dim[1])));
					
			$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
			// Check if image file is a actual image or fake image
			
			if(strlen(trim($_FILES["image"]["tmp_name"])) > 0 and getimagesize($_FILES["image"]["tmp_name"]) !== false) {
				$uploadOk = 1;
				
			} else {
				$p_info = "File is not an image.";
				$uploadOk = 1;
			}
			
			// Check if file already exists
			if (file_exists($target_file)) {
				$p_info = "Image already exists.";
				$uploadOk = 0;
			}
			// Check file dimension
			if ($image_width != 101 && $image_height != 117) {
				$p_info = "Your image dimension should be 101 x 117.";
				$uploadOk = 0;
			}
			if ($_FILES["image"]["size"] > 500000) {
				$p_info = "Your image is too large.";
				$uploadOk = 0;
			}
			// Allow certain file formats
			if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
			&& $imageFileType != "gif" ) {
				$p_info = "Only JPG, JPEG, PNG images are allowed.";
				$uploadOk = 0;
			}
		}
		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0 && $edit == False) {
			$p_info .= " Sorry, your image was not uploaded.";
		// if everything is ok, try to upload file
		} else {
			if(isset($target_file)) $move = move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
			else $move = False;
			if ($edit || $move) {
				$status = 'success';
				//$info = $p_info = '';
				if($edit) $p_info .= $database->update_data($id, $name, $title, $image, $date_of_birth, $gender, $group_name, $date_joined, $proposed_day_of_leaving, $occupation, $parent_occupation, $parent_name, $parent_number, $phone_number, $email, $attendance, $rate_of_service, "id = '$member'");
				else $p_info .= $database->insert_data($id, $name, $title, $image, $date_of_birth, $gender, $group_name, $date_joined, $proposed_day_of_leaving, $occupation, $parent_occupation, $parent_name, $parent_number, $phone_number, $email, $attendance, $rate_of_service);
				
			} else {
				$p_info .= " Sorry, there was an error uploading your image.";
			}
		}
		$info .= $p_info;
		if($status == 'danger') $info .= " Go back to Make changes";
	}	
}

?>
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
	<?php 
		if(strlen($info) > 0){
			
			$info = str_replace("_", " ", $info);
			echo '<div class="alert alert-'.$status.'">';
			if($status == 'danger') $status = 'Error';
			  echo '<strong>'.ucwords($status).'!</strong> '.ucwords($info). '
			</div>';
		}
	?>
	
	<form method='POST' action="<?php echo $_SERVER['REQUEST_URI']; ?>" enctype='multipart/form-data'>
	  <div class="form-group">
		<label for="id">Id:</label>
		<input type="text" class="form-control" name="id" value="<?php echo $id; ?>">
	  </div>
	  <div class="form-group">
		<label for="name">Name:</label>
		<input type="name" class="form-control" name="name" value="<?php echo $name; ?>">
	  </div>
	  <div class="form-group">
		<label for="image">Image:</label><span>(image should be jpeg or png an standard passport dimension)</span>
		<input type="file" class="form-control" name="image" value="<?php echo $image; ?>">
	  </div>
	  <div class="form-group">
		<label for="title">Title:</label>
		<input type="text" class="form-control" name="title" value="<?php echo $title; ?>">
	  </div>
	  <div class="form-group">
		<label for="date_of_birth">Date of Birth:</label>
		<input type="date" class="form-control" name="date_of_birth" value="<?php echo $date_of_birth; ?>">
	  </div>
	  <div class="form-group">
		<label for="occupation">Occupation:</label>
		<input type="text" class="form-control" name="occupation" value="<?php echo $occupation; ?>">
	  </div>
	  <div class="form-group">
		<label for="date_of_birth">Gender:</label><br/>
		<select class="form-control" name="gender" value="<?php echo $gender; ?>">
			<option value="m">Male</option>
			<option value="f">Female</option>
		</select>
	  </div>
	  
	  <div class="form-group">
		<label for="group_name">Group Name:</label>
		<input type="text" class="form-control" name="group_name" value="<?php echo $group_name; ?>">
	  </div>
	  <div class="form-group">
		<label for="date_joined">Date Joined:</label>
		<input type="date" class="form-control" name="date_joined" value="<?php echo $date_joined; ?>">
	  </div>
	  <div class="form-group">
		<label for="proposed_day_of_leaving">Proposed Day of Leaving:</label>
		<input type="date" class="form-control" name="proposed_day_of_leaving" value="<?php echo $proposed_day_of_leaving; ?>">
	  </div>
	  <div class="form-group">
		<label for="parent_occupation">Parent's Occupation:</label>
		<input type="text" class="form-control" name="parent_occupation" value="<?php echo $parent_occupation; ?>">
	  </div>
	  <div class="form-group">
		<label for="parent_name">Parent's Name:</label>
		<input type="text" class="form-control" name="parent_name" value="<?php echo $parent_name; ?>">
	  </div>
	  <div class="form-group">
		<label for="parent_phone_number">Parent's Phone Number:</label>
		<input type="number" class="form-control" name="parent_phone_number" maxlength='11' value="<?php echo $parent_number; ?>">
	  </div>
	  <div class="form-group">
		<label for="phone_number">Phone Number:</label>
		<input type="number" class="form-control" name="phone_number" maxlength='11' value="<?php echo $phone_number; ?>">
	  </div>
	  <div class="form-group">
		<label for="email">Email:</label>
		<input type="email" class="form-control" name="email" value="<?php echo $email; ?>">
	  </div>
	  <div class="form-group">
		<label for="attendance">Attendance:</label>
		<input type="number" class="form-control" name="attendance" value="<?php echo $attendance; ?>" max=100>
	  </div>
	  <div class="form-group">
		<label for="rate_of_service">Rate of Service:</label>
		<input type="number" class="form-control" name="rate_of_service" value="<?php echo $rate_of_service; ?>" max=100>
	  </div>
	  
	  <input type="submit" class="btn btn-default" name="submit" >
	</form>
</div>