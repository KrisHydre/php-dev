<!doctype html>
<html>
<title> Editting Mode </title>
<link rel="stylesheet" href="style.css"/>
<head>
<h1 size=40> <b>Editting Mode </h1>
</head>
<?php 
include "automate_function.php" ;
include "database.php" ;
	$script = "SELECT id, image, title, status, descriptions FROM post_manager WHERE id=1" ;
	$use = $con->query ("USE posts_manager") ;
	$run = $con->query($script) ;
	$row = $run->fetch_assoc() ;	
?>
<body>
  <!-- Main content start here -->
  <div class="main_part">
	
	<hr class="solid">

    <!-- Edit Titles -->
	<div class="edit-table">
	  <form action="create.php?id=<?=$_REQUEST['id']?>&title=<?=$_REQUEST['title']?>&description=<?=$_REQUEST['description']?>
	  &file=<?=$_REQUEST['description']?>"  method="post" enctype="multipart/form-data">
		<div class="id">
			<b>ID: <input	 type="text" id='id' name="id" value="14" > <br>
			<hr class="solid">
		</div>
	
		<div class="title" >
			<b>Title: <input type="text" id='tit' name="title" value="Title" > <br> 
			<hr class="solid">
		</div>
		
		<div class="description">
			<b>Descriptions: <input type="text" id='des' name="description" value="Description" > <br>
			<hr class="solid">
		</div>
		
		<div class="status">
			<label for="status">Status: </label>
			<select name="status" id="status">
				<option value="Enabled">Enabled</option>
				<option value="Disabled">Disabled</option>
			</select>
			<hr class="solid">
		</div>
		
		<div class="browse">
</div>
			  Select image to upload:
			  <input type="file" name="fileToUpload" id="fileToUpload"> <br>
			  <img id='thumb' width="40%" src= "
			  <?php if (isset($_FILES["fileToUpload"]["name"])) {
				  echo "../../images/".htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) ;
			  } else {
				  echo null;
				  }
			  ?>" > <br>
			  <?php
				if (isset($_REQUEST['id']) && isset($_REQUEST['title']) && isset($_REQUEST['description']) && isset($_REQUEST['status']) ) {
					$s = "INSERT INTO post_manager VALUES" . "('".$_REQUEST['id']. "','" .$_REQUEST['title']. "','" .$_REQUEST['description']. "','" .
					"images/" . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])). "','" .
					$_REQUEST['status']. "',NULL ,NULL)"  ;
					#echo ($s) ;
					$con->query($s) ;
					check_img () ;
					make_post($_REQUEST['id']);
					make_edit($_REQUEST['id']) ;
					make_delete($_REQUEST['id']) ;
					
					echo "<meta http-equiv=\"refresh\" content=\"3;url=/mvc/admin/includes/admin-show.php\" />" ;
				}
				?>
			  <hr class="solid">
			  <input type="submit" name="submit" value="Submit"/>
			  <input type="reset">
		  </form>
				
	</div>
		
		</table>
	</div>	<!--content wrapper-->
	
	<div class="footer">
		Page Footer
	</div>
	
</div>
<!--End Main container -->
</body>
</html>

