<?php
// vars & params
  $user ="root" ;
  $pwd  ="notherland432" ;
  $server = "127.0.0.1" ;
  $table = "CREATE TABLE post_manager (
  id INT AUTO_INCREMENT KEY ,title VARCHAR (150),
  descriptions TEXT, image VARCHAR (150),
  status VARCHAR(10), create_at DATETIME, update_at DATETIME)" ;
  $s = array ("DROP SCHEMA IF EXISTS posts_manager",
  "CREATE SCHEMA posts_manager", "USE posts_manager",
  "DROP TABLE IF EXISTS post_manager");
  $file = (fopen("db.csv", "r")) ; // open the file
  
// create new connetion
  function connect_to_sql ($server, $user, $pwd) 
  {
	  $con = new mysqli ($server, $user, $pwd ) ;
	  return $con  ;
  }
  $con = connect_to_sql ($server, $user, $pwd) ;
  
// check the connection
  if ($con->connect_error) {
	  die ("***Conection Error: ".$con->error."<br/>") ;
  }
  echo "***Connecting Successfully"."<br/>" ;
  
// create new database
  foreach ($s as $script) {
	  $con->query($script) ;
	  if ($con->query($s[1]) === true){
		  echo "\n**Creating schema successfully"."<br/>" ;
	  }
  }

// create new table
  if ($con->query($table) ===true) {
	  echo "\n*Creating table successfully\n"."<br/>" ;
  } else {
	  echo "\n*Error creating table: " .$con->error."<br/>" ;
  }
  
// open file, read csv file and insert the data from it into SQL server.
   if ($file == true) {
	    while (($csv = fgetcsv($file)) == true) {
			$scripts = ("INSERT INTO post_manager VALUES
			($csv[0], '$csv[1]', '$csv[2]', '$csv[3]', '$csv[4]', 
			'$csv[5]', '$csv[6]')") ;
			#echo "$scripts\n<br/>";
			$con->query ($scripts);
	   }
	    echo "Insert Data Successfully<br/>" ;
   }
	  #echo "Insert data successfully<br/>" ;
	  fclose($file) ;
  
// create user view to the file
  $create_view = "CREATE OR REPLACE VIEW v_listpost AS
  SELECT id, image, title FROM post_manager GROUP BY id" ;
  if ($con->query ($create_view) == true ) {
	  echo "Create user view successfully.<br/>" ;
}
  $post_view = "CREATE OR REPLACE VIEW v_post AS
SELECT id, title, image, descriptions FROM post_manager" ;
if ($con->query ($post_view) == true ) {
	  echo "Create user post view successfully.<br/>" ;
}
echo "<meta http-equiv=\"refresh\" content=\"3;url=/mvc/\" />" ;
// insert the page posts data to the table
?>