<php 
session_start();
?>
<DOCTYPE html>
<html>
<head>
<title>Login</title>
</head>
<body>
<?php 

$usernameErr= $passwordErr="";
$username="";
$password="";

if($_SERVER["REQUEST_METHOD"] == "POST") {
    if(empty($_POST['username'])) {
        $usernameErr = "Please fill up the last user name properly";
    }
    else {
        $username = $_POST['username'];
    }
    if(empty($_POST['pass'])) {
        $passwordErr = "Please fill up the Password properly";
    }
    else {
        $password = $_POST['pass'];
    }

 $fn = fopen("data.txt","r") or die("fail to open file");
 
while($row = fgets($fn)) {

    $json_decoded_text = json_decode($row, true);
    if($username==$json_decoded_text['Username'] && $password==$json_decoded_text['Password']){
        echo"successfull";
        header("Location:Welcome.php");
        $_SESSION["userid"] = $username;
        $_SESSION["password"] = $password;
    }

}

fclose( $fn );

}

    
    



?>

<h1> Login page:</h1>

    
<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
    <label for="username">Username<span style="color: red">*</span> </label>
    <input type="text" name="username" id="username" value="<?php echo $username ?>">
	<span style="color: red"><?php echo $usernameErr; ?></span>
		
	<br>
    <label for="password">Password<span style="color: red">*</span> </label>
	<input type="password" name="pass" id="pass" value="<?php echo $password ?>"> 
	<span style="color: red"><?php echo $passwordErr; ?></span>
		
	<br>
    <input type="submit" value="Submit">
</form>
    
</body>

</html>