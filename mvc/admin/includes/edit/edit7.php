<!doctype html>
<html>
<title> Editting Mode </title>
<link rel="stylesheet" href="style.css"/>
<head>
<h1 size=40> <b>Editting Mode </h1>
</head>
<?php
include "checkImg.php";
	$user ="root" ;
	$pwd  ="notherland432" ;
	$server = "127.0.0.1" ;
	$db = "posts_manager" ;
	$con = new mysqli ($server, $user, $pwd, $db) ;
	$script = "SELECT id, image, title, status, descriptions FROM post_manager WHERE id=7" ;
	$use = $con->query ("USE posts_manager") ;
	$run = $con->query($script) ;
	$row = $run->fetch_assoc() ;
	
?>
<body>
  <!-- Main content start here -->
  <div class="main_part">
  
	<div class='button'>
		<a href="../../../postlist/p7.php" class="w3-btn w3-black">
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
		  <form action="edit7.php" method="post" enctype="multipart/form-data">
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
				  echo "images\\".htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) ;
			  } else {
				  echo "..\\..\\..\\" . $row['image'];
				  }
			  ?>" > <br>
			  <?php
				if (isset($_REQUEST['title']) && isset($_REQUEST['description']) && isset($_REQUEST['status']) ) {
					$s = "UPDATE post_manager SET title='" . $_REQUEST['title'] . "', descriptions='" . $_REQUEST['description'] . 
					"', status='" . $_REQUEST['status']. "', image='images/".htmlspecialchars(basename($_FILES["fileToUpload"]["name"]))
					. "' WHERE id = 7" ;
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
