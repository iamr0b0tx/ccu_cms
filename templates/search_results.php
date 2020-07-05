<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
<?php $rows = $search_results->fetchAll();$n = count($rows); ?>
  <h2 class="sub-header">Search Results</h2><span><?php echo $n. "result(s) found!"; ?></span>
  <?php if($n > 0){ ?>
  <div class="table-responsive">
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
				echo "<tr><td>" . $row["id"]. "</td><td>" . ucwords($row["name"]). "</td><td>" . strtoupper($row["group_name"])."</td><td>" . $row["email"]. "</td><td><a href=\"?edit=" . $row["id"]. "\" onclick=\"edit()\">edit</a>	|	<a href=\"#delete\" onclick=\"del(".$row['id'].")\">delete</a>	|	<a href=\"?read=" . $row["id"]. "\" onclick=\"read()\">read</a></td></tr>";
			}
	  }
			?>
		 
	  </tbody>
	</table>
  </div>