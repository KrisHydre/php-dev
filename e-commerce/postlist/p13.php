<!doctype html>
<html>
<title> Posts Listing </title>
<link rel="stylesheet" href="style.css"/>
<!--link rel="stylesheet" href="../css/style.css"/-->
<?php 
	$user ="test" ;
	$pwd  ="test" ;
	$server = "127.0.0.1" ;
	$db = "posts_manager" ;
	$con = new mysqli ($server, $user, $pwd, $db) ;
	$script = "SELECT title, image, descriptions FROM posts_manager.v_post WHERE id='13'" ;
	$run = $con->query($script) ;
	$row = $run->fetch_assoc() ;
	# extract the date from mysql
	$title = $row['title'] ;
	$img = $row['image'] ;
	$des = $row['descriptions'] ;
?>
<head>
 <h1 size=40 > <b> <?php echo $title ?>  </h1>
</head>

<body>
<!-- Main container start here -->
  	<img id="logo" src="<?= $img ?>" />
	<p> <?= $des ?> </p>

<!--End Main container -->
</body>
</html>
