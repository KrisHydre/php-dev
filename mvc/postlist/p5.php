<!doctype html>
<html>
<title> Posts Listing </title>
<link rel="stylesheet" href="style.css"/>
<!--link rel="stylesheet" href="../css/style.css"/-->
<?php 
include "../admin/includes/database.php" ;
	$con->query ("USE posts_manager");
	$script = "SELECT title, image, descriptions FROM posts_manager.v_post WHERE id='5'" ;
	$run = $con->query($script) ;
	$row = $run->fetch_assoc() ;
	# extract the date from mysql
	$title = $row['title'] ;
	$img ="../" . $row['image'] ;
	$des = $row['descriptions'] ;
?>
<head>
 <h1 size=40 > <b> <?php echo $title ?>  </h1>
</head>

<body>
<!-- Main container start here -->
  	<img id="logo" width='450px' src="<?= $img ?>" />
	<p> <?= $des ?> </p>

<!--End Main container -->
</body>
</html>