<!DOCTYPE html>
<html>
<body>
<?php 
	$user ="root" ;
	$pwd  ="notherland432" ;
	$server = "127.0.0.1" ;
	$db = "posts_manager" ;
	$con = new mysqli ($server, $user, $pwd, $db) ;
	$use = $con->query ("USE posts_manager") ;
	if (array_key_exists('delete', $_POST)) {
		$con->query ("DELETE FROM posts_manager.post_manager WHERE id=5");
		echo "<meta http-equiv=\"refresh\" content=\"1;url=/mvc/admin/includes/admin-show.php\" />" ;
	}
?>
    <div class="container">
      <h1>Delete Post</h1>
      <p>Are you sure you want to delete this post?</p>
      
	  <div class="clearfix">
        <form method="post">
		<input type="submit" name="delete" id="delete" value="Delete" />
		
		<a href="/e-commerce/admin/includes/admin-show.php" class="w3-btn w3-black">
		<input type="button" name="cancel" value="Cancel" /> </a>
		</form>
      </div>
    </div>
  </form>
</div> 
</body>
</html>
