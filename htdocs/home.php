<?php
session_start();

include("config.php"); 
//including config.php in our file

//echo "The username is: ".$_SESSION['username'];

$username = $_SESSION['username'];  
//echo $username;


if(!empty($_POST['message'])){
// Now checking if the message box is entered or not.
$message = $_POST['message'];
$check = "SELECT * from users where username = '".$username."'";
$qry = mysql_query($check);
$num_rows = mysql_num_rows($qry); 


// Now inserting record into database.
$query = "INSERT INTO `messages` (`username`, `date`, `message`)  VALUES ('".$username."',CURRENT_DATE,'".$message."');";
mysql_query($query);
header("location:home.php");
exit;

}

?>
<html>
	<head>
	
	<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
	<meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1' />
	<link href="styles.css" rel="stylesheet" type="text/css">
	
	<title></title>
		
	</head>
	<body>

		<div id='cssmenu'>		
		
		<table>
		<tr>
			<td colspan="3" align="right"><a href="logout.php" valign="right">Logout</a></td></tr>
			<!--<tr><td><img src="C:/xampp/htdocs/superheroes.jpg" alt="Superheroes!!!" height="50" width="40" />
				</td>-->
		
		<tr>	
			<td><h2></h2></td>
			<td></td>
			<td width="93%"></td>
		</tr>
		
		</table>
		
<ul>
   <li class='active'><a href='index.html'><span>Home</span></a></li>
   <li class='has-sub'><a href='#'><span>Profile</span></a>
      <ul>
         <li><a href='add.php'><span>Add</span></a></li>
         <li class='last'><a href='edit.html'><span>Edit</span></a></li>
      </ul>
   </li>
   <li><a href='search.php'><span>Search</span></a></li>
   <li class='last'><a href='event.php'><span>Events</span></a></li>
   <li class='last'><a href='idea.php'><span>Ideas</span></a></li>
</ul>

</div>		
		
		<div>
<form action="<?php $_SERVER['PHP_SELF']?>" method="post" class="form-signup">
		
<table>
<tr>			
<td>
</td>
</tr>			
<tr>			
<td>
			<h2>Welcome <?php echo $username;?> to my site!!!<h2>
</td>

<tr>			
<td>			
			<h3>What would you like to share?<h3>
</td>
</tr>
<tr>
<td>
			<input type="text" name="message" size="60" placeholder="message">
</td>
       <td><input type="submit" value="Share" class="btn btn-large btn-primary"></td>
</tr>			
<tr>			
<td>	
			<h3>Here are your recent messages:<h3>
</td>
</tr>

<tr><td>
<?php


if(empty($_POST['message'])){

// Retrieving the messages for the user so they can be displayed on the page.
$check = "SELECT * from messages where username = '".$username."'";
$qry = mysql_query($check);

       /*** run the query ***/
        $result = mysql_query($check) or die(mysql_error());

        /*** create the blog array ***/
        $blog_array = array();

        /*** check for a valid resource ***/
        if(is_resource($result))
        {
            /*** check there are results ***/
            if(mysql_num_rows($result) != 0)
            {
                /*** stuff the blog entries into the blog array ***/
                while($row = mysql_fetch_array($result, MYSQL_ASSOC))
                {
                    $blog_array[] = $row;
                }
            }
        }
        else
        {
            echo 'No Messages to Display';
        }

//$blog_size = sizeof($blog_array);
//echo $blog_size;
		
if(sizeof($blog_array) > 0)
    {
        /*** loop over the blog array and display blogs ***/
        foreach($blog_array as $blog)
        {
			echo '<div class="blog_entry">';
            echo '<p>'.$blog['message'].'</p>';
            echo '</div>';
        }
    }
    else
    {
        echo 'No Blogs Here';
    }
}

?>
</td>
</tr>

<br>

		</div>
		
	</body>
</html>
