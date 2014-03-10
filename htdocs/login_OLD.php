<!--<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
	"http://www.w3.org/TR/html4/loose.dtd">
-->

<html>
<head>
		<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
		<meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1' />
		<link href="styles.css" rel="stylesheet" type="text/css">
		
<title>Login</title>
<link rel="stylesheet" type="text/css" href="style.css" />
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

 <div class="container login">
<form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" class="form-signin" id = "login_form" >
<h2 class="form-signin-heading">Admin/Employee Login</h2>
<input type="text" name="username" size="20" placeholder="Username">
<input type="password" name="password" size="20" placeholder="Password"></br>
<input type="submit" value="Log In" class="btn btn-large btn-primary">
<a href="signup.php">Sign Up</a>        
</form>
</div>
</body>
</html>




<?php 
if(isset($_POST) && !empty($_POST))
{
session_start();
include("config.php"); //including config.php in our file
$username = mysql_real_escape_string(stripslashes($_POST['username'])); //Storing username in $username variable.
$password = mysql_real_escape_string(stripslashes(md5($_POST['password']))); //Storing password in $password variable.


$match = "select id from $table where username = '".$username."' and password = '".$password."';"; 

$qry = mysql_query($match);

$num_rows = mysql_num_rows($qry); 

if ($num_rows <= 0) { 

echo "Sorry, there is no username $username with the specified password.";

echo "Try again";

exit; 

} else {

$_SESSION['user']= $_POST["username"];
header("location:home.php");
// It is the page where you want to redirect user after login.
}
}else{
?>
<html>
<head>
<title>Login</title>
<link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
 <div class="container login">
<form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" class="form-signin" id = "login_form" >
<h2 class="form-signin-heading">Admin/Employee Login</h2>
<input type="text" name="username" size="20" placeholder="Username">
<input type="password" name="password" size="20" placeholder="Password"></br>
<input type="submit" value="Log In" class="btn btn-large btn-primary">
<a href="signup.php">Sign Up</a>        
</form>
</div>
</body>
</html>
<?php
}
?>




