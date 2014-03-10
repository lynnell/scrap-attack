<?php
include("config.php"); 
//including config.php in our file

if(!empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['firstname']) && !empty($_POST['lastname']) 
&& !empty($_POST['email'])){
// Now checking user name and password is entered or not.
$first_name= mysql_real_escape_string($_POST['firstname']);
$last_name= mysql_real_escape_string($_POST['lastname']);
$username = mysql_real_escape_string(stripslashes($_POST['username']));
$password = mysql_real_escape_string(stripslashes(md5($_POST['password'])));
$mail = mysql_real_escape_string($_POST['email']);
$check = "SELECT * from users where username = '".$username."'";
$qry = mysql_query($check);
$num_rows = mysql_num_rows($qry); 

if($num_rows > 0){
// Here we are checking if username already exists or not.
echo "The username you have entered already exists. Please try another username.";
echo '<a href="signup.php">Try Again</a>';
exit;
}

// Now inserting record in database.
$query = "INSERT INTO users (firstname,lastname,username,password,email,is_active) VALUES ('".$first_name."','".$last_name."','".$username."','".$password."','".$mail."','1');";
mysql_query($query);
echo "Thank you for your registration!";
echo '<a href="login.php">Click Here</a> to login to your account.';
exit;

}

?>
<html>
<head>
	
	<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
	<meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1' />
	<link href="styles.css" rel="stylesheet" type="text/css">
		
<title>Registration Page | Simple login form</title>

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

<div id="containt" align="center">
<form action="<?php $_SERVER['PHP_SELF']?>" method="post" class="form-signup">
<div id="header"><h2 class="sansserif">Create an account</h2></div>
 <table>
    <tr>
      <td>Add Friends page.............:</td>
      <td> <input type="text" name="firstname" size="20" placeholder="First name"><span class="required">*</span></td>
    </tr>
 
  
             
  
 <tr>
       <td><input type="submit" value="Sign Up" class="btn btn-large btn-primary"></td>
        
     </tr>
 </table>
</form>
</div>
</body>
</html>