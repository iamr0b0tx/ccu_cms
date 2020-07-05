<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">

	<h1 class="page-header">Stats...  </h1>
	<input type="button" name="shuffle" value="SHUFFLE" class ="btn btn-info" style="float:right;" onclick="shuffle()"><br><br>
  <div class="alert alert-info">
		<strong>Analytics: </strong><?php echo "You have <b>".count($database->select_table(null, "id", "members", null, "id DESC")->fetchAll()). "</b> members on this database!";?>
		<?php if(strlen($info) > 0) echo "<br>$info"; ?>
		
	</div>
  <h1 class="page-header">Recently Added...</h1>

  <div class="row placeholders">
	
	<?php
	  
	  $rows = $recent_members->fetchAll();
	  if(count($rows) < 1){
		  echo '<h3 style="text-align:center;"><u><strong>No records Available</strong></u></h3>';
	  
	  }else{ 
		
		  foreach($rows as $row){ 
				// output data of each row
				echo '<div class="col-xs-6 col-sm-3 placeholder">';
				  echo '<img src="images/'.$row['image'].'" width="200" height="200" class="img-responsive" alt="'.$row['name'].'">';
				  echo '<h4>'.ucwords($row['name']).'</h4>';
				  echo '<span class="text-muted">'.strtoupper($row['group_name']).'</span>';
				echo '</div>';
		  }
	  }
		?>

  </div>

  <h2 class="sub-header">Members Data</h2>
  <div class="table-responsive">
 <?php
	  $rows = $members_data->fetchAll();
	  if(count($rows) < 1){
		  echo '<h3 style="text-align:center;"><u><strong>No records Available</strong></u></h3>';
	  
	  }else{ ?>
		<table class="table table-striped">
		  <thead>
			<tr>
			  <th>id</th>
			  <th>Name</th>
			  <th>Title</th>
			  <th>Group Name</th>
			  <th>Email</th>
			  <th></th>
			</tr>
		  </thead>
		  <tbody>
		  
		  <?php
			  foreach($rows as $row){ 
					// output data of each row
						echo "<tr><td>" . $row["id"]. "</td><td>" . ucwords($row["name"]). "</td><td>" . strtoupper($row["title"])."</td><td>" . strtoupper($row["group_name"])."</td><td>" . $row["email"]. "</td><td><a href=\"?edit=" . $row["id"]. "\" onclick=\"edit()\">edit</a>	|	<a href=\"#delete\" onclick=\"del('".$row['id']."')\">delete</a>	|	<a href=\"?read=" . $row["id"]. "\" onclick=\"read()\">read</a></td></tr>";
				}
		  
			?>
			 
		  </tbody>
		</table>
		<?php } ?>
	  </div>
</div>