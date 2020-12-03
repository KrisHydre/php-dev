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
	$script = "SELECT * FROM posts_manager.v_listpost GROUP BY id" ;
	$use = $con->query ("USE posts_manager") ;
	$run = $con->query($script) ;
	$i = 1 ;
?>
<head>
 <h1 size=40 > <b> No Header </h1>
</head>

<body>
<!-- Main container start here -->
		<table>
		  <tr id="post-tables">
		    <th> ID </th>
		    <th> Thumb </th>
		    <th> Title </th>
		  </tr>
		<?php
			/*if($con !== false) {
				echo "Connect Successfully" ;
			} else {
				echo "It just fucking doesn't work!";
			}*/
			
			# extract the date from mysql
			while ($row = $run->fetch_assoc()) {
				echo "<tr id=".$i.">" ;
				echo ("<td>".
				"<a href=\"/mvc/postlist/p" . $i . ".php\">". $row["id"] . 
				"</a>"."</td>".
				
				"<td>".
				"<a href=\"/mvc/postlist/p" . $i . ".php\">" .
				"<img id=\"p" . $i . "\"" . "src=../" . $row["image"] . " />" . 
				"</a>"."</td>".
				
				"<td>".
				"<a href=\"/mvc/postlist/p" . $i . ".php\">" . $row["title"] .
				"</a>"."</td>");
				echo "</tr>" ;
				$i++ ;
			}
			$con->close() ;
		?>
		</table>
<!--End Main container -->
</body>
</html>
