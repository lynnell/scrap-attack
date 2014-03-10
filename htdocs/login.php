<?php 
if(isset($_POST) && !empty($_POST))
{
session_start();


include("config.php"); //including config.php in our file
$username = mysql_real_escape_string(stripslashes($_POST['username'])); //Storing username in $username variable.
$password = mysql_real_escape_string(stripslashes(md5($_POST['password']))); //Storing password in $password variable.

//adding the username to the session.
$_SESSION['username'] = $username;

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

<center>
			<h2>Welcome to Super Scrappers!!!</h2>
			<h4>Login or create an account to share your scrapbook ideas. </h4>
		
<table>
<tr>
<td>Username: <input type="text" name="username" size="20" placeholder="Username">
</td>
</tr>

<tr>
<td>Password: <input type="password" name="password" size="20" placeholder="Password">
</td>
</tr>

<tr>
<td>
<input type="submit" value="Log In" class="btn btn-large btn-primary">
&nbsp;&nbsp;
<a href="add.php">Sign Up</a>
<!--<input type=" value="SignUp" class="btn btn-large btn-primary">-->
</td>
</tr>
<table>
<br>

<!--
<center>
			<img src="C:/xampp/htdocs/superheroes.jpg" alt="Superheroes!!!" height="500" width="300" />
			
			
			</center>
-->
			</div>
		
	</body>
</html>

<!--
<h2 class="form-signin-heading">Admin/Employee Login</h2>
<input type="text" name="username" size="20" placeholder="Username">
<input type="password" name="password" size="20" placeholder="Password"></br>
<input type="submit" value="Log In" class="btn btn-large btn-primary">
<a href="signup.php">Sign Up</a>        
</form>
</div>
</body>
</html>
-->

<?php
}
?>




