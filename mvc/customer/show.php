<!doctype html>
<html>
<title> Posts Listing </title>
<link rel="stylesheet" href="style.css"/>
<!--link rel="stylesheet" href="../css/style.css"/-->
<?php 
include "../admin/includes/database.php" ;
	$script = "SELECT * FROM posts_manager.v_listpost GROUP BY id" ;
	$use = $con->query ("USE posts_manager") ;
	$run = $con->query($script) ;
	$i = 1 ;
?>
<head>
 <h1 size=40 > <b> Show Post </h1>
</head>

<body>
<!-- Main container start here -->

		<?php
			# extract the date from mysql
		if (isset ($_GET ['id'])) {
			$script = "SELECT title, image, descriptions FROM post_manager WHERE id=\"" . $_GET['id'] . "\"" ;
			#echo $script ; 
			$use = $con->query ("USE posts_manager") ;
			$run = $con->query($script) ;
			$row = $run->fetch_assoc() ;
			$title = $row['title'] ;
			$img = "../" . $row['image'] ;
			$des = $row['descriptions'] ;
			echo "	<!doctype html>
				<html>
				<title> Posts Listing </title>
				<head>
				<h1 size=40 > <b>  $title  </h1> <br>
				</head>
				<body>
				<!-- Main container start here -->
				  	<img id=\"logo\" width='600px' src=' " . $img ."' /><br>
					<br><p>  " . $des ."  </p>	
				<!--End Main container -->
				</body>";
			} 
		else {
		echo "<table>
		  <tr id=\"post-tables\">
		    <th> ID </th>
		    <th> Thumb </th>
		    <th> Title </th>
		  </tr>" ;
		while ($row = $run->fetch_assoc()) {

			echo "<tr id=".$i.">" ;
			echo ("<td>".
			"<a href=\"show.php?id=". $row["id"] . "\">" . $row["id"] .
			"</a>"."</td>".
			
			"<td>".
			"<a href=\"show.php?id=" . $row["id"] . "\">" .
			"<img id=\"p" . $i . "\"" . "src=../" . $row["image"] . " />" . 
			"</a>"."</td>".
			
			"<td>".
			"<a href=\"show.php?id=" . $row["id"] . "\">"  . $row["title"] .
			"</a>"."</td>");
			echo "</tr>" ;
			$i++ ;

			}
		}
			$con->close() ;
		?>
		</table>
<!--End Main container -->
</body>
</html>
