<!doctype html>
<html>
<title>Admin Posts Listing </title>
<link rel="stylesheet" href="../css/style.css"/>
<!--link rel="stylesheet" href="../css/style.css"/-->
<?php
	$user ="root" ;
	$pwd  ="notherland432" ;
	$server = "127.0.0.1" ;
	$db = "posts_manager" ;
	$con = new mysqli ($server, $user, $pwd, $db) ;
	$script = "SELECT id, image, title, status FROM post_manager GROUP BY id" ;
	$use = $con->query ("USE posts_manager") ;
	$run = $con->query($script) ;
	$i = 1 ;
?>
<head>
 <h1 size=45 > <b> Admin Posts Listings </h1>
</head>

<body>
	<a href="create.php" class="w3-btn w3-black">
		<button class="w3-btn w3-black" id='create' >Create</button>
		</a>
<!-- Main container start here -->
		<table>
		  <tr id="post-tables">
		    <th> ID </th>
		    <th> Thumb </th>
		    <th> Title </th>
			<th> Status</th>
			<th> Action</th>
		  </tr>
		<?php
			# extract the date from mysql
			while ($row = $run->fetch_assoc()) {
				echo "<tr id=".$i.">" ;
				echo ("<td>"
				 .$row["id"]. 
				"</td>".
				
				"<td>"
				."<img id=\"p" . $i . "\"" . "src=\"..\\" . $row["image"] . "\" />" . 
				"</td>".
				
				"<td>"
				.$row["title"].
				"</td>".
				
				"<td>"
				.$row["status"].
				"</td>".
				"<td>".
					"<a href=\"/e-commerce/postlist/p" . $i . ".php\"><button> Show </button/> </a> <br><br>" .
					"<a href=\"./edit/edit". $i .".php\"><button> Edit </button></a> <br><br>" .
					"<a href=\"./delete/delete". $i .".php\"><button> Delete </button></a> <br><br>" .
				"</td>");
				echo "</tr>" ;
				$i++ ;
				$del = "DELETE FROM posts_manager.post_manager WHERE id=" . $i ;
				#echo "<script> alert ('Delete post successfully') </script>" ;
				#echo "<script> wind	ow.open ('admin-show.php', '_self') </script>" ;
			}
		?>
		<?php 
		function del_function(){
			echo ($i) ;
			echo $_POST['delete'] ;
}
		if(array_key_exists('delete' , $_POST)) {
					del_function () ;
				}
		?>
		</table>
		
<!--End Main container -->
</body>
</html>
