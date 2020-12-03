<!doctype html>
<html>
<title> Editting Mode </title>
<link rel="stylesheet" href="style.css"/>
<head>
<h1 size=40> <b>Editting Mode </h1>
</head>
<?php 
	$user ="root" ;
	$pwd  ="notherland432" ;
	$server = "127.0.0.1" ;
	$db = "posts_manager" ;
	$con = new mysqli ($server, $user, $pwd, $db) ;
	$script = "SELECT id, image, title, status, descriptions FROM post_manager WHERE id=14" ;
	$use = $con->query ("USE posts_manager") ;
	$run = $con->query($script) ;
	$row = $run->fetch_assoc() ;
	
function check_img() {
	$target_dir = "../../../images/";
	$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
	$uploadOk = 1;
	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
	#var_dump ($target_dir, $target_file, $imageFileType, $_FILES["fileToUpload"]["tmp_name"], $_REQUEST["fileToUpload"]) ;

	// Check if image file is a actual image or fake image
	if(isset($_POST["submit"])) {
	  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
	  if($check !== false) {
		#echo "File is an image - " . $check["mime"] . ".";
		$uploadOk = 1;
	  } else {
		#echo "File is not an image.";
		$uploadOk = 0;
	  }
	}

	// Check if file already exists
	if (file_exists($target_file)) {
	  #echo "Sorry, file already exists.";
	  $uploadOk = 0;
	}

	// Check file size
	if ($_FILES["fileToUpload"]["size"] > 700000) {
	  echo "Sorry, your file is too large.";
	  $uploadOk = 0;
	}

	// Allow certain file formats
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
	&& $imageFileType != "gif" ) {
	  echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
	  $uploadOk = 0;
	}

	// Check if $uploadOk is set to 0 by an error
	if ($uploadOk == 0) {
	  echo "Sorry, your file was not uploaded.";
	// if everything is ok, try to upload file
	} else {
	  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
		echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
	  } else {
		echo "Sorry, there was an error uploading your file.";
	  }
	}
}  
?>
<body>
  <!-- Main content start here -->
  <div class="main_part">
  
	<div class='button'>
		<a href="../../../postlist/p14.php" class="w3-btn w3-black">
		<button class="w3-btn w3-black">Show</button>
		</a>
		<a href="../admin-show.php" class="w3-btn w3-black">
		<input type="button" name="cancel" value="Cancel" />
		</a>
	</div>
	
	<hr class="solid">

    <!-- Edit Titles -->
	<div class="edit-table">
	
		<div class="title" >
		  <form action="edit14.php" method="post" enctype="multipart/form-data">
			<label> <b>Title </label>
			<input type="text" id='tit' name="title" value="<?php echo $row["title"] ?>" > <br> 
			<hr class="solid">
		</div>
		
		<div class="description">
			<label> <b>Descriptions </label>
			<input type="text" id='des' name="description" value="<?php echo $row["descriptions"] ?>" > <br>
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
			  <img id='thumb' src= "
			  <?php if (isset($_FILES["fileToUpload"]["name"])) {
				  echo "images\\".htmlspecialchars(basename($_FILES["fileToUpload"]["name"]))	 ;
			  } else {
				  echo "..\..\\" . $row['image'];
				  }
			  ?>" > <br>
			  <?php
				if (isset($_REQUEST['title']) && isset($_REQUEST['description']) && isset($_REQUEST['status']) ) {
					$s = "UPDATE post_manager SET title='" . $_REQUEST['title'] . "', descriptions='" . $_REQUEST['description'] . 
					"', status='" . $_REQUEST['status']. "', image='images/".htmlspecialchars(basename($_FILES["fileToUpload"]["name"]))
					. "' WHERE id = 14" ;
					#echo ($s) ;
					$con->query($s) ;
					check_img () ;
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