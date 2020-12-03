<!doctype html>
<html>
<title>Admin Posts Listing </title>
<link rel="stylesheet" href="../css/style.css"/>
<!--link rel="stylesheet" href="../css/style.css"/-->
<?php
include "database.php" ;
if (isset($_GET['pageno'])) {
            $pageno = $_GET['pageno'];
        } else {
            $pageno = 1;
        }
	$row_per_page = 5 ;
	$start = ($pageno-1) * $row_per_page;
	$db = "posts_manager" ;
	$script = "SELECT id, image, title, status FROM post_manager GROUP BY id LIMIT ".$start ."," . $row_per_page ;
	$con->query ("USE posts_manager") ;
	$i = 1 ;
	$total_pages_sql = "SELECT COUNT(*) FROM post_manager";
	$result = mysqli_query($con,$total_pages_sql);
	$total_rows = mysqli_fetch_array($result)[0];
	$total_pages = ceil($total_rows / $row_per_page);
	$run = $con->query ($script) ;

?>
<head>
 <h1 size=45 > <b> Admin Posts Listings </h1>
</head>

<body>
	<a href="create.php" class="w3-btn w3-black">
		<button class="w3-btn w3-black" id='create' style="float:right;">Create</button>
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
				."<img id=\"p" . $i . "\"" . "src=\"..\\..\\" . $row["image"] . "\" />" . 
				"</td>".

				"<td>"
				.$row["title"].
				"</td>".

				"<td>"
				.$row["status"].
				"</td>".
				"<td>".
					"<a href=\"/mvc/postlist/p" . $row['id'] . ".php\"><button> Show </button/> </a> <br><br>" .
					"<a href=\"./edit/edit". $row['id'] .".php\"><button> Edit </button></a> <br><br>" .
					"<a href=\"./delete/delete". $row['id'] .".php\"><button> Delete </button></a> <br><br>" .
				"</td>");
				echo "</tr>" ;
				$i++ ;
			}
		?>
		</table>
		Pagination:
      <ul class="pagination" >
        <li class="<?php if($pageno <= 1){ echo 'disabled'; } ?>">
            <a href="<?php if($pageno <= 1){ echo '#'; } else { echo "?pageno=".($pageno - 1); } ?>"><<</a></li>
		<li ><a href="?pageno=1" >1</a></li>
		<li ><a href="?pageno=2" >2</a></li>
		<li ><a href="?pageno=3" >3</a></li>
        <li class="<?php if($pageno >= $total_pages){ echo 'disabled'; } ?>" >
            <a href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?pageno=".($pageno + 1); } ?>">>></a>
        </li>
<!--End Main container -->
</body>
</html>