

<?php
session_start();


if (!isset($_SESSION['FirstVisit'])) {
	$_SESSION['FirstVisit'] = 1;
}elseif (isset($_SESSION['FirstVisit'])) {
	$_SESSION['FirstVisit'] = $_SESSION['FirstVisit'] + 1;
}


//elseif (isset($_SESSION['FirstVisit']) && $_SESSION['FirstVisit']=='1' ) {
	//increment the visit count??
//}

//if ($_SESSION['FirstVisit']=='1'){
//	echo "Made it here A";
//}
	
	
include("config.php"); 
//including config.php in our file

//echo "The username is: ".$_SESSION['username'];


$username = $_SESSION['username'];  
//echo $username;

$first_name="";
$last_name="";

if(!empty($_POST['firstname']) && !empty($_POST['lastname'])){
		$first_name= mysql_real_escape_string($_POST['firstname']);
		$last_name= mysql_real_escape_string($_POST['lastname']);
}		
	
?>

<html>

	<head>
	
		<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
		<meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1' />
		<link href="styles.css" rel="stylesheet" type="text/css">
		
		<title></title>
		
	<script>
    function visitPage(){
        window.location='http://localhost/addFriend.php';
    }
	</script>
	</head>
	<body>		
		<div id='cssmenu'>
<ul>
   <li class='active'><a href='index.html'><span>Home</span></a></li>
   <li class='has-sub'><a href='#'><span>Profile</span></a>
      <ul>
         <li><a href='add.php'><span>Add</span></a></li>
         <li class='last'><a href='edit.html'><span>Edit</span></a></li>
      </ul>
   </li>
   <li><a href='search.php'><span>Search</span></a></li>
   <li class='last'><a href='logout.php'><span>Logout</span></a></li>
</ul>
</div>
<br>
<div>
<form action="<?php $_SERVER['PHP_SELF']?>" method="post" class="form-signup">


		<!-- Always show the Show all Users button -->
		<table>
		<tr>
		<td><input type="submit" value="Show Me All Users!" class="btn btn-large btn-primary"></td>
		</tr>
		</table>


		<?php		
		
		
	//This is for the first visit when no buttons have been pushed or data fields populated.
//	echo $_SESSION['FirstVisit'];
	
//	if($_SESSION['FirstVisit'] = '1'){
	
	
	//This is for the visit when Show me all the users! button was pushed and NO data fields populated.
	if(($_SESSION['FirstVisit'] != '1') && empty($_POST['firstname']) && empty($_POST['lastname'])){
		
		$check = "SELECT * from users;";
		$qry = mysql_query($check);	
			
		/*** run the query ***/
        $result = mysql_query($check) or die(mysql_error());

        /*** create the search array ***/
        $search_array = array();

        /*** check for a valid resource ***/
		if(is_resource($result))
        {
            /*** check there are results ***/
            if(mysql_num_rows($result) != 0)
            {
                /*** stuff the search entries into the search array ***/
                while($row = mysql_fetch_array($result, MYSQL_ASSOC))
                {
                    $search_array[] = $row;
                }
            }
        }
		?>
		
		<table>
		<tr>
		<td>Here are all the users:</td>
		</tr>	
		
		<?php
		if(sizeof($search_array) > 0)
		{
			/*** loop over the search array and display search results ***/
			foreach($search_array as $search)
			{	
		?>    				
				
		<tr>
			<td><?php echo $search['firstname']; echo " "; echo $search['lastname'];?></td>
			<td>&nbsp;</td>
			<td><a href="http://localhost/addFriend.php">Add Friend</a></td>
			<!--<td><input type="submit" value="Add Friend" class="btn btn-large btn-primary"></td>-->
		</tr>		
				
		<?php
			}
		}
		?>
		
		</table>
		<?php	
	}
		?>	
		
		
		<table>
		<tr><td>&nbsp;</td></tr>
		<tr>
		<td>
		Search on any combination of the following fields:
		</td>
		</tr>
		
		<tr>
		<td>
		First Name:
		</td>
		<td>
			<input type="text" name="firstname" size="20" placeholder="firstname">
		</td>
		</tr>
		<tr>
		<td>
		Last Name:
		</td>
		<td>
			<input type="text" name="lastname" size="20" placeholder="lastname">
		</td>
		</tr>

		<tr>
		<td></td>
		<td><input type="submit" value="Search" class="btn btn-large btn-primary"></td>
		</tr>
		</table>
		
		<?php
	//This is for the visit when first and last name fields are populated.
	if(!empty($_POST['firstname']) && !empty($_POST['lastname'])){
		$first_name= mysql_real_escape_string($_POST['firstname']);
		$last_name= mysql_real_escape_string($_POST['lastname']);
		$check = "SELECT * from users where firstname = '".$first_name."' and lastname = '".$last_name."';";
		$qry = mysql_query($check);	
			
		/*** run the query ***/
        $result = mysql_query($check) or die(mysql_error());

        /*** create the search array ***/
        $search_array = array();

        /*** check for a valid resource ***/
		if(is_resource($result))
        {
            /*** check there are results ***/
            if(mysql_num_rows($result) != 0)
            {
                /*** stuff the search entries into the search array ***/
                while($row = mysql_fetch_array($result, MYSQL_ASSOC))
                {
                    $search_array[] = $row;
                }
            }
        }
		?>
		
		<table>
		<tr>
		<td>Here are the users with a first and last name of: <?php echo $first_name; echo " "; echo $last_name;?></td>
		</tr>	
		
		<?php
		if(sizeof($search_array) > 0)
		{
			/*** loop over the search array and display search results ***/
			foreach($search_array as $search)
			{	
		?>    				
				
		<tr>
			<td><?php echo $search['firstname']; echo " "; echo $search['lastname'];?></td>
			<td>&nbsp;</td>
			<td><a href="http://localhost/addFriend.php">Add Friend</a></td>
			<!--<td><input type="submit" value="Add Friend" class="btn btn-large btn-primary"></td>-->
		<tr>		
				
		<?php
			}
		}
	}
		?>	

		
		
		
		
		<?php

	//This is for the visit when first name populated and last name field is NOT populated.	
	if(!empty($_POST['firstname']) && empty($_POST['lastname'])){
		$first_name= mysql_real_escape_string($_POST['firstname']);
		$check = "SELECT * from users where firstname = '".$first_name."';";
		$qry = mysql_query($check);	
			
		/*** run the query ***/
        $result = mysql_query($check) or die(mysql_error());

        /*** create the search array ***/
        $search_array = array();

        /*** check for a valid resource ***/
		if(is_resource($result))
        {
            /*** check there are results ***/
            if(mysql_num_rows($result) != 0)
            {
                /*** stuff the search entries into the search array ***/
                while($row = mysql_fetch_array($result, MYSQL_ASSOC))
                {
                    $search_array[] = $row;
                }
            }
        }
		?>
		
		<table>
		<tr>
		<td>Here are the users with a first name of: <?php echo $first_name;?></td>
		</tr>	
		
		<?php
		if(sizeof($search_array) > 0)
		{
			/*** loop over the search array and display search results ***/
			foreach($search_array as $search)
			{	
		?>    				
				
		<tr>
			<td><?php echo $search['firstname']; echo " "; echo $search['lastname'];?></td>
			<td>&nbsp;</td>
			<td><a href="http://localhost/addFriend.php">Add Friend</a></td>
			<!--<td><button onclick="window.location='http://localhost/addFriend.php';">Add Friend</button></td>-->
		<tr>		
				
		<?php
			}
		}
	}
		?>			



		<?php
	//This is for the visit when first name is NOT populated and last name field is populated.	
	if(empty($_POST['firstname']) && !empty($_POST['lastname'])){
		$last_name= mysql_real_escape_string($_POST['lastname']);
		$check = "SELECT * from users where lastname = '".$last_name."';";
		$qry = mysql_query($check);	
			
		/*** run the query ***/
        $result = mysql_query($check) or die(mysql_error());

        /*** create the search array ***/
        $search_array = array();

        /*** check for a valid resource ***/
		if(is_resource($result))
        {
            /*** check there are results ***/
            if(mysql_num_rows($result) != 0)
            {
                /*** stuff the search entries into the search array ***/
                while($row = mysql_fetch_array($result, MYSQL_ASSOC))
                {
                    $search_array[] = $row;
                }
            }
        }
		?>
		
		<table>
		<tr>
		<td>Here are the users with a last name of: <?php echo $last_name;?></td>
		</tr>	
		
		<?php
		if(sizeof($search_array) > 0)
		{
			/*** loop over the search array and display search results ***/
			foreach($search_array as $search)
			{	
		?>    				
				
		<tr>
			<td><?php echo $search['firstname']; echo " "; echo $search['lastname'];?></td>
			<td>&nbsp;</td>
			<td><input type="submit" value="Add Friend" class="btn btn-large btn-primary"></td>
		<tr>		
				
		<?php
			}
		}
	}
		?>	

		</table>
		
		
		</form>
				
		</div>
	</body>
</html>